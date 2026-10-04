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

            if (isset($params->countyName)) {
                $countyName = strtolower($params->countyName);
                $countyWards = [];
                foreach ($countyData as $county) {
                    if (strtolower($county->county_name) === $countyName) {
                        foreach ($county->constituencies as $constituency) {
                            array_push($countyWards, ...$constituency->wards);
                        }
                        return $countyWards;
                    }

                }
                throw new InvalidArgumentException("Invalid county name.");
            }


            if (isset($params->constituencyName)) {
                $constituencyName = strtolower($params->constituencyName);
                foreach ($countyData as $county) {
                    foreach ($county->constituencies as $constituency) {
                        if (strtolower($constituency->constituency_name) === $constituencyName) {
                            return $constituency->wards;
                        }
                    }
                }
                throw new InvalidArgumentException("Invalid constituency name.");
            }


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