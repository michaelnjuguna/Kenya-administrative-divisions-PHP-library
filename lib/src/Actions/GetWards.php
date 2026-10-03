<?php
declare(strict_types=1);

namespace MichaelNjuguna\KenyaAdministrativeDivisions\src\Actions;

use InvalidArgumentException;
class GetWards
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
                $allWards = [];
                foreach ($countyData as $county) {
                    foreach ($county->constituencies as $constituency) {
                        array_push($allWards, ...$constituency->wards);
                    }
                }

                return $allWards;
            }

            // TODO: County code
            if (isset($params->countyCode)) {
                if ($params->countyCode < 1 || $params->countyCode > 47) {
                    throw new InvalidArgumentException("Invalid county code. County code should be between 1 and 47");
                }
                $index = $params->countyCode - 1;
                $wards = [];
                foreach ($countyData[$index]->constituencies as $constituency) {
                    array_push($wards, ...$constituency->wards);
                }
                return $wards;
            }
            // TODO: County name

            // TODO: Constituency name



        } catch (InvalidArgumentException $e) {
            throw $e;
        } catch (\Throwable $th) {
            //throw $th;
            throw new \RuntimeException(
                'Failed to get wards: ' . $th->getMessage(),
                0,
                $th
            );
        }
    }
}