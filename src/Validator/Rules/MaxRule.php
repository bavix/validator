<?php

namespace Bavix\Validator\Rules;

use Bavix\Exceptions\Invalid;
use Bavix\Exceptions\Runtime;
use Bavix\Slice\Slice;
use Bavix\Validator\Rule;

class MaxRule extends Rule
{

    /**
     * @var int
     */
    protected static $code = self::RULE_MAX;

    /**
     * @var string
     */
    protected static $error = 'must be no more than %s';

    /**
     * @param string      $key
     * @param Slice|array $data
     * @param string      $argument
     *
     * @throws Invalid
     */
    public function validate(string $key, &$data, string $argument = null)
    {
        if (null === $argument)
        {
            throw new Runtime(__CLASS__);
        }

        if (parent::validate($key, $data, $argument) && $data[$key] > $argument)
        {
            throw new Invalid($this->error($argument), static::$code);
        }
    }

}
