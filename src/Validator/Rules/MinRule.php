<?php

namespace Bavix\Validator\Rules;

use Bavix\Exceptions\Invalid;
use Bavix\Exceptions\Runtime;
use Bavix\Slice\Slice;
use Bavix\Validator\Rule;

class MinRule extends Rule
{

    /**
     * @var int
     */
    protected static $code = self::RULE_MIN;

    /**
     * @var string
     */
    protected static $error = 'must be at least %s';

    /**
     * @param string      $key
     * @param Slice|array $data
     * @param string      $argument
     *
     * @throws Invalid
     */
    public function validate(string $key, &$data, string $argument = null)
    {
        if ($argument === null)
        {
            throw new Runtime(__CLASS__);
        }

        if (parent::validate($key, $data, $argument) && $data[$key] < $argument)
        {
            throw new Invalid($this->error($argument), static::$code);
        }
    }

}
