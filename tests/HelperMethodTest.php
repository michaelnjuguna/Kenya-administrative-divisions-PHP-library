<?php
declare(strict_types=1);

namespace Tests;
use InvalidArgumentException;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;


#[Group('Helper methods')]
class HelperMethodTest extends TestCase
{
    public function test_get_county_names(): void
    {
        $counties = KenyaAdministrativeDivisions::getCountyNames();
        $this->assertNotEmpty($counties);
        $this->assertIsArray($counties);

        $this->assertCount(47, $counties);
    }

    #[Group('get_constituency_names')]
    public function test_no_params_passed(): void
    {
        $constituencies = KenyaAdministrativeDivisions::getConstituencyNames();
        $this->assertNotEmpty($constituencies);
        $this->assertIsArray($constituencies);
        $this->assertContainsOnlyString($constituencies);
    }
    #[Group('get_constituency_names')]
    public function test_invalid_county_code_below_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");
        KenyaAdministrativeDivisions::getConstituencyNames(countyCode: 0);

    }
    #[Group('get_constituency_names')]
    public function test_invalid_county_code_above_range_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid county code. County code should be between 1 and 47");
        KenyaAdministrativeDivisions::getConstituencyNames(countyCode: 48);

    }
    #[Group('get_constituency_names')]
    public function test_valid_county_code_returns_constituency(): void
    {
        $result = KenyaAdministrativeDivisions::getConstituencyNames(countyCode: 1);
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyString($result);
        $this->assertEquals('Changamwe', $result[0]);
    }



}