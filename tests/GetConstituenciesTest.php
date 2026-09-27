<?php
declare(strict_types=1);

namespace Tests;
use InvalidArgumentException;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;
class GetConstituenciesTest extends TestCase
{
    use TestUtils;
    public function test_no_params_passed(): void
    {
        $result = KenyaAdministrativeDivisions::getConstituencies();

        $this->assertIsArray($result);
        $this->expectValidConstituency($result[0], 'Changamwe');

    }
    public function test_invalid_county_code_below_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");
        KenyaAdministrativeDivisions::getConstituencies(countyCode: 0);

    }
    public function test_invalid_county_code_above_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");
        $result = KenyaAdministrativeDivisions::getConstituencies(countyCode: 48);

    }
    public function test_valid_county_code_returns_constituency(): void
    {
        $result = KenyaAdministrativeDivisions::getConstituencies(countyCode: 1);
        $this->assertIsArray($result);
        $this->expectValidConstituency($result[0], 'Changamwe');
    }

    public function test_invalid_county_name_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county name");
        KenyaAdministrativeDivisions::getConstituencies(countyName: 'Invalid name');
    }
    public function test_valid_county_name_returns_array(): void
    {
        $result = KenyaAdministrativeDivisions::getConstituencies(countyName: 'Mombasa');
        $this->assertIsArray($result);
        $this->expectValidConstituency($result[0], 'Changamwe');
    }

    public function test_invalid_constituency_name_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid constituency name");
        KenyaAdministrativeDivisions::getConstituencies(constituencyName: 'Invalid constituency name');
    }
    public function test_valid_constituency_name_returns_array(): void
    {
        $result = KenyaAdministrativeDivisions::getConstituencies(constituencyName: 'Changamwe');
        $this->assertIsArray($result);
        $this->expectValidConstituency($result[0], 'Changamwe');


    }
}