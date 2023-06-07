<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CsvGetContentsTest extends TestCase
{
    public function testCsvGetContentsSuccess()
    {
        $filepath = __DIR__ . '/test.csv';
        $expected = [['name', 'email'], ['Kim', 'kimj@example.com'], ['Lee', 'lees@example.com']];
        $result = csv_get_contents($filepath);
        $this->assertEquals($expected, $result);
    }

    public function testCsvGetContentsFileNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("The file 'invalid.csv' cannot be read.");
        csv_get_contents('invalid.csv');
    }
}
