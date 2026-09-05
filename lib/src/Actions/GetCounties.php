<?php
namespace MichaelNjuguna\KenyaAdministrativeDivisions\src\Actions;

use InvalidArgumentException;

use MichaelNjuguna\KenyaAdministrativeDivisions\Models\County;

class GetCounties
{
    /**
     * @param County[]|null $countyData
     * @param object|null $params
     * @return County[]  <-- PHPDoc specifies this is an array of County objects
     * @throws Exception
     */

    public static function execute(?array $countyData = null, ?object $params = null): array
    {
        try {
            if ($countyData === null) {
                throw new Exception("Unable to read county data");
            }
            if ($params === null || ($params->countyCode === null && empty($params->countyName))) {
                return $countyData;
            }
            if (isset($params->countyCode)) {
                if ($params->countyCode < 1 || $params->countyCode > 47) {
                    throw new InvalidArgumentException("Invalid county code. County code should be between 1 and 47");
                }
                $index = $params->countyCode - 1;
                return isset($countyData[$index]) ? [$countyData[$index]] : [];
            }
            if (!empty($params->countyName)) {
                $target = strtolower($params->countyName);


                foreach ($countyData as $county) {
                    $countyName = is_array($county) ? $county['county_name'] : $county->county_name;
                    if (strtolower($countyName) === $target) {
                        return [$county];
                    }
                }
                return [];
            }
            return [];
        } catch (Exception $error) {
            throw new Exception(
                $error instanceof Exception ? $error->getMessage() : "An unknown error occurred"
            );
        }
    }
}