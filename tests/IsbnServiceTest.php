<?php

use App\Provider\IsbnServiceProvider;

class IsbnServiceTest extends \PHPUnit\Framework\TestCase
{

    public function testCharCodeAt()
    {
        $isbn = new IsbnServiceProvider(1);
        $this->assertEquals(55, $$isbn->charCodeAt(65));
    }


    public function testValidHongkonId()
    {
        $isbn = new IsbnServiceProvider(1);
        $this->assertEquals(true, $$isbn->validHongkonId('Z780608(7)'));
    }

}