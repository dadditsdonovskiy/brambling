<?php

namespace App\Services\Word;

use App\Exceptions\GeneralException;
use App\Models\Dictionary;
use App\Models\Word;

/**
 * Service for creation new Word record
 */
class CreateService
{
    /**
     * @param $data
     * @param int $dictionary_id
     * @return Word
     * @throws GeneralException
     */
    public function create($data, int $dictionary_id): Word
    {
        $word = Word::query()->create(
            [
                'name' => $data['name'],
                'dictionary_id' => $dictionary_id,
            ]
        );
        if ($word) {

            return $word;
        }
        throw new GeneralException(__('exceptions.backend.word.create_error'));
    }
}
