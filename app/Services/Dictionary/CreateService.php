<?php

namespace App\Services\Dictionary;

use App\Exceptions\GeneralException;
use App\Models\Dictionary;

/**
 * Service for creation new Dictionary record
 */
class CreateService
{
    /**
     * @param $data
     * @return Dictionary
     * @throws GeneralException
     */
    public function create($data): Dictionary
    {
        $dictionary = Dictionary::query()->create(
            [
                'name' => $data['name'],
            ]
        );
        if ($dictionary) {

            return $dictionary;
        }
        throw new GeneralException(__('exceptions.backend.dictionaries.create_error'));
    }
}
