<?php

namespace Tests;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;

class GetCountiesTest extends TestCase
{
    public function testNoParamsPassed(): void
    {
        $result = KenyaAdministrativeDivisions::getCounties();
        $this->assertCount(47, $result);
    }
}