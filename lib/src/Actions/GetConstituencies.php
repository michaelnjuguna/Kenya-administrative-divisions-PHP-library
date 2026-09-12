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
            if (
                $params === null || (
                    $params->countyCode === null &&
                    $params->countyName === null &&
                    $params->constituencyName === null
                )
            ) {
                return array_merge(
                    ...array_map(
                        fn($countyData) => $countyData->constituencies,
                        $countyData
                    )
                );
            }
            if (isset($params->countyCode)) {
                if ($params->countyCode < 1 || $params->countyCode > 47) {
                    throw new InvalidArgumentException("Invalid county code. County code should be between 1 and 47");
                }
                $index = $params->countyCode - 1;
                return isset($countyData[$index]) ? $countyData[$index]->constituencies : [];
            }
            if (isset($params->countyName)) {
                $target = strtolower($params->countyName);
                foreach ($countyData as $county) {
                    $countyName = is_array($county) ? $county['county_name'] : $county->county_name;
                    if (strtolower($countyName) === $target) {
                        return [$county];
                    }
                }
                throw new InvalidArgumentException("Invalid county name");

            }

        } catch (\Throwable $th) {
            //throw $th;
            throw new \RuntimeException(
                'Failed to get constituencies: ' . $th->getMessage(),
                0,
                $th
            );
        }
    }

}