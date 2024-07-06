# Kenya Administrative Divisions

The **Kenya Administrative Divisions** PHP Library is a package that provides functionality to retrieve administrative divisions data for Kenya. It includes information about counties, constituencies, and wards.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
  - [Getting started](#getting-started)
  - [Methods available](#methods-available)
    - [Get all](#get-all)
    - [Get counties](#get-counties)
    - [Get constituencies](#get-constituencies)
    - [Get wards](#get-wards)
- [Contributing](#contributing)
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

// Instantiate the class
$kenyaAdministrativeDivisions = new KenyaAdministrativeDivisions();

```

## Methods available

### Get All

```php
// Get All the data
$data = $kenyaAdministrativeDivisions->getAll();
print_r($data);
```

### Get Counties

```php
// Get all counties
$counties = $kenyaAdministrativeDivisions->getCounties();
print_r($counties);

// Get county information by passing the county code
$county = $kenyaAdministrativeDivisions->getCounties(1);
print_r($county);

// Get county information by passing the county name
$county = $kenyaAdministrativeDivisions->getCounties('Mombasa');
print_r($county);
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
