<?php

namespace Modules\Location\App\Controllers;

use App\Helpers\StUtility;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationEditResource;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use Modules\Location\App\Models\Location;
use Modules\Location\App\Repositories\LocationRepositoryInterface;
use Modules\Location\App\Requests\DeleteLocationRequest;
use Modules\Location\App\Requests\ListLocationRequest;
use Modules\Location\App\Requests\ShowLocationBarcodeRequest;
use Modules\Location\App\Requests\StoreLocationRequest;
use Modules\Location\App\Requests\UpdateLocationRequest;

class LocationController extends Controller
{
    private LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->authorizeResource(Location::class, 'location');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Modules\Location\App\Requests\ListLocationRequest  $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function index(ListLocationRequest $request): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->locationRepository->getAllLocations(\AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()), $request->all()),
            ['message' => trans('location::messages.index_success')],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Location\App\Requests\StoreLocationRequest  $request
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function store(StoreLocationRequest $request): ApiSuccessResponse
    {
        $this->locationRepository->store(\AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()), Auth::user()->id, $request->validated());

        return new ApiSuccessResponse(
            [],
            ['message' => trans('location::messages.location_added')],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Location\App\Models\Location  $location
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function show(Location $location): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            new LocationEditResource($this->locationRepository->getByParams([
                ['id', $location->id],
                ['three_pl_id', \AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user())],
            ])),
            ['message' => trans('location::messages.location_show')],
            Response::HTTP_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\location\App\Requests\UpdateLocationRequest  $request
     * @param  \Modules\location\App\Models\Location  $location
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function update(UpdateLocationRequest $request, Location $location): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->locationRepository->update($location, \AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()), Auth::user()->id,
                $request->validated()),
            ['message' => trans('location::messages.location_updated')],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\location\App\Requests\DeleteLocationRequest  $request
     * @param  \Modules\location\App\Models\Location  $location
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function destroy(DeleteLocationRequest $request, Location $location): ApiSuccessResponse
    {
        $isDeleted = $location->delete();

        return new ApiSuccessResponse(
            null,
            ['message' => $isDeleted ? trans('location::messages.location_deleted') : 'Error in deleting location'],
            Response::HTTP_OK
        );
    }

    /**
     * Return location barcode
     *
     * @param  string  $threePlId
     * @param  \Modules\location\App\Models\Location  $location
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function showLocationBarcode(ShowLocationBarcodeRequest $request, Location $location): ApiSuccessResponse
    {
        $locationBarcode = 'data:image/png;base64,'.DNS1D::getBarcodePNG($location->barcode, 'C39+', 2, 40, [0, 0, 0], true);

        return new ApiSuccessResponse(
            ['locationBarcode' => 'data:image/png;base64,'.DNS1D::getBarcodePNG($location->barcode, 'C39+', 2, 40, [0, 0, 0], true)],
            ['message' => trans('location::messages.location_barcode')],
            Response::HTTP_OK
        );
    }
}
