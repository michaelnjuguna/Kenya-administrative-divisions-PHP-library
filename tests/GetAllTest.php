<?php

namespace Tests;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;


class GetAllTest extends TestCase
{
    use TestUtils;
    public function testGetAll(): void
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