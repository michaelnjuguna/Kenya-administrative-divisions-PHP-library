<?php

namespace Tests;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;

class GetAllTest extends TestCase
{
    public function test_get_all(): void
    {
        $counties = KenyaAdministrativeDivisions::getAll();
        $this->assertIsArray($counties);
    }
}