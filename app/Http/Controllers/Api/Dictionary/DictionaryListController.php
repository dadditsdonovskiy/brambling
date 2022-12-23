<?php

namespace App\Http\Controllers\Api\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dictionary\DictionaryList;
use App\Http\Resources\Api\Dictionary\DictionaryResource;
use App\Interfaces\DictionaryRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * DictionaryListController
 */
class DictionaryListController extends Controller
{
    public const DEFAULT_PAGINATION_VALUE = 10;

    public function __construct(protected DictionaryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param DictionaryList $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(DictionaryList $request)
    {
        $perPage = $request->get('perPage', self::DEFAULT_PAGINATION_VALUE);
        $dictionaries = $this->repository->getAllDictionaries()->paginate($perPage);
        return DictionaryResource::collection($dictionaries);
    }
}
