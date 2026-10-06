<?php
declare(strict_types=1);

namespace MichaelNjuguna\KenyaAdministrativeDivisions\src;

use Exception;
use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use MichaelNjuguna\KenyaAdministrativeDivisions\Models\{Constituency, Ward, County};
use MichaelNjuguna\KenyaAdministrativeDivisions\src\Actions\{GetAll, GetConstituencies, GetConstituencyNames, GetCounties, GetWards};
use MichaelNjuguna\KenyaAdministrativeDivisions\src\Core\{GetConstituenciesParams, GetCountiesParams, GetWardsParams};

// Use foreach loops instead of nested for loops
class MainController
{

    private $data;

    // Constructor to read a JSON file
    public function __construct()
    {
        $path = __DIR__ . '/Core/county.json';
        $jsonData = file_get_contents($path);
        $data = json_decode($jsonData, true);
        if ($this->data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Failed to parse JSON file: ' . json_last_error_msg());
        }
        $this->data = array_map(
            fn(array $county) => new County(
                county_code: $county['county_code'],
                county_name: $county['county_name'],
                constituencies: array_map(
                    fn(array $constituency) => new Constituency(
                        constituency_name: $constituency['constituency_name'],
                        wards: array_map(
                            fn(mixed $ward) => new Ward(
                                name: is_string($ward) ? $ward : ($ward['name'] ?? '')
                            ),
                            $constituency['wards'] ?? []
                        )
                    ),
                    $county['constituencies'] ?? []
                )
            ),
            $data
        );
    }

    /**
     * @return County[]
     */
    public function getAll(): array
    {
        return GetAll::execute($this->data);

    }
    /**
     * @return County[]
     * @throws Exception
     */

    public function getCounties(
        ?int $countyCode = null,
        ?string $countyName = null
    ): array {
        $params = new GetCountiesParams(
            countyCode: $countyCode,
            countyName: $countyName
        );
        return GetCounties::execute($this->data, $params);
    }
    /**
     * @return String[]
     * @throws Exception
     */

    public function getCountyNames()
    {
        try {
            return array_map(fn($county) => $county->county_name, $this->data);
        } catch (\Throwable $th) {
            throw new Exception("Failed to get county names: " . $th->getMessage(), 0, $th);
        }
    }

    /**
     * @return Constituency[]
     * @throws Exception
     */

    public function getConstituencies(
        ?int $countyCode = null,
        ?string $countyName = null,
        ?string $constituencyName = null
    ): array {
        $params = new GetConstituenciesParams(
            countyCode: $countyCode,
            countyName: $countyName,
            constituencyName: $constituencyName
        );
        return GetConstituencies::execute($this->data, $params);
    }

    /**
     * @return String[]
     * @throws Exception
     */
    public function getConstituencyNames(
        ?int $countyCode = null,
        ?string $countyName = null,
    ): array {
        $params = new GetWardsParams(
            countyCode: $countyCode,
            countyName: $countyName,
        );
        return GetConstituencyNames::execute($this->data, $params);
    }

    /**
     * @return Constituency[]
     * @throws Exception
     */

    public function getWards(
        ?int $countyCode = null,
        ?string $countyName = null,
        ?string $constituencyName = null
    ): array {
        $params = new GetWardsParams(
            countyCode: $countyCode,
            countyName: $countyName,
            constituencyName: $constituencyName
        );
        return GetWards::execute($this->data, $params);
    }


}

