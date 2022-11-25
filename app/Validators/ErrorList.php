<?php

namespace App\Validators;

/**
 * Class ErrorList
 * @package rest\components\validation
 * @codingStandardsIgnoreFile Generic.Files.LineLength.MaxExceeded
 */
class ErrorList
{
    public const EMAIL_INVALID = 1010;

    public const DATE_INVALID = 1020;
    public const DATE_TOO_SMALL = 1021;
    public const DATE_TOO_BIG = 1022;

    public const FILE_INVALID = 1030;
    public const FILE_WRONG_EXTENSION = 1034;
    public const FILE_TOO_BIG = 1035;
    public const FILE_TOO_SMALL = 1036;
    public const FILE_WRONG_MIME_TYPE = 1037;

    public const IMAGE_INVALID = 1040;
    public const IMAGE_UNDER_WIDTH = 1041;
    public const IMAGE_UNDER_HEIGHT = 1042;
    public const IMAGE_OVER_WIDTH = 1043;
    public const IMAGE_OVER_HEIGHT = 1044;

    public const NUMBER_INVALID = 1050;
    public const NUMBER_INTEGER_ONLY = 1051;
    public const NUMBER_TOO_SMALL = 1052;
    public const NUMBER_TOO_BIG = 1053;

    public const REQUIRED_INVALID = 1060;
    public const REQUIRED_VALUE = 1061;

    public const REGULAR_EXPRESSION_INVALID = 1070;

    public const STRING_INVALID = 1080;
    public const STRING_TOO_SHORT = 1081;
    public const STRING_TOO_LONG = 1082;
    public const STRING_NOT_EQUAL = 1083;

    public const URL_INVALID = 1090;

    public const BOOLEAN_INVALID = 1100;

    public const COMPARE_EQUAL = 1110;
    public const COMPARE_NOT_EQUAL = 1111;
    public const COMPARE_GREATER_THEN = 1112;
    public const COMPARE_GREATER_OR_EQUAL = 1113;
    public const COMPARE_LESS_THEN = 1114;
    public const COMPARE_LESS_OR_EQUAL = 1115;

    public const IN_INVALID = 1120;

    public const IP_INVALID = 1130;
    public const IP_V6_NOT_ALLOWED = 1131;
    public const IP_V4_NOT_ALLOWED = 1132;
    public const IP_WRONG_CIDR = 1133;
    public const IP_NO_SUBNET = 1134;
    public const IP_HAS_SUBNET = 1135;
    public const IP_NOT_IN_RANGE = 1136;

    public const UNIQUE_INVALID = 1150;
    public const UNIQUE_COMBO_INVALID = 1151;

    public const EXIST_INVALID = 1160;

    public const PHONE_NUMBER_INVALID = 1170;
    public const PASSWORD_INVALID = 1180;

    // Custom errors
    public const CAPTCHA_INVALID = 1140;
    public const CREDENTIALS_INVALID = 1200;
    public const ENTITY_BLOCKED = 1210;
    public const CURRENT_PASSWORD_IS_WRONG = 1220;
    public const SAME_CURRENT_PASSWORD_AND_NEW_PASSWORD = 1230;

    public const THIRD_PARTY_NOT_DOCUMENTED_ERROR = 3000;

    //facebook oauth error
    public const FACEBOOK_INVALID_APP_SECRET = 3101;
    public const FACEBOOK_ERROR_TOKEN_VALIDATION = 3102;
    public const FACEBOOK_INVALID_OAUTH_TOKEN = 3103;
    public const FACEBOOK_MALFORMED_ACCESS_TOKEN = 3104;

    //linkedin oauth error
    public const LINKEDIN_INVALID_OAUTH_TOKEN = 3203;

    //google oauth error
    public const GOOGLE_INVALID_OAUTH_TOKEN = 3303;

    //twitter oauth error
    public const TWITTER_INVALID_OAUTH_TOKEN = 3403;

    public const VALIDATOR_ERRORS = [
        'validation.integer' => self::NUMBER_INTEGER_ONLY,
        'validation.numeric' => self::NUMBER_INVALID,
        'validation.date' => self::DATE_INVALID,
        'validation.before' => self::DATE_TOO_SMALL,
        'validation.after' => self::DATE_TOO_BIG,
        'validation.email' => self::EMAIL_INVALID,
        'validation.min.string' => self::STRING_TOO_SHORT,
        'validation.max.string' => self::STRING_TOO_LONG,
        'validation.min.numeric' => self::NUMBER_TOO_SMALL,
        'validation.max.numeric' => self::NUMBER_TOO_BIG,
        'validation.string' => self::STRING_INVALID,
        'validation.file' => self::FILE_INVALID,
        'validation.file.gte' => self::FILE_TOO_BIG,
        'validation.file.gt' => self::FILE_TOO_BIG,
        'validation.file.lte' => self::FILE_TOO_SMALL,
        'validation.file.lt' => self::FILE_TOO_SMALL,
        'validation.mimetypes' => self::FILE_WRONG_MIME_TYPE,
        'validation.regex' => self::REGULAR_EXPRESSION_INVALID,
        'validation.required' => self::REQUIRED_VALUE,
        'validation.image' => self::IMAGE_INVALID,
        'validation.url' => self::URL_INVALID,
        'validation.ip' => self::IP_INVALID,
        'validation.ipv4' => self::IP_V4_NOT_ALLOWED,
        'validation.ipv6' => self::IP_V6_NOT_ALLOWED,
        'validation.boolean' => self::BOOLEAN_INVALID,
        'validation.unique' => self::UNIQUE_INVALID,
        'validation.exists' => self::EXIST_INVALID,
        'validation.in' => self::IN_INVALID,
        'validation.phone_number_mask' => self::PHONE_NUMBER_INVALID,
        'validation.password' => self::PASSWORD_INVALID,
    ];

}
