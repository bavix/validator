<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class IntTest extends Unit
{

    public function testBool()
    {

        $data = [
            'number' => 0x12333,
            'age'    => '23',
            'length' => 9503
        ];

        $fields = [
            'number' => 'int',
            'age'    => 'int',
            'length' => 'int',
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        $data['age'] = 'nothing';

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertFalse($response->has('number'));
        $this->assertTrue($response->has('age'));

    }

}
