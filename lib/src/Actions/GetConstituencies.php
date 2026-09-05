<?php

namespace MichaelNjuguna\KenyaAdministrativeDivisions\src\Actions;

use InvalidArgumentException;

use MichaelNjuguna\KenyaAdministrativeDivisions\Models\County;

class GetConstituencies
{
    public static function execute(?array $countyData = null, ?object $params = null)
    {
        try {
            if ($countyData === null) {
                throw new Exception("Unable to read county data");
            }
            if ($params === null) {
                return array_map(fn($county) => $county->constituencies, $countyData);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}