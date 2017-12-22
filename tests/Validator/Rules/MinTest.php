<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class MinTest extends Unit
{

    public function testUnit()
    {

        $data = [
            'age'    => 44,
            'number' => 3,
            'name'   => 'hello'
        ];

        $fields = [
            'age'    => 'min:10',
            'number' => 'min:2',
            'name'   => 'min:g'
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        $data['age'] = 9;
        $data['name'] = 'f';

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertFalse($response->has('number'));
        $this->assertTrue($response->has('age'));
        $this->assertTrue($response->has('name'));

    }

    /**
     * @expectedException \Bavix\Exceptions\Runtime
     */
    public function testException()
    {

        $data = [
            'age'    => 44,
            'number' => 3
        ];

        $fields = [
            'age'    => 'min',
            'number' => 'min:2',
        ];

        $this->validator->apply($data, $fields);

    }

}
