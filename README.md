# Kenya Administrative Divisions

The **Kenya Administrative Divisions** PHP Library is a package that provides functionality to retrieve administrative divisions data for Kenya. It includes information about counties, constituencies, and wards.

## Changelog

See [CHANGELOG.md](./CHANGELOG.md) for all changes

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
  - [Getting started](#getting-started)
  - [Methods available](#methods-available)
    - [Helper methods](#helper-methods)
    - [Get all](#get-all)
    - [Get counties](#get-counties)
    - [Get constituencies](#get-constituencies)
    - [Get wards](#get-wards)
- [API reference](#api-reference)
- [Support](#support)

## Installation

You can install the library via Composer. Run the following command in your terminal:

```bash
composer require michaelnjuguna/kenya-administrative-divisions
```

## Usage

### Getting started

To use the library, instantiate the `KenyaAdministrativeDivisions` class:

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;


```

## Methods available

### Helper methods

```php
// Get all county names
$countyNames = KenyaAdministrativeDivisions::getCountyNames();

// Get all constituency names
$constituencies = KenyaAdministrativeDivisions::getConstituencyNames();
$mombasaConstituencies = KenyaAdministrativeDivisions::getCounties(countyCode: 1);
    $mombasaConstituencies = KenyaAdministrativeDivisions::getCounties(countyName: 'mombasa');
```

### Get All

```php
// Get All the data
$counties = KenyaAdministrativeDivisions::getAll();
```

### Get Counties

```php
// Get all counties
$result = KenyaAdministrativeDivisions::getCounties();

// Get county information by passing the county code
$result = KenyaAdministrativeDivisions::getCounties(countyCode: 1);

// Get county information by passing the county name
$result = KenyaAdministrativeDivisions::getCounties(countyName: 'mombasa');
```

### Get Constituencies

```php
// Get all constituencies
$constituencies = $kenyaAdministrativeDivisions->getConstituencies();
print_r($constituencies);

// Get constituencies of a particular county by its code
$constituencies = $kenyaAdministrativeDivisions->getConstituencies(1);
print_r($constituencies);

// Get constituencies of a particular county by its name
$constituencies = $kenyaAdministrativeDivisions->getConstituencies('Nairobi');
print_r($constituencies);

```

### Get wards

```php
// Get all wards
$wards = $kenyaAdministrativeDivisions->getWards();
print_r($wards);

// Get wards of a particular county by passing its county code
$wards = $kenyaAdministrativeDivisions->getWards(1);
print_r($wards);

// Get wards of a particular county by passing its name
$wards = $kenyaAdministrativeDivisions->getWards('Mombasa');
print_r($wards);

// Get wards of a particular county and constituency by passing the respective county code/name and constituency name
$wards = $kenyaAdministrativeDivisions->getWards(1, 'Mvita');
$wards = $kenyaAdministrativeDivisions->getWards('Mombasa', 'Mvita');

// Get the wards of a particular constituency by passing its name
$wards = $kenyaAdministrativeDivisions->getWards(null, 'Mvita');
print_r($wards);
```

## Contributing

1. Fork this repository.
2. Create new branch with feature name.
3. Create your feature.
4. Run the tests and make sure all the tests pass.
5. Commit and set commit message with feature name.
6. Push your code to your fork repository.
7. Create pull request.

## Support

If you like this project, you can support me with starring ⭐ this repository.

## License

[MIT](license.txt)

Made with 💜
