<?php

namespace App\Repositories;

use App\Interfaces\WordRepositoryInterface;
use App\Models\Word;
use Illuminate\Database\Eloquent\Builder;

/**
 * WordRepository
 */
class WordRepository implements WordRepositoryInterface
{
    /**
     * Select dictionaries ordered by name length
     * @return Builder
     */
    public function getAllWordsByDictionaryId(int $id): Builder
    {
        return Word::where('dictionary_id', $id)->orderByRaw('CHAR_LENGTH(name)');
    }
}
