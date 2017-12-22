<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class MaxTest extends Unit
{

    public function testUnit()
    {

        $data = [
            'age' => 44,
            'number' => 3
        ];

        $fields = [
            'age'    => 'max:100',
            'number' => 'max:4',
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        $data['age'] = 101;

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertFalse($response->has('number'));
        $this->assertTrue($response->has('age'));

        $data['age'] = 'nothing';

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertFalse($response->has('number'));
        $this->assertTrue($response->has('age'));

    }

    /**
     * @expectedException \Bavix\Exceptions\Runtime
     */
    public function testException()
    {

        $data = [
            'age' => 44,
            'number' => 3
        ];

        $fields = [
            'age'    => 'max',
            'number' => 'max:4',
        ];

        $this->validator->apply($data, $fields);

    }

}
