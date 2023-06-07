<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CsvMapContentsTest extends TestCase
{
    public function testCsvMapContentsSingleLineSuccess()
    {
        $lineContents = ['Kim', 'kimj@example.com'];
        $mappings = [0 => 'name', 1 => 'email'];
        $expected = ['name' => 'Kim', 'email' => 'kimj@example.com'];
        $result = csv_map_contents($lineContents, $mappings);
        $this->assertEquals($expected, $result);
    }

    public function testCsvMapContentsMultiLineSuccess()
    {
        $lineContents = [
            ['Kim', 'kimj@example.com'],
            ['Lee', 'lees@example.com'],
        ];
        $mappings = [0 => 'name', 1 => 'email'];
        $expected = [
            ['name' => 'Kim', 'email' => 'kimj@example.com'],
            ['name' => 'Lee', 'email' => 'lees@example.com'],
        ];
        $result = csv_map_contents($lineContents, $mappings, true);
        $this->assertEquals($expected, $result);
    }

    public function testCsvMapContentsSingleLineInvalidMapping()
    {
        $lineContents = ['Kim', 'kimj@example.com'];
        $mappings = [];
        $expected = [];
        $result = csv_map_contents($lineContents, $mappings);
        $this->assertEquals($expected, $result);
    }

    public function testCsvMapContentsMultiLineInvalidMapping()
    {
        $lineContents = [
            ['Kim', 'kimj@example.com'],
            ['Lee', 'lees@example.com'],
        ];
        $mappings = [];
        $expected = [];
        $result = csv_map_contents($lineContents, $mappings, true);
        $this->assertEquals($expected, $result);
    }
}
