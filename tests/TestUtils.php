<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use MichaelNjuguna\KenyaAdministrativeDivisions\Models\County;

trait TestUtils
{
    private function expectValidCounty(
        County $county,
        int $expectedCode,
        string $expectedName
    ): void {
        $this->assertInstanceOf(County::class, $county);
        $this->assertEquals($expectedCode, $county->county_code);
        $this->assertEquals($expectedName, $county->county_name);
        $this->assertIsArray($county->constituencies);
    }
}