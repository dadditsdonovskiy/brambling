<?php

namespace App\Http\Controllers\Api\Dictionary;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dictionary\CreateDictionaryRequest;
use App\Http\Resources\Api\Dictionary\DictionaryResource;
use App\Services\Dictionary\CreateService;

/**
 * DictionaryCreateController
 */
class DictionaryCreateController extends Controller
{
    public function __construct(protected CreateService $createService)
    {
        $this->createService = $createService;
    }

    /**
     * @param CreateDictionaryRequest $request
     * @return DictionaryResource
     * @throws GeneralException
     */
    public function __invoke(CreateDictionaryRequest $request)
    {
        $dictionary = $this->createService->create($request->only(['name']));
        return new DictionaryResource($dictionary);
    }
}
