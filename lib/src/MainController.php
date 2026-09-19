<?php

namespace MichaelNjuguna\KenyaAdministrativeDivisions\src;

use Exception;
use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use MichaelNjuguna\KenyaAdministrativeDivisions\Models\{Constituency, Ward, County};
use MichaelNjuguna\KenyaAdministrativeDivisions\src\Actions\{GetAll, GetConstituencies, GetCounties};
use MichaelNjuguna\KenyaAdministrativeDivisions\src\Core\{GetConstituenciesParams, GetCountiesParams};

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
     * @return Constituency[]
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

    public function getWards($county = null, $constituency = null)
    {
        $wards = [];
        // When no parameter is provided
        if ($county === null && $constituency === null) {
            for ($i = 0; $i < sizeof($this->data); $i++) {
                for ($j = 0; $j < sizeof($this->data[$i]['constituencies']); $j++) {
                    for ($k = 0; $k < sizeof($this->data[$i]['constituencies'][$j]['wards']); $k++) {
                        array_push($wards, $this->data[$i]['constituencies'][$j]['wards'][$k]);

                    }
                }
            }
        }

        // When only the county name or code is provided
        if (!!$county && $constituency === null) {
            if (is_int($county)) {
                for ($i = 0; $i < sizeof($this->data[$county - 1]['constituencies']); $i++) {
                    foreach ($this->data[$county - 1]['constituencies'][$i]['wards'] as $wardInfo) {
                        array_push($wards, $wardInfo);
                    }
                }
            } else if (is_string($county)) {
                for ($i = 0; $i < sizeof($this->data); $i++) {
                    if (strtolower($this->data[$i]['county_name']) === strtolower($county)) {
                        for ($j = 0; $j < sizeof($this->data[$i]['constituencies']); $j++) {

                            foreach ($this->data[$i]['constituencies'][$j]['wards'] as $wardInfo) {
                                array_push($wards, $wardInfo);
                            }

                        }
                        break;
                    }

                }
            }
        } else if (!!$county === false && !!$constituency) {
            for ($i = 0; $i < sizeof($this->data); $i++) {
                for ($j = 0; $j < sizeof($this->data[$i]['constituencies']); $j++) {
                    if (strtolower($this->data[$i]['constituencies'][$j]['constituency_name']) === strtolower($constituency)) {
                        $wards = $this->data[$i]['constituencies'][$j]['wards'];
                        break;
                    }
                }
            }
        } else if (!!$county && !!$constituency) {
            if (is_int($county) && $county > 0 && $county < 48) {
                for ($i = 0; $i < sizeof($this->data[$county - 1]['constituencies']); $i++) {
                    if (strtolower($this->data[$county - 1]['constituencies'][$i]['constituency_name']) === strtolower($constituency)) {
                        $wards = $this->data[$county - 1]['constituencies'][$i]['wards'];
                        break;
                    }
                }
            } else if (is_string($county)) {
                for ($i = 0; $i < sizeof($this->data); $i++) {
                    if (strtolower($this->data[$i]['county_name']) === strtolower($county)) {
                        for ($j = 0; $j < sizeof($this->data[$i]['constituencies']); $j++) {
                            if (strtolower($this->data[$i]['constituencies'][$j]['constituency_name']) === strtolower($constituency)) {
                                $wards = $this->data[$i]['constituencies'][$j]['wards'];
                                break;
                            }
                        }
                        break;
                    }
                }
            }
        }

        if (empty($wards)) {
            return 'Error: Invalid parameter provided. Please check your input and try again.';
        }

        return $wards;
    }
}

// Test
$test = new KenyaAdministrativeDivisions();
