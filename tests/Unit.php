<?php

namespace Tests;

use Bavix\Validator\Validator;

class Unit extends \Bavix\Tests\Unit
{

    /**
     * @var Validator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new Validator();

        parent::setUp();
    }

}
