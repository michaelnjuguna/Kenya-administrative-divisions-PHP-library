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
                        array_push($allWards, $constituency->wards);
                    }
                }
                return $allWards;
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