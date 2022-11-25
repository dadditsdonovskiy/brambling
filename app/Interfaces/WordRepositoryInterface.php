<?php

namespace App\Interfaces;

/**
 * WordRepositoryInterface
 */
interface WordRepositoryInterface
{
    public function getAllWordsByDictionaryId(int $id);
}
