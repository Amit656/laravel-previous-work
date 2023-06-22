<?php

namespace Modules\Locationtype\App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Modules\Locationtype\App\Models\LocationType;

class LocationTypeRepository extends BaseRepository implements LocationTypeRepositoryInterface
{
    /**
     * @param  \Modules\Locationtype\App\Models\LocationType  $locationType
     */
    public function __construct(LocationType $locationType)
    {
        parent::__construct($locationType);
    }

    /**
     * Return all location types from the index page
     *
     * @param  string  $search (Location type name)
     * @param  string  $threePlId
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllLocationTypes(string $threePlId, array $request): Paginator
    {
        $search = $request['search'] ?? '';
        $recordPerPage = $request['limit'] ?? 10;
        $sortByKey = $request['sort_by'] ?? 'created_at';
        $sortByValue = $request['sort_by_value'] ?? 'DESC';

        return $this->getSimplePaginated()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->where('three_pl_id', $threePlId)
            ->orderBy($sortByKey, $sortByValue)
            ->paginate($recordPerPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $threePlId
     * @param  array  $request
     * @return  Modules\Locationtype\App\Models\LocationType
     */
    public function store(string $threePlId, int $userId, array $request): LocationType
    {
        return $this->create(array_merge($request, ['three_pl_id' => $threePlId, 'last_modified_by' => $userId]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\locationtype\App\Models\LocationType  $locationType
     * @param  string  $threePlId
     * @param  array  $request
     */
    public function update(LocationType $locationType, string $threePlId, int $userId, array $request): LocationType
    {
        $this->updateBy('id', $locationType->id, [
            'name' => $request['name'],
            'last_modified_by' => $userId,
        ]);
        $locationType->refresh();

        return $locationType;
    }

    /**
     * It will return all location types names
     *
     */
    public function locationTypes(string $threePlId)
    {
        return $this->newQuery(['id', 'name'])->where('three_pl_id', $threePlId)->get();
    }
}
