<?php

namespace MichaelNjuguna\KenyaAdministrativeDivisions\src\Core;
class GetCountiesParams
{
    public function __construct(
        public ?int $countyCode = null,
        public ?string $countyName = null
    ) {
    }
}
class GetConstituenciesParams
{
    public function __construct(
        public ?int $countyCode = null,
        public ?string $countyName = null,
        public ?string $constituencyName = null
    ) {
    }
}

class GetWardsParams
{
    public function __construct(
        public ?int $countyCode = null,
        public ?string $countyName = null,
        public ?string $constituencyName = null
    ) {
    }
}