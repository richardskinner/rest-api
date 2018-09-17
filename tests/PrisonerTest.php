<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Framework\Services\BinaryConverter;

class PrisonerTest extends TestCase
{
    public $binaryConverter;

    public function setUp()
    {
        include __DIR__ . '/../application/config/functions.php';
        $this->binaryConverter = new BinaryConverter();
    }

    public function providerNonBinary()
    {
        return [
            ['abcdefghijklmnopqrstuvwxyz']
        ];
    }

    public function providerBinary()
    {
        return [
            ['01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111'],
            ['01000100 01100101 01110100 01100101 01101110 01110100 01101001 01101111 01101110 00100000 01000010 01101100 01101111 01100011 01101011 00100000 01000001 01000001 00101101 00110010 00110011 00101100']
        ];
    }

    /**
     * @dataProvider providerNonBinary
     */
    public function testTranslateReturnFalseIfNotBinary($binary)
    {
        $this->assertFalse($this->binaryConverter->translate($binary));
    }

    /**
     * @dataProvider providerBinary
     */
    public function testTranslateRespondsWithHumanReadableCharacters($binary)
    {
        $response = $this->binaryConverter->translate($binary);

        $this->assertRegExp("/^([\w\s-,]+)$/", $response);
    }
}
