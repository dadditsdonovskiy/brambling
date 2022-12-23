<?php

namespace App\Http\Controllers\Api\Word;

use App\Http\Controllers\Controller;
use App\Models\Word;

/**
 * WordDeleteController
 */
class WordDeleteController extends Controller
{
    public function __invoke(int $id)
    {
        $word = Word::query()->findOrFail($id);
        if ($word) {
            $word->delete();

            return response(null, 204);
        }
        return response('word not found', 404);
    }
}
