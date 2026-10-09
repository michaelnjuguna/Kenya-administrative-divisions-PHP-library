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
$result = KenyaAdministrativeDivisions::getConstituencies();

// Get a specific constituency information
$result = KenyaAdministrativeDivisions::getConstituencies(constituencyName: 'Changamwe');

// Get constituencies of a particular county by its code
$result = KenyaAdministrativeDivisions::getConstituencies(countyCode: 1);

// Get constituencies of a particular county by its name
$result = KenyaAdministrativeDivisions::getConstituencies(countyName: 'Mombasa');

```

### Get wards

```php
// Get all wards
$result = KenyaAdministrativeDivisions::getWards();

// Get wards of a particular county by passing its county code
$result = KenyaAdministrativeDivisions::getWards(countyCode: 1);

// Get wards of a particular county by passing its name
$result = KenyaAdministrativeDivisions::getWards(countyName: 'Mombasa');

// Get the wards of a particular constituency by passing its name
$result = KenyaAdministrativeDivisions::getWards(constituencyName: 'Changamwe');
```

## API reference

### `getAll`

Returns the complete hierarchical data structure of Kenya's administrative divisions.

- **Returns**: `County[]`

---

### `getCounties(?countyCode: int,?countyName:string)`

Retrieves a list of counties. If no parameters are provided, it returns all 47 counties.

- **Parameters**:
  - `countyCode`: (1-47) Returns the specific county matching the code.
  - `countyName`: Returns the specific county matching the name.

- **Returns**: `County[]`
- **Throws**: `Error` if an invalid `countyCode` or `countyName` is passed as parameter

---

### `getConstituencies(?countyCode:int,?countyName:string,?constituencyName:string)

Retrieves constituencies, optionally filtered by their parent county.

- **Parameters**:
  - `countyCode`: Returns all constituencies within that county code.
  - `countyName`: Returns all constituencies within that county name.
  - `constituencyName`: Returns all the information about the constituency

- **Returns**: `Constituency[]`
- **Throws**: `Error` if an invalid `countyCode`,`countyName` or `constituencyName` is passed as parameter

### `getWards(?countyCode:int,?countyName:string,?constituencyName:string)`

Retrieves wards based on the provided filter depth.

- **Parameters**:
  - `countyCode`: Returns all constituencies within that county code.
  - `countyName`: Returns all constituencies within that county name.
  - `constituencyName`: Returns all the information about the constituency
- **Returns**: `Ward[]`
- **Throws**: `Error` if an invalid `countyCode`,`countyName` or `constituencyName` is passed as parameter

---

### Name Helpers

Methods for retrieving flat arrays of strings.

- **`getCountyNames()`**: Returns `string[]`
- **`getConstituencyNames()`**: Returns `string[]`

## Support

If you like this project, you can support me with starring ⭐ this repository.

## License

[MIT](license.txt)

Made with 💜
