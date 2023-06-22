<?php

namespace Modules\Locationtype\App\Controllers;

use App\Helpers\StUtility;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Locationtype\App\Models\LocationType;
use Modules\Locationtype\App\Repositories\LocationTypeRepositoryInterface;
use Modules\Locationtype\App\Requests\DeleteLocationTypeRequest;
use Modules\Locationtype\App\Requests\ListLocationTypeRequest;
use Modules\Locationtype\App\Requests\StoreLocationTypeRequest;
use Modules\Locationtype\App\Requests\UpdateLocationTypeRequest;

class LocationTypeController extends Controller
{
    private LocationTypeRepositoryInterface $locationTypeRepository;

    public function __construct(LocationTypeRepositoryInterface $locationTypeRepository)
    {
        $this->locationTypeRepository = $locationTypeRepository;
        $this->authorizeResource(LocationType::class, 'locationType');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $search (Location type name)
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function index(ListLocationTypeRequest $request): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->locationTypeRepository->getAllLocationTypes(\AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()), $request->all()),
            ['message' => trans('locationType::messages.index_success')],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $name (Location type name)
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function store(StoreLocationTypeRequest $request): ApiSuccessResponse
    {
        $this->locationTypeRepository->store(\AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()), Auth::user()->id, $request->validated());

        return new ApiSuccessResponse(
            [],
            ['message' => trans('locationType::messages.location_type_added')],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\locationtype\App\Models\LocationType  $locationType
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function show(LocationType $locationType): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->locationTypeRepository->getByParams([
                ['id', $locationType->id],
                ['three_pl_id', \AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user())],
            ]),
            ['message' => trans('locationType::messages.location_type_show')],
            Response::HTTP_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\locationtype\App\Requests\UpdateWLocationTypeRequest  $request
     * @param  \Modules\locationtype\App\Models\LocationType  $locationType
     * @return \App\Http\Responses\ApiSuccessResponse
     */
    public function update(UpdateLocationTypeRequest $request, LocationType $locationType): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->locationTypeRepository->update($locationType, \AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user()),
                Auth::user()->id, $request->validated()),
            ['message' => trans('locationType::messages.location_type_updated')],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteLocationTypeRequest $request, LocationType $locationType): ApiSuccessResponse
    {
        $isDeleted = $locationType->delete();

        return new ApiSuccessResponse(
            null,
            ['message' => $isDeleted ? trans('locationType::messages.location_type_deleted') : 'Error in deleting location type'],
            Response::HTTP_OK
        );
    }

    /**
     * Return all location types by name
     *
     * @return ApiSuccessResponse
     */
    public function getLocationTypes(): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->locationTypeRepository->locationTypes(\AuthUtility::getThreePlIdFor3PlAndStaff(Auth::user())),
            ['message' => trans('locationType::messages.list')],
            Response::HTTP_OK
        );
    }
}
