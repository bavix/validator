<?php

namespace Bavix\Validator\Rules;

use Bavix\Exceptions\Invalid;
use Bavix\Validator\Rule;
use Bavix\Slice\Slice;

class BoolRule extends Rule
{

    /**
     * @var int
     */
    protected static $code = self::RULE_BOOL;

    /**
     * @var string
     */
    protected static $error = 'must be an bool';

    /**
     * @param string      $key
     * @param Slice|array $data
     * @param string      $argument
     *
     * @throws Invalid
     */
    public function validate(string $key, &$data, string $argument = null)
    {
        if (parent::validate($key, $data, $argument))
        {
            $val = \filter_var($data[$key], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

            if (\is_bool($val))
            {
                return;
            }

            throw new Invalid($this->error(), static::$code);
        }
    }

}
