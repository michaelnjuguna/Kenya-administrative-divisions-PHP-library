<?php

namespace MichaelNjuguna\KenyaAdministrativeDivisions\Models;

class County
{
    public function __construct(
        public int $county_code,
        public string $county_name,
        /** @var Constituency[] */
        public array $constituencies = []
    ) {
    }
}

class Constituency
{
    public function __construct(
        public string $constituency_name,
        /** @var Ward[] */
        public array $wards = []
    ) {
    }
}

class Ward
{
    public function __construct(
        public string $name
    ) {
    }
}