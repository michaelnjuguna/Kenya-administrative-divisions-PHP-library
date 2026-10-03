<?php
declare(strict_types=1);

namespace Tests;
use InvalidArgumentException;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use MichaelNjuguna\KenyaAdministrativeDivisions\Models\Ward;
use PHPUnit\Framework\TestCase;

class GetWardsTest extends TestCase
{
    public function test_no_params_passed(): void
    {
        $result = KenyaAdministrativeDivisions::getWards();
        $this->assertIsArray($result);
        $this->assertInstanceOf(Ward::class, $result[0]);

    }
    public function test_invalid_county_code_below_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");
        KenyaAdministrativeDivisions::getWards(countyCode: 0);

    }
    public function test_invalid_county_code_above_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");
        KenyaAdministrativeDivisions::getWards(countyCode: 48);

    }
    public function test_valid_county_code_returns_wards(): void
    {
        $result = KenyaAdministrativeDivisions::getWards(countyCode: 1);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(Ward::class, $result[0]);

    }

}