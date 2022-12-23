<?php

namespace App\Http\Controllers\Api\Word;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Word\WordList;
use App\Http\Resources\Api\Word\WordResource;
use App\Interfaces\WordRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * WordListController
 */
class WordListController extends Controller
{
    public const DEFAULT_PAGINATION_VALUE = 20;

    public function __construct(protected WordRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param WordList $request
     * @param int $id
     * @return AnonymousResourceCollection
     */
    public function __invoke(WordList $request, int $id)
    {
        $perPage = $request->get('perPage', self::DEFAULT_PAGINATION_VALUE);
        $words = $this->repository->getAllWordsByDictionaryId($id)->paginate($perPage);
        return WordResource::collection($words);
    }
}
