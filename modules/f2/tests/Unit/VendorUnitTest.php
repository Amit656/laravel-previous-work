<?php

namespace Tests\Unit\Vendor;

use Modules\Vendor\App\Models\Vendor;
use Modules\Vendor\App\Repositories\VendorRepository;
use Tests\TestCase;

class VendorUnitTest extends TestCase
{
    private VendorRepository $vendorRepository;

    private $fakePayloadData;
    
    private $userId;

    public function setup(): void
    {
        parent::setup();
        $vendorFactory = Vendor::factory()->create();  
        $this->userId = rand(1, 100);      

        $this->fakePayloadData = [            
            'name' => $vendorFactory->name,
            'email' => $vendorFactory->email,
            'account_number' => $vendorFactory->account_number,
            'internal_note' => $vendorFactory->internal_note,
            'po_note' => $vendorFactory->po_note,
            'address_one' => $vendorFactory->address_one,
            'address_two' => $vendorFactory->address_two,
            'city' => $vendorFactory->city,
            'zip_code' => $vendorFactory->zip_code,
            'country' => $vendorFactory->country,
            'state' => $vendorFactory->state,
            'currency' => $vendorFactory->currency,
            
        ];

        $this->vendorRepository = new VendorRepository(new Vendor);
    }

    /**
     * to test create a vendor
     *
     * @return void
     */
    public function test_create_vendor()
    {
        $payload = $this->fakePayloadData;
        $vendor = $this->vendorRepository->store($this->userId, $payload);

        $actual = [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'account_number' => $vendor->account_number,
            'internal_note' => $vendor->internal_note,
            'po_note' => $vendor->po_note,
            'address_one' => $vendor->address_one,
            'address_two' => $vendor->address_two,
            'city' => $vendor->city,
            'zip_code' => $vendor->zip_code,
            'country' => $vendor->country,
            'state' => $vendor->state,
            'currency' => $vendor->currency,
        ];

        $expected = $payload;
        $this->assertEquals($actual, $expected);
    }

    /**
     * to test get all vendors
     *
     * @return void
     */
    public function test_get_all_vendors()
    {
        $vendor = $this->vendorRepository->store($this->userId, $this->fakePayloadData);
        $actual = [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'account_number' => $vendor->account_number,
            'internal_note' => $vendor->internal_note,
            'po_note' => $vendor->po_note,
            'address_one' => $vendor->address_one,
            'address_two' => $vendor->address_two,
            'city' => $vendor->city,
            'zip_code' => $vendor->zip_code,
            'country' => $vendor->country,
            'state' => $vendor->state,
            'currency' => $vendor->currency,

        ];

        $lastVendor = $this->vendorRepository->getBy('id', $vendor->id);
        $expected = [
            'name' => $lastVendor->name,
            'email' => $lastVendor->email,
            'account_number' => $lastVendor->account_number,
            'internal_note' => $lastVendor->internal_note,
            'po_note' => $lastVendor->po_note,
            'address_one' => $lastVendor->address_one,
            'address_two' => $lastVendor->address_two,
            'city' => $lastVendor->city,
            'zip_code' => $lastVendor->zip_code,
            'country' => $lastVendor->country,
            'state' => $lastVendor->state,
            'currency' => $lastVendor->currency,
            
        ];

        $this->assertEquals($actual, $expected);
    }

    /**
     * to test Edit/Show a vendor
     *
     * @return void
     */
    public function test_show_vendor()
    {
        $vendor = $this->vendorRepository->store($this->userId, $this->fakePayloadData);

        $actual = [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'account_number' => $vendor->account_number,
            'internal_note' => $vendor->internal_note,
            'po_note' => $vendor->po_note,
            'address_one' => $vendor->address_one,
            'address_two' => $vendor->address_two,
            'city' => $vendor->city,
            'zip_code' => $vendor->zip_code,
            'country' => $vendor->country,
            'state' => $vendor->state,
            'currency' => $vendor->currency,

        ];

        $lastVendor = $this->vendorRepository->getByParams([
            ['id', $vendor->id],        
        ]);
        $expected = [
            'name' => $lastVendor->name,
            'email' => $lastVendor->email,
            'account_number' => $lastVendor->account_number,
            'internal_note' => $lastVendor->internal_note,
            'po_note' => $lastVendor->po_note,
            'address_one' => $lastVendor->address_one,
            'address_two' => $lastVendor->address_two,
            'city' => $lastVendor->city,
            'zip_code' => $lastVendor->zip_code,
            'country' => $lastVendor->country,
            'state' => $lastVendor->state,
            'currency' => $lastVendor->currency,
            
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * to test update vendor
     *
     * @return void
     */
    public function test_update_vendor()
    {
        $vendor = $this->vendorRepository->store($this->userId, $this->fakePayloadData);

        $valuesToBeUpdate = [
            'name' => $vendor->name.' updated',
            'email' => $vendor->email,
            'account_number' => $vendor->account_number,
            'internal_note' => $vendor->internal_note.' updated',
            'po_note' => $vendor->po_note.' updated',
            'address_one' => $vendor->address_one.' updated',
            'address_two' => $vendor->address_two.' updated',
            'city' => $vendor->city,
            'zip_code' => $vendor->zip_code,
            'country' => $vendor->country,
            'state' => $vendor->state,
            'currency' => $vendor->currency,

        ];

        $updatedValues = $this->vendorRepository->update($vendor, $this->userId, $valuesToBeUpdate);

        $this->assertEquals($valuesToBeUpdate['name'], $updatedValues->name);
        $this->assertEquals($valuesToBeUpdate['email'], $updatedValues->email);
        $this->assertEquals($valuesToBeUpdate['account_number'], $updatedValues->account_number);
        $this->assertEquals($valuesToBeUpdate['internal_note'], $updatedValues->internal_note);
        $this->assertEquals($valuesToBeUpdate['po_note'], $updatedValues->po_note);
        $this->assertEquals($valuesToBeUpdate['address_one'], $updatedValues->address_one);
        $this->assertEquals($valuesToBeUpdate['address_two'], $updatedValues->address_two);
    }

    /**
     * Test delete vendor
     *
     * @return void
     */
    public function test_delete_vendor()
    {
        $vendor = Vendor::factory()->create();
        $deleteVendor = $this->vendorRepository->deleteBy('id', $vendor->id);
        $vendor->refresh();
        $this->assertTrue($deleteVendor == true);
    }
    
}
