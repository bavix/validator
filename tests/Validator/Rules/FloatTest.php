<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class FloatTest extends Unit
{

    public function testUnit()
    {

        $data = [
            'float'  => '123.1',
            'number' => 123.1,
            'age'    => '23',
            'length' => 9503
        ];

        $fields = [
            'no-float' => 'float',
            'float'    => 'float',
            'number'   => 'float',
            'age'      => 'float',
            'length'   => 'float',
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        $data['no-float'] = '123,1';

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertFalse($response->has('number'));
        $this->assertTrue($response->has('no-float'));

    }

}
