<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class LengthMinTest extends Unit
{

    public function testUnit()
    {

        $data = [
            'login'    => 'bavix',
        ];

        $fields = [
            'login'    => 'lengthMin:4',
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        $data['login'] = 'bx';

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
            'login'    => 'lengthMin',
        ];

        $this->validator->apply($data, $fields);

    }

}
