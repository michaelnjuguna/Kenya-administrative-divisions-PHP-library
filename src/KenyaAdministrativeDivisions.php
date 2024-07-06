<?php

namespace MichaelNjuguna\KenyaAdministrativeDivisions;

// Use foreach loops instead of nested for loops
class KenyaAdministrativeDivisions
{

    private $data;

    // Constructor to read a JSON file
    public function __construct()
    {
        $jsonData = file_get_contents(__DIR__ . '/county.json');
        $this->data = json_decode($jsonData, true);
        if ($this->data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Failed to parse JSON file: ' . json_last_error_msg());
        }
    }

    // Get all the information
    public function getAll()
    {
        return $this->data;

    }
    public function getCounties($index = null)
    {
        $counties = [];
        if ($index === null) {
            for ($i = 0; $i < sizeof($this->data); $i++) {
                array_push($counties, [$i + 1, $this->data[$i]['county_name']]);
            }
        } else if (is_int($index) && $index < 48 && $index > 0) {
            $counties = $this->data[$index - 1];
        } else if (is_string($index)) {
            for ($i = 0; $i < sizeof($this->data); $i++) {
                if (strtolower($this->data[$i]['county_name']) === strtolower($index)) {
                    $counties = $this->data[$i];
                    break;
                }
            }
        }

        if (empty($counties)) {
            return 'Error: Invalid parameter provided. Please check your input and try again.';
        }



        return $counties;
    }
    public function getConstituencies($index = null)
    {
        $constituencies = [];
        if ($index === null) {
            for ($i = 0; $i < sizeof($this->data); $i++) {
                // array_push($constituencies, $this->data[$i]['constituencies']['constituency_name']);
                foreach ($this->data[$i]['constituencies'] as $constituency) {
                    array_push($constituencies, $constituency['constituency_name']);
                }
            }
        } else if (is_string($index)) {

            for ($i = 0; $i < sizeof($this->data); $i++) {

                for ($j = 0; $j < sizeof($this->data[$i]['constituencies']); $j++) {

                    if (strtolower($this->data[$i]['constituencies'][$j]['constituency_name']) == strtolower($index)) {
                        $constituencies = $this->data[$i]['constituencies'][$j];
                        break;
                    }
                }
            }

        } else if (is_int($index) && $index > 0 && $index < 48) {
            foreach ($this->data[$index - 1]['constituencies'] as $constituency) {
                array_push($constituencies, $constituency['constituency_name']);
            }
        }

        if (empty($constituencies)) {
            return 'Error: Invalid parameter provided. Please check your input and try again.';
        }
        return $constituencies;
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
