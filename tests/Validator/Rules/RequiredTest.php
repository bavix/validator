<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class RequiredTest extends Unit
{

    public function testUnit()
    {

        $data = [
            'number' => 0x12333,
            'age'    => 23,
        ];

        $fields = [
            'number' => 'required',
            'age'    => 'required'
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        unset($data['age']);

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertFalse($response->has('number'));
        $this->assertTrue($response->has('age'));

    }

}
