<?php

namespace Faker\Test\Provider\zh_CN;

use Faker\Factory;
use Faker\Provider\zh_CN\Text;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public static function getGenerator()
    {
        return Factory::create('zh_CN');
    }

    public function testRealTextNoSpacing()
    {
        $faker = static::getGenerator();
        $this->assertNotRegExp('/\\s/u', $faker->realText());
    }

    public function testRealTextEndPunctuaction()
    {
        $notEndPunct = $this->readAttribute('Faker\Provider\zh_CN\Text', 'notEndPunct');
        $endPunct = $this->readAttribute('Faker\Provider\zh_CN\Text', 'endPunct');
        $faker = static::getGenerator();

        $this->assertTrue(in_array(mb_substr($faker->realText(), -1, 1), $endPunct));
        $this->assertFalse(in_array(mb_substr($faker->realText(), -1, 1), $notEndPunct));
    }

    public function testRealTextBeginPunctuaction()
    {
        $notBeginPunct = $this->readAttribute('Faker\Provider\zh_CN\Text', 'notBeginPunct');
        $faker = static::getGenerator();

        $this->assertFalse(in_array(mb_substr($faker->realText(), 0, 1), $notBeginPunct));
    }
}
