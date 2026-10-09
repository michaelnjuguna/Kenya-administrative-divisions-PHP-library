<?php
declare(strict_types=1);

namespace Tests;
use InvalidArgumentException;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use MichaelNjuguna\KenyaAdministrativeDivisions\Models\Ward;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;


#[Group('wards')]
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

    public function test_invalid_county_name_returns_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county name.");
        KenyaAdministrativeDivisions::getWards(countyName: 'Invalid name');
    }
    public function test_valid_county_name_returns_wards(): void
    {
        $result = KenyaAdministrativeDivisions::getWards(countyName: 'Mombasa');
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(Ward::class, $result[0]);
    }


    public function test_invalid_constituency_name_returns_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid constituency name.");
        KenyaAdministrativeDivisions::getWards(constituencyName: 'Invalid name');
    }

    public function test_valid_constituencyName_name_returns_wards(): void
    {
        $result = KenyaAdministrativeDivisions::getWards(constituencyName: 'Changamwe');
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(Ward::class, $result[0]);
    }

}