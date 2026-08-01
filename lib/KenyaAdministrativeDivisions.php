<?php

namespace MichaelNjuguna\KenyaAdministrativeDivisions;



class KenyaAdministrativeDivisions
{
    public static function getAll(): array
    {
        return (new MainController())->getAll();
    }
}

