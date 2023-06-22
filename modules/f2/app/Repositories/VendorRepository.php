<?php

namespace Modules\Vendor\App\Repositories;

use App\Helpers\StUtility;
use App\Repositories\BaseRepository;
use Modules\Vendor\App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;
use StallionExpress\AuthUtility\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use StallionExpress\AuthUtility\Enums\UserTypeEnum;
use Modules\Vendor\App\Models\ThreePlCustomerVendors;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;
use Modules\Product\App\Repositories\ProductVendorInterface;
use Modules\Product\App\Repositories\ProductRepositoryInterface;

class VendorRepository extends BaseRepository implements VendorRepositoryInterface
{
    use STEncodeDecodeTrait;
    /**
     * @param  Vendor  $vendor
     */
    public function __construct(Vendor $vendor)
    {
        parent::__construct($vendor);
    }

    /**
     * Return vendor from the index page
     *
     * @param  string  $search (Vendor name)
     * @param  array  $request
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllVendors(array $request, User $loggedUser): Paginator
    {
        $threePlCustomerId = $request['three_pl_customer_id'] ?? null;
        $search = $request['search'] ?? '';
        $recordPerPage = $request['limit'] ?? 10;
        $sortByKey = $request['sort_by'] ?? 'created_at';
        $sortByValue = $request['sort_by_value'] ?? 'DESC';

        return $this->getSimplePaginated()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })           
            ->when(in_array($loggedUser->user_type->value,
            [UserTypeEnum::THREE_PL_CUSTOMER->value, UserTypeEnum::THREE_PL_CUSTOMER_STAFF->value]), 
            function ($query) use ($loggedUser) {
                $query->where('three_pl_customer_id', \AuthUtility::getCustomerIdFor3PlCustomerAndStaff($loggedUser));
            })
            ->when(in_array($loggedUser->user_type->value,
            [UserTypeEnum::THREE_PL->value, UserTypeEnum::THREE_PL_STAFF->value]), 
            function ($query) use ($loggedUser, $threePlCustomerId) {
                $query->when($threePlCustomerId, function($wQuery) use ($loggedUser, $threePlCustomerId){
                    $wQuery->where('three_pl_customer_id', \AuthUtility::getCustomerIdFor3PlCustomerAndStaff($loggedUser, $threePlCustomerId));
                });
            })
            ->orderBy($sortByKey, $sortByValue)
            ->paginate($recordPerPage);
    }

    /**
     * Store a newly created resource in storage.
     * @param  array  $request
     * @return  Modules\Vendor\App\Models\Vendor
     */
    public function store(User $loggedUser, array $request): bool
    {   
        if(in_array($loggedUser->user_type->value,
        [UserTypeEnum::THREE_PL_CUSTOMER->value, UserTypeEnum::THREE_PL_CUSTOMER_STAFF->value])){
            $request['customer_id'] = [\AuthUtility::getCustomerIdFor3PlCustomerAndStaff($loggedUser, $request['customer_id'] ?? null)];
        }

        foreach ($request['customer_id'] as $threePlCustomerId){
            $this->create($request + [ 
                'three_pl_customer_id' => $threePlCustomerId,
                'last_modified_by' =>  $loggedUser->id
           ]);
        }
       
       return true;
    }

    /**
     * Update the specified resource in storage.
     * @param  \Modules\vendor\App\Models\Vendor  $vendor
     * @param  array  $request
     */
    public function update(Vendor $vendor, int $userId, array $request): Vendor
    {
        $vendor->name = $request['name'];
        $vendor->email = $request['email'];
        $vendor->account_number = $request['account_number'];
        $vendor->internal_note = $request['internal_note'];
        $vendor->po_note = $request['po_note'];
        $vendor->address_one = $request['address_one'];
        $vendor->address_two = $request['address_two'];
        $vendor->city = $request['city'];
        $vendor->zip_code = $request['zip_code'];
        $vendor->country = $request['country'];
        $vendor->state = $request['state'];
        $vendor->currency = $request['currency'];
        $vendor->last_modified_by = $userId;
        $vendor->save();
        $vendor->refresh();

        return $vendor;
    }

    /**
     * get vendors by 3pl customers
     *
     * @param  array  $request
     */
    public function getVendorsBy3plCustomer(int $customerID ,string $search):Collection
    {
        return $this->newQuery('id','name')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->where('three_pl_customer_id', $customerID)
            ->get();
    }

    /**
     * Check the specified resource.
     * @param  \Modules\Vendor\App\Requests\CheckVendorExistsRequest $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function vendorExists(array $request): bool
    {
        $threePlCustomerId = $request['three_pl_customer_id'] ?? null;
        $vendorCount = Vendor::whereIn('id', $request['vendors'])
        ->when($threePlCustomerId, function($query, $threePlCustomerId){
            $query->where('three_pl_customer_id', $threePlCustomerId);
        })->count();
        
        return $vendorCount == count($request['vendors']);
    }

}
