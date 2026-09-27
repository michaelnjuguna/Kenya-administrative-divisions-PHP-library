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