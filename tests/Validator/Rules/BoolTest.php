<?php

namespace Tests\Validator\Rules;

use Bavix\Validator\Response;
use Tests\Unit;

class BoolTest extends Unit
{

    public function testBool()
    {

        $data = [
            'yes'   => 'yes',
            'no'    => 'no',
            'on'    => 'on',
            'off'   => 'off',
            '0'     => '0',
            '1'     => '1',
            'true'  => true,
            'false' => false,
        ];

        $fields = [
            'yes'   => 'bool',
            'no'    => 'bool',
            'on'    => 'bool',
            'off'   => 'bool',
            '0'     => 'bool',
            '1'     => 'bool',
            'true'  => 'bool',
            'false' => 'bool',
        ];

        $response = $this->validator->apply($data, $fields);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->valid());

        $data['on'] = 'nothing';

        $response = $this->validator->apply($data, $fields);

        $this->assertFalse($response->valid());
        $this->assertFalse($response->has('yes'));
        $this->assertTrue($response->has('on'));

    }

}
