<?php

namespace Bavix\Validator\Rules;

use Bavix\Exceptions\Invalid;
use Bavix\Validator\Rule;
use Bavix\Slice\Slice;

class RequiredRule extends Rule
{

    /**
     * @var int
     */
    protected static $code = self::RULE_REQUIRED;

    /**
     * @var string
     */
    protected static $error = 'is required';

    /**
     * @param string      $key
     * @param Slice|array $data
     * @param string      $argument
     *
     * @throws Invalid
     */
    public function validate(string $key, &$data, string $argument = null)
    {
        if (!parent::validate($key, $data, $argument))
        {
            throw new Invalid($this->error(), static::$code);
        }
    }

}
