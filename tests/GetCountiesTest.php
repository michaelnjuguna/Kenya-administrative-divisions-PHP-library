<?php

namespace Tests;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;

class GetCountiesTest extends TestCase
{
    use TestUtils;
    public function test_no_params_passed(): void
    {
        $result = KenyaAdministrativeDivisions::getCounties();
        $this->assertIsArray($result);
        $this->assertCount(47, $result);
    }
    public function test_valid_number_param(): void
    {
        $result = KenyaAdministrativeDivisions::getCounties(countyCode: 1);
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->expectValidCounty(
            $result[0],
            $result[0]->county_code,
            $result[0]->county_name
        );
    }
}