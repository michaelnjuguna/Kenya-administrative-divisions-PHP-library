<?php

namespace Tests;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;

class HelperMethodTest extends TestCase
{
    public function test_get_county_names(): void
    {
        $counties = KenyaAdministrativeDivisions::getCountyNames();
        $this->assertNotEmpty($counties);
        $this->assertIsArray($counties);
        $this->assertContainsOnly('string', $counties, true);
        $this->assertCount(47, $counties);
    }

}