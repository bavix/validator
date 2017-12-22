<?php

namespace Bavix\Validator\Rules;

use Bavix\Exceptions\Invalid;
use Bavix\Validator\Rule;
use Bavix\Slice\Slice;

class FloatRule extends Rule
{

    /**
     * @var int
     */
    protected static $code = self::RULE_FLOAT;

    /**
     * @var string
     */
    protected static $error = 'must be an float';

    /**
     * @param string      $key
     * @param array|Slice $data
     * @param string|null $argument
     *
     * @return bool|void
     */
    public function validate(string $key, &$data, string $argument = null)
    {
        if (parent::validate($key, $data, $argument))
        {
            $val = \filter_var($data[$key], FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);

            if (\is_float($val))
            {
                return;
            }
        }

        throw new Invalid($this->error(), static::$code);
    }

}
