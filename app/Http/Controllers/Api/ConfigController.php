<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Validators\ErrorList;

class ConfigController extends Controller
{
    public function __invoke()
    {
        $errors = [];
        foreach (ErrorList::VALIDATOR_ERRORS as $messageKey => $code) {
            $errors[$code] = trans($messageKey);
        }

        return [
            'version' => [
                'major' => 0,
                'minor' => 1,
                'patch' => 1,
                'commit' => null,
            ],
            'parameters' => [],
            'errors' => $errors,
        ];
    }
}
