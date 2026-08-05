<?php

namespace Tests;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;


class GetAllTest extends TestCase
{
    use TestUtils;
    public function test_get_all(): void
    {
        $counties = KenyaAdministrativeDivisions::getAll();
        $this->assertIsArray($counties);
        $this->assertCount(47, $counties);
        print_r($counties[0]);
        $this->expectValidCounty(
            $counties[0],
            $counties[0]->county_code,
            $counties[0]->county_name
        );

    }
}