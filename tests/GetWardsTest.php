<?php
declare(strict_types=1);

namespace Tests;
use InvalidArgumentException;

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;

class GetWardsTest extends TestCase
{
    public function test_no_params_passed(): void
    {
        $result = KenyaAdministrativeDivisions::getWards();

        $this->assertIsArray($result);
    }

}