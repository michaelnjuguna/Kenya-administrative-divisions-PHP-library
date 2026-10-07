<?php
declare(strict_types=1);

namespace MichaelNjuguna\KenyaAdministrativeDivisions\src\Actions;

use InvalidArgumentException;

class GetConstituencyNames
{
    public static function execute(?array $countyData = null, ?object $params = null)
    {
        try {
            if ($countyData === null) {
                throw new Exception("Unable to read county data");
            }
            if (
                $params === null || (
                    $params->countyCode === null &&
                    $params->countyName === null
                )
            ) {
                $result = [];
                foreach ($countyData as $county) {
                    foreach ($county->constituencies as $constituencies) {
                        array_push($result, $constituencies->constituency_name);
                    }
                }
                return $result;
            }
        } catch (\Throwable $th) {
            throw new Exception("Failed to get constituency names: " . $th->getMessage(), 0, $th);
        }
    }
}