<?php

namespace App\Http\Controllers\Api\Dictionary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dictionary\CreateWordRequest;
use App\Http\Resources\Api\Dictionary\WordResource;
use App\Models\Dictionary;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

/**
 * DictionaryDeleteController
 */
class DictionaryDeleteController extends Controller
{
    /**
     * @param int $id
     * @return Application|ResponseFactory|Response|void
     */
    public function __invoke(int $id)
    {
        $dictionary = Dictionary::findOrfail($id);
        if ($dictionary) {
            $dictionary->delete();

            return response(null, 204);
        }
    }
}
