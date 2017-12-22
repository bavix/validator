<?php

namespace Bavix\Validator;

class Response
{

    /**
     * @var bool
     */
    protected $valid;

    /**
     * @var array
     */
    protected $data;

    /**
     * Response constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data  = $data;
        $this->valid = empty($data);
    }

    /**
     * @param string $property
     *
     * @return bool
     */
    public function has(string $property): bool
    {
        return isset($this->data[$property]);
    }

    /**
     * @param string $property
     *
     * @return \Exception
     */
    public function first(string $property): \Exception
    {
        return $this->errors($property)[0];
    }

    /**
     * @param string $property
     *
     * @return array
     */
    public function errors(string $property): array
    {
        return $this->data[$property];
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->valid;
    }

}
