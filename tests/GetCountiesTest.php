<?php

namespace Tests;

use Exception;
use InvalidArgumentException;
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
    public function test_invalid_county_code_below_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");

        KenyaAdministrativeDivisions::getCounties(countyCode: 0);
    }

    public function test_invalid_county_code_above_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");

        KenyaAdministrativeDivisions::getCounties(countyCode: 48);
    }
    public function test_invalid_county_name(): void
    {
        $result = KenyaAdministrativeDivisions::getCounties(countyName: 'Invalid name');

        $this->assertIsArray($result);
        $this->assertCount(0, $result);

    }
    public function test_valid_county_name(): void
    {
        $result = KenyaAdministrativeDivisions::getCounties(countyName: 'mombasa');

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->expectValidCounty(
            $result[0],
            $result[0]->county_code,
            $result[0]->county_name
        );
    }

}