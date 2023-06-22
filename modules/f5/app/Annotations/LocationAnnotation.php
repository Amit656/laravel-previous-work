<?php

namespace Modules\Location\App\Annotations;

use OpenApi\Annotations as OA;

class LocationAnnotation
{
    /**
     * @OA\Get(
     *     path="/api/locations",
     *   * operationId="get-all-locations",
     * tags={"Locations"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          description="Search location by name",
     *          in="query",
     *          name="search",
     *          example="",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          description="Filter by location type",
     *          in="query",
     *          name="location_type_id",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          description="Filter by warehouse",
     *          in="query",
     *          name="Warehouse_id",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          description="Filter by is pickable",
     *          in="query",
     *          name="is_pickable",
     *          example=false,
     *
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          description="Filter by is sellable",
     *          in="query",
     *          name="is_sellable",
     *          example=false,
     *
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          description="Page number",
     *          in="query",
     *          name="page",
     *          example="1",
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *          description="Record per page",
     *          in="query",
     *          name="limit",
     *          example="10",
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          )
     *      ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *  *      @OA\Property(property="data",type="object",
     *                  @OA\Property(
     *                      property="current_page",
     *                      type="integer",
     *                      example="1"
     *                  ),
     *                  @OA\Property(
     *                         property="data",
     *                         type="array",
     *
     *                    @OA\Items(
     *
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="location_type_id",
     *                         type="integer",
     *                         example=3
     *                      ),
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Canada"
     *                      ),
     *                      @OA\Property(
     *                         property="is_pickable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="is_sellable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="barcode",
     *                         type="string",
     *                         example="237689"
     *                      ),
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="warehouse",
     *                         type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                                  property="id",
     *                                  type="integer",
     *                                  example=2
     *                              ),
     *                              @OA\Property(
     *                                  property="name",
     *                                  type="string",
     *                                  example="Warehouse Name"
     *                              ),
     *                          ),
     *                       ),
     *                       @OA\Property(
     *                         property="location_type",
     *                         type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                                  property="id",
     *                                  type="integer",
     *                                  example=1
     *                              ),
     *                              @OA\Property(
     *                                  property="name",
     *                                  type="string",
     *                                  example="Location Type Name"
     *                              ),
     *                          ),
     *                       ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-04-28 08:23:14"
     *                      ),
     *                   ),
     *            ),
     *                      @OA\Property(
     *                         property="first_page_url",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/publiclocations?page=1"
     *                      ),
     *                       @OA\Property(
     *                         property="from",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="last_page",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="last_page_url",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/publiclocations?page=2"
     *                      ),
     *                      @OA\Property(
     *                         property="links",
     *                         type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                                  property="url",
     *                                  type="string",
     *                                  example=null
     *                              ),
     *                              @OA\Property(
     *                                  property="label",
     *                                  type="string",
     *                                  example="< Previous"
     *                              ),
     *                              @OA\Property(
     *                                  property="active",
     *                                  type="string",
     *                                  example=false
     *                              ),
     *                           ),
     *                      ),
     *                      @OA\Property(
     *                         property="next_page_url",
     *                         type="string",
     *                         example=null
     *                      ),
     *                       @OA\Property(
     *                         property="path",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/publiclocations"
     *                      ),
     *                       @OA\Property(
     *                         property="per_page",
     *                         type="integer",
     *                         example=10
     *                      ),
     *                       @OA\Property(
     *                         property="prev_page_url",
     *                         type="string",
     *                         example=null
     *                      ),
     *                      @OA\Property(
     *                         property="to",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="total",
     *                         type="integer",
     *                         example=1
     *                      ),

     *          ),
     *          @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Locations returned successfully"
     *               ),
     *           ),
     *      ),
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function index()
    {
    }

    /**
     * * @OA\Post(
     *     path="/api/locations",
     *     operationId="create-location",
     *     tags={"Locations"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              required={"name, location_type_id, warehouse_id, is_pickable, is_sellable"},
     *
     *              @OA\Property(property="name",type="string",example="Canada"),
     *              @OA\Property(property="location_type_id",type="integer",example=2),
     *              @OA\Property(property="warehouse_id",type="integer",example=2),
     *              @OA\Property(property="is_pickable",type="boolean",example="0"),
     *              @OA\Property(property="is_sellable",type="boolean",example="0"),
     *
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *  *      @OA\Property(property="data",type="object",
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="location_type_id",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Canada",
     *                      ),
     *                      @OA\Property(
     *                         property="is_pickable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="is_sellable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="barcode",
     *                         type="string",
     *                         example="343678"
     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-04-27 07:50:52"
     *                      ),
     *                   ),
     *            @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location added successfully"
     *               ),
     *             ),
     *          ),
     *   ),
     *
     *   @OA\Response(
     *      response=422,
     *       description="Validation error for required",
     *
     *      @OA\JsonContent(
     *
     *  *      @OA\Property(property="message",type="string",example="The name field is required. (and 1 more error)"),
     *  *      @OA\Property(property="errors",type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="name",
     *                              type="string",
     *                              example="Name is required."
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="location_type_id",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="location_type_id",
     *                              type="integer",
     *                              example="Location must be selected"
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="warehouse_id",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="warehouse_id",
     *                              type="integer",
     *                              example="Warehouse must be selected"
     *                          ),
     *                      ),
     *                  ),
     *          ),
     *      )
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function store()
    {
    }

    /**
     * @OA\Get(
     *     path="/api/locations/{location}",
     *   * operationId="get-location-by-id",
     * tags={"Locations"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Location id",
     *          in="path",
     *          name="location",
     *          example="_st_Mg==",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=302,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *          @OA\Property(property="data",type="object",
     *                      @OA\Property(
     *                         property="three_pl_d",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="location_type_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="integer",
     *                         example=3
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Canada",
     *                      ),
     *                     @OA\Property(
     *                         property="is_pickable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="is_sellable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="barcode",
     *                         type="string",
     *                         example="453467"
     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-05-01 12:50:23"
     *                      ),
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *
     *                      ),
     *                      ),
     *                   ),
     *          @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location showed successfully"
     *               ),
     *               ),
     *          ),

     *   ),
     *
     * )
     */
    public function show()
    {
    }

    /**
     * * * @OA\Put(
     *     path="/api/locations/{location}",
     *   * operationId="update-location",
     * tags={"Locations"},
     * security={ {"sanctum": {} }},
     *
     * @OA\Parameter(
     *          required=true,
     *          description="Location id",
     *          in="path",
     *          name="location",
     *          example="_st_Mg==",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     *   @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              required={"name, location_type_id, warehouse_id, is_pickable, is_sellable"},
     *
     *              @OA\Property(property="name",type="string",example="Ontario"),
     *              @OA\Property(property="location_type_id",type="integer",example=2),
     *              @OA\Property(property="warehouse_id",type="integer",example=2),
     *              @OA\Property(property="is_pickable",type="boolean",example="1"),
     *              @OA\Property(property="is_sellable",type="boolean",example="1"),
     *
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *  *      @OA\Property(property="data",type="object",
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="location_type_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Ontario",
     *                      ),
     *                      @OA\Property(
     *                         property="is_pickable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                      @OA\Property(
     *                         property="is_sellable",
     *                         type="boolean",
     *                         example="0"
     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-05-01 02:45:23"
     *                      ),
     *                   ),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location updated successfully"
     *               ),
     *               ),
     *          ),
     *   ),
     *
     *   @OA\Response(
     *      response=422,
     *       description="Validation error for required",
     *
     *      @OA\JsonContent(
     *
     *  *      @OA\Property(property="message",type="string",example="The name field is required. (and 1 more error)"),
     *  *      @OA\Property(property="errors",type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="array",
     *
     *                    @OA\Items(
     *
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Name is required."
     *                     ),
     *                    ),
     *                  ),
     *                  @OA\Property(
     *                      property="location_type_id",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="location_type_id",
     *                              type="integer",
     *                              example="Location must be selected"
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="warehouse_id",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="warehouse_id",
     *                              type="integer",
     *                              example="Warehouse must be selected"
     *                          ),
     *                      ),
     *                  ),
     *
     *          ),
     *      )
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function update()
    {
    }

    /**
     * * @OA\Delete(
     *     path="/api/locations/{location}",
     *   * operationId="delete-location",
     * tags={"Locations"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Location id",
     *          in="path",
     *          name="location",
     *          example="_st_Mg==",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *         @OA\Property(property="data",type="string",example="null"),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location deleted successfully"
     *               ),
     *          ),
     *      )
     *   ),
     *
     *   @OA\Response(response=401,description="Unauthorized"),
     *   @OA\Response(response=404,description="Resource not found"),
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     **/
    public function destroy()
    {
    }

    /**
     * @OA\Get(
     *     path="/api/locations/show-barcode/{location}",
     *   * operationId="show-location-barcode",
     * tags={"Locations"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Location id",
     *          in="path",
     *          name="location",
     *          example="_st_Mg==",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=302,
     *          description="Success",
     *
     *              @OA\JsonContent(
     *
     *  *               @OA\Property(property="data",type="object",
     *                        @OA\Property(
     *                         property="locationBarcodeImage",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="locationBarcode",
     *                         type="string",
     *                         example=""
     *                      ),
     *                  ),
     *              ),
     *
     *      ),
     *
     *  ),

     *   ),
     *
     * )
     */
    public function showLocationBarcode()
    {
    }
}
