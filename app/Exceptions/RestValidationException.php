<?php

namespace App\Exceptions;

use App\Validators\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class RestValidationException
 * @property Validator $validator
 * @package App\Exceptions
 */
class RestValidationException extends ValidationException
{
    /**
     * @return array
     */
    public function errors()
    {
        $errors = [];
        foreach ($this->validator->errors()->messages() as $attribute => $messages) {
            $failedRules = array_keys($this->validator->failed()[$attribute]);
            foreach ($messages as $key => $message) {
                $errors[] = [
                    'code' => $this->validator->getCode($attribute, $failedRules[$key]),
                    'field' => $attribute,
                    'message' => ucfirst($message),
                ];
            }
        }

        return $errors;
    }
}
