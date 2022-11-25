<?php

namespace App\Validators;

use Illuminate\Support\Str;
use Illuminate\Validation\Validator as BaseValidator;

class Validator extends BaseValidator
{
    use PhoneNumberValidator, PasswordValidator;

    public function getCode($attribute, $rule)
    {
        $lowerRule = Str::snake($rule);
        $key = "validation.{$lowerRule}";
        if (in_array($rule, $this->sizeRules)) {
            $type = $this->getAttributeType($attribute);
            $key .= ".{$type}";
        }

        return $this->getCodeByMessageKey($key);
    }

    private function getCodeByMessageKey(string $messageKey)
    {
        return ErrorList::VALIDATOR_ERRORS[$messageKey] ?? 0;
    }
}
