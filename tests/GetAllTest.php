<?php
declare(strict_types=1);

namespace Tests;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('All')]
class GetAllTest extends TestCase
{
    use TestUtils;
    public function test_get_all(): void
    {
        $counties = KenyaAdministrativeDivisions::getAll();
        $this->assertIsArray($counties);
        $this->assertCount(47, $counties);
        $this->expectValidCounty(
            $counties[0],
            $counties[0]->county_code,
            $counties[0]->county_name
        );

    }
}