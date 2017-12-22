<?php

namespace Bavix\Validator;

use Bavix\Exceptions\Runtime;
use Bavix\Helpers\Arr;

class Validator
{

    /**
     * @var Rule[]
     */
    protected static $rules = [];

    /**
     * @var array
     */
    protected $ruleMap = [
        'required'  => Rules\RequiredRule::class,
        'int'       => Rules\IntRule::class,
        'float'     => Rules\FloatRule::class,
        'bool'      => Rules\BoolRule::class,
        'min'       => Rules\MinRule::class,
        'max'       => Rules\MaxRule::class,
        'lengthMin' => Rules\LengthMinRule::class,
        'lengthMax' => Rules\LengthMaxRule::class,
    ];

    /**
     * Validator constructor.
     *
     * @param array $map
     */
    public function __construct(array $map = [])
    {
        if (!empty($map))
        {
            $this->ruleMap = Arr::merge($this->ruleMap, $map);
        }
    }

    /**
     * @param $name
     *
     * @return Rule
     */
    protected function rule($name): Rule
    {
        if (empty(static::$rules[$name]))
        {
            if (empty($this->ruleMap[$name]))
            {
                throw new Runtime('Rule `' . $name . '` not found');
            }

            $class = $this->ruleMap[$name];

            static::$rules[$name] = new $class();
        }

        return static::$rules[$name];
    }

    /**
     * @param string $offset
     * @param array  $options
     * @param array  $data
     *
     * @return array
     */
    protected function build(string $offset, array $options, &$data): array
    {
        $errors = [];

        foreach ($options as $option)
        {
            $arguments = \explode(':', $option, 2);

            $name = $arguments[0];
            $arg  = $arguments[1] ?? null;
            $rule = $this->rule($name);

            try
            {
                $rule->validate(
                    $offset,
                    $data,
                    $arg
                );
            }
            catch (\Throwable $throwable)
            {
                $errors[] = $throwable;
            }
        }

        return $errors;
    }

    /**
     * @param array $datum
     * @param array $fields
     *
     * @return Response
     */
    public function apply(array $datum, array $fields): Response
    {
        $errors = [];

        foreach ($fields as $field => $_rules)
        {
            $rules = $_rules;

            if (\is_string($_rules))
            {
                $rules = explode('|', $_rules);
            }

            $data = $this->build($field, $rules, $datum);

            if (!empty($data))
            {
                $errors[$field] = $data;
            }
        }

        return new Response($errors);
    }

}
