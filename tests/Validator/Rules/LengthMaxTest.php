<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class LengthMaxTest extends Unit
{

    public function testUnit()
    {

        $data = [
            'login'    => 'bavix',
        ];

        $fields = [
            'login'    => 'lengthMax:5',
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        $data['login'] = 'validator';

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertTrue($response->has('login'));

    }

    /**
     * @expectedException \Bavix\Exceptions\Runtime
     */
    public function testException()
    {

        $data = [
            'login'    => 'bavix',
        ];

        $fields = [
            'login'    => 'lengthMax',
        ];

        $this->validator->apply($data, $fields);

    }

}
