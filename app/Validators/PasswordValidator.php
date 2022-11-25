<?php

namespace App\Validators;

trait PasswordValidator
{

    /**
     * Validate that an attribute passes a regular expression check.
     *
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public function validatePassword($attribute, $value, $parameters) //NOSONAR
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        // should contain at least 10 symbols, one lower case, one upper case and one num.
        return preg_match('/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{10,255}/', $value) > 0;
    }
}
