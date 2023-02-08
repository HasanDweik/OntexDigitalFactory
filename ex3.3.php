<?php
use PHPUnit\Framework\TestCase;

class CustomerScriptTest extends TestCase
{
    public function testCreateCustomersWithValidData()
    {
        $customers = [
            [
                'email' => 'customer1@example.com',
                'firstname' => 'Hasan',
                'lastname' => 'Dweik',
                'region_code' => 'NY',
                'region' => 'New York',
                'postcode' => '10001',
                'street' => '123 Main St',
                'telephone' => '555-555-5555',
                'country_id' => 'US',
                'password' => 'password123'
            ],
            [
                'email' => 'customer2@example.com',
                'firstname' => 'Jane',
                'lastname' => 'Doe',
                'region_code' => 'CA',
                'region' => 'California',
                'postcode' => '90210',
                'street' => '456 Main St',
                'telephone' => '555-555-5556',
                'country_id' => 'US',
                'password' => 'password456'
            ]
        ];

        $result = createCustomers($customers);

        $this->assertTrue($result);
    }

    public function testCreateCustomersWithInvalidData()
    {
        $customers = [
            [
                'email' => '',
                'firstname' => 'John',
                'lastname' => 'Doe',
                'region_code' => 'NY',
                'region' => 'New York',
                'postcode' => '10001',
                'street' => '123 Main St',
                'telephone' => '555-555-5555',
                'country_id' => 'US',
                'password' => 'password123'
            ],
            [
                'email' => 'customer2@example.com',
                'firstname' => '',
                'lastname' => 'Doe',
                'region_code' => 'CA',
                'region' => 'California',
                'postcode' => '90210',
                'street' => '456 Main St',
                'telephone' => '555-555-5556',
                'country_id' => 'US',
                'password' => 'password456'
            ]
        ];

        $result = createCustomers($customers);

        $this->assertFalse($result);
    }
}
