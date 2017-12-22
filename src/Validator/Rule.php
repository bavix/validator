<?php

namespace Bavix\Validator;

use Bavix\Helpers\Arr;

abstract class Rule
{

    const RULE_REQUIRED   = 1001;
    const RULE_INT        = self::RULE_REQUIRED + 1;
    const RULE_FLOAT      = self::RULE_INT + 1;
    const RULE_BOOL       = self::RULE_FLOAT + 1;
    const RULE_MIN        = self::RULE_BOOL + 1;
    const RULE_MAX        = self::RULE_MIN + 1;
    const RULE_LENGTH_MIN = self::RULE_MAX + 1;
    const RULE_LENGTH_MAX = self::RULE_LENGTH_MIN + 1;

    /**
     * @var int
     */
    protected static $code;

    /**
     * @var string
     */
    protected static $error;

    /**
     * @param mixed $argument
     *
     * @return string
     */
    protected function error($argument = null): string
    {
        if ($argument)
        {
            return \sprintf(static::$error, $argument);
        }

        return static::$error;
    }

    public function validate(string $key, &$data, string $argument = null)
    {
        return Arr::keyExists($data, $key);
    }

}
