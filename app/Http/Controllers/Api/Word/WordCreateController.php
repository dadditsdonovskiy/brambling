<?php

namespace App\Http\Controllers\Api\Word;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Word\CreateWordRequest;
use App\Http\Resources\Api\Word\WordResource;
use App\Models\Dictionary;
use App\Models\Word;
use App\Services\Word\CreateService;
use App\Services\Word\SendEmailCountIsExceeded;

/**
 * WordCreateController
 */
class WordCreateController extends Controller
{
    public const WORDS_IN_DICTIONARY_LIMIT = 100;

    public function __construct(protected CreateService $createService, protected SendEmailCountIsExceeded $emailService)
    {
        $this->createService = $createService;
        $this->emailService = $emailService;
    }

    /**
     * @param CreateWordRequest $request
     * @param int $id
     * @return WordResource
     * @throws GeneralException
     */
    public function __invoke(CreateWordRequest $request, int $id)
    {
        $item = Dictionary::findOrFail($id);
        $wordCount = Word::where('dictionary_id', $id)->count();
        if ($wordCount > self::WORDS_IN_DICTIONARY_LIMIT) {
            $this->emailService->sendEmail($id, $wordCount);
        }
        $word = $this->createService->create($request->only(['name']), $item->id);
        return new WordResource($word);
    }
}
