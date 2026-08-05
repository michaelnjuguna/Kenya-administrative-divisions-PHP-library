<?php

namespace MichaelNjuguna\KenyaAdministrativeDivisions;

use MichaelNjuguna\KenyaAdministrativeDivisions\src\MainController;


class KenyaAdministrativeDivisions
{
    public static function getAll(): array
    {
        return (new MainController())->getAll();
    }
}

