<?php

namespace App\Repositories;

use App\Interfaces\DictionaryRepositoryInterface;
use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;

/**
 * DictionaryRepository
 */
class DictionaryRepository implements DictionaryRepositoryInterface
{
    /**
     * Select dictionaries ordered by name length
     * @return Builder
     */
    public function getAllDictionaries(): Builder
    {
        return Dictionary::orderByRaw('CHAR_LENGTH(name)');
    }
}
