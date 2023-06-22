<?php

namespace Modules\Location\App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Modules\Location\App\Models\Location;

class LocationRepository extends BaseRepository implements LocationRepositoryInterface
{
    /**
     * @param  Location  $location
     */
    public function __construct(Location $location)
    {
        parent::__construct($location);
    }

    /**
     * Return all location types from the index page
     *
     * @param  string  $search (Location name)
     * @param  string  $threePlId
     * @param  array  $request
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllLocations(string $threePlId, array $request): Paginator
    {
        $search = $request['search'] ?? '';
        $location_type_id = $request['location_type_id'] ?? '';
        $warehouse_id = $request['warehouse_id'] ?? '';
        $is_pickable = $request['is_pickable'] ?? '';
        $is_sellable = $request['is_sellable'] ?? '';
        $recordPerPage = $request['limit'] ?? 10;
        $sortByKey = $request['sort_by'] ?? 'created_at';
        $sortByValue = $request['sort_by_value'] ?? 'DESC';

        return $this->getSimplePaginated()
            ->with(['warehouse', 'locationType'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->where('three_pl_id', $threePlId)
            ->when($location_type_id, function ($query) use ($location_type_id) {
                $query->where('location_type_id', '=', $location_type_id);
            })
            ->when($warehouse_id, function ($query) use ($warehouse_id) {
                $query->where('warehouse_id', '=', $warehouse_id);
            })
            ->when($is_pickable, function ($query) use ($is_pickable) {
                $query->where('is_pickable', '=', $is_pickable);
            })
            ->when($is_sellable, function ($query) use ($is_sellable) {
                $query->where('is_sellable', '=', $is_sellable);
            })
            ->orderBy($sortByKey, $sortByValue)
            ->paginate($recordPerPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $threePlId
     * @param  array  $request
     * @return  Modules\Location\App\Models\Location
     */
    public function store(string $threePlId, int $userId, array $request): Location
    {
        return $this->create(array_merge($request, ['three_pl_id' => $threePlId, 'last_modified_by' => $userId]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\location\App\Models\Location  $location
     * @param  string  $threePlId
     * @param  array  $request
     */
    public function update(Location $location, string $threePlId, int $userId, array $request): Location
    {
        $location->name = $request['name'];
        $location->location_type_id = $request['location_type_id'];
        $location->warehouse_id = $request['warehouse_id'];
        $location->is_pickable = $request['is_pickable'];
        $location->is_sellable = $request['is_sellable'];
        $location->last_modified_by = $userId;
        $location->save();
        $location->refresh();

        return $location;
    }
}
