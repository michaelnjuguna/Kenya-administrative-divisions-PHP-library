<?php

namespace Tests;

require_once __DIR__ . '/../vendor/autoload.php';
// require 'vendor/autoload.php';


use MichaelNjuguna\KenyaAdministrativeDivisions\KenyaAdministrativeDivisions;
use PHPUnit\Framework\TestCase;

class KenyaAdministrativeDivisionsTest extends TestCase
{
    private $kenyaAdministrativeDivisions;
    protected function setup(): void
    {
        $this->kenyaAdministrativeDivisions = new KenyaAdministrativeDivisions();
    }

    public function testGetAll()
    {
        $data = $this->kenyaAdministrativeDivisions->getAll();
        $this->assertIsArray($data, 'Data should be an array');
        $this->assertNotEmpty($data, 'Data should not be empty');
    }
    public function testGetCounties()
    {
        // Test getting all counties
        $counties = $this->kenyaAdministrativeDivisions->getCounties();
        $this->assertIsArray($counties, 'Counties should be an array');
        $this->assertCount(47, $counties, 'There should be 47 counties');

        // Test getting county by index
        $county = $this->kenyaAdministrativeDivisions->getCounties(1);
        $this->assertIsArray($county, 'County should be an array');
        $this->assertArrayHasKey('county_name', $county, 'County should have a name');

        // Test getting county by name
        $county = $this->kenyaAdministrativeDivisions->getCounties('Mombasa');
        $this->assertIsArray($county, 'County should be an array');
        $this->assertEquals('Mombasa', $county['county_name'], 'County name should be Mombasa');

        // Test invalid index
        $result = $this->kenyaAdministrativeDivisions->getCounties(48);
        $this->assertEquals('Error: Invalid parameter provided. Please check your input and try again.', $result);

        // Test invalid name
        $result = $this->kenyaAdministrativeDivisions->getCounties('InvalidName');
        $this->assertEquals('Error: Invalid parameter provided. Please check your input and try again.', $result);
    }

    public function testGetConstituencies()
    {
        // Test getting all constituencies
        $constituencies = $this->kenyaAdministrativeDivisions->getConstituencies();
        $this->assertIsArray($constituencies, 'Constituencies should be an array');
        $this->assertNotEmpty($constituencies, 'Constituencies should not be empty');

        // Test getting constituencies by county index
        $constituencies = $this->kenyaAdministrativeDivisions->getConstituencies(1);
        $this->assertIsArray($constituencies, 'Constituencies should be an array');
        $this->assertNotEmpty($constituencies, 'Constituencies should not be empty');

        // Test getting constituency by name
        $constituency = $this->kenyaAdministrativeDivisions->getConstituencies('Kisauni');
        $this->assertIsArray($constituency, 'Constituency should be an array');
        $this->assertArrayHasKey('constituency_name', $constituency, 'Constituency should have a name');

        // Test invalid county index
        $result = $this->kenyaAdministrativeDivisions->getConstituencies(48);
        $this->assertEquals('Error: Invalid parameter provided. Please check your input and try again.', $result);

        // Test invalid constituency name
        $result = $this->kenyaAdministrativeDivisions->getConstituencies('InvalidName');
        $this->assertEquals('Error: Invalid parameter provided. Please check your input and try again.', $result);
    }

    public function testGetWards()
    {
        // Test getting all wards
        $wards = $this->kenyaAdministrativeDivisions->getWards();
        $this->assertIsArray($wards, 'Wards should be an array');
        $this->assertNotEmpty($wards, 'Wards should not be empty');

        // Test getting wards by county index
        $wards = $this->kenyaAdministrativeDivisions->getWards(1);
        $this->assertIsArray($wards, 'Wards should be an array');
        $this->assertNotEmpty($wards, 'Wards should not be empty');

        // Test getting wards by county name
        $wards = $this->kenyaAdministrativeDivisions->getWards('Mombasa');
        $this->assertIsArray($wards, 'Wards should be an array');
        $this->assertNotEmpty($wards, 'Wards should not be empty');

        // Test getting wards by constituency name
        $wards = $this->kenyaAdministrativeDivisions->getWards(null, 'Kisauni');
        $this->assertIsArray($wards, 'Wards should be an array');
        $this->assertNotEmpty($wards, 'Wards should not be empty');

        // Test getting wards by county name and constituency name
        $wards = $this->kenyaAdministrativeDivisions->getWards('Mombasa', 'Kisauni');
        $this->assertIsArray($wards, 'Wards should be an array');
        $this->assertNotEmpty($wards, 'Wards should not be empty');

        // Test invalid county index
        $result = $this->kenyaAdministrativeDivisions->getWards(48);
        $this->assertEquals('Error: Invalid parameter provided. Please check your input and try again.', $result);

        // Test invalid county name
        $result = $this->kenyaAdministrativeDivisions->getWards('InvalidCounty');
        $this->assertEquals('Error: Invalid parameter provided. Please check your input and try again.', $result);

        // Test invalid constituency name
        $result = $this->kenyaAdministrativeDivisions->getWards(null, 'InvalidConstituency');
        $this->assertEquals('Error: Invalid parameter provided. Please check your input and try again.', $result);
    }
}