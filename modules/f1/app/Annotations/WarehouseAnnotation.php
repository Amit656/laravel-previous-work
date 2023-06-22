<?php

namespace Modules\Warehouse\App\Annotations;

use OpenApi\Annotations as OA;

class WarehouseAnnotation
{
    /**
     * @OA\Get(
     *     path="/api/{three_pl_id}/warehouses",
     *   * operationId="get-all-warehouses",
     * tags={"Warehouses"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="3pl ID",
     *          in="path",
     *          name="three_pl_id",
     *          example="",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
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
     *   ),
     *
     *   @OA\Parameter(
     *          description="Search",
     *          in="query",
     *          name="search",
     *          example="",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     *   @OA\Parameter(
     *          description="Record per page",
     *          in="query",
     *          name="limit",
     *          example="10",
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
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
     *                  @OA\Property(
     *                      property="current_page",
     *                      type="integer",
     *                      example="1"
     *                  ),
     *                  @OA\Property(
     *                         property="data",
     *                         type="array",
     *
     *                     @OA\Items(
     *
     *                       @OA\Property(
     *                         property="ulid",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Warehouse Name"
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="latitude",
     *                         type="string",
     *                         example="26.84.6695"
     *                      ),
     *                      @OA\Property(
     *                         property="longitude",
     *                         type="string",
     *                         example="80.94616"
     *                      ),
     *                      @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="Unit 1, 6305 Danville Road"
     *                      ),
     *                      @OA\Property(
     *                         property="pin_code",
     *                         type="string",
     *                         example="L5T2H7"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="province",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="string",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="threshold_settings",
     *                         type="array",
     *
     *                              @OA\Items(
     *
     *                            @OA\Property(
     *                            property="sku",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="orders",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="stores",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="three_pl_customers",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                             ),

     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-13 06:57:28"
     *                      ),
     *                      ),
     *                      ),
     *                          @OA\Property(
     *                         property="first_page_url",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/warehouses?page=1"
     *                      ),
     *                       @OA\Property(
     *                         property="from",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                       @OA\Property(
     *                         property="next_page_url",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/warehouses?page=2"
     *                      ),
     *                       @OA\Property(
     *                         property="path",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/warehouses"
     *                      ),
     *                       @OA\Property(
     *                         property="per_page",
     *                         type="integer",
     *                         example="10"
     *                      ),
     *                       @OA\Property(
     *                         property="prev_page_url",
     *                         type="string"
     *                      ),
     *                       @OA\Property(
     *                         property="to",
     *                         type="integer"
     *                      ),
     *          ),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Warehouses returned successfully."
     *               ),
     *               ),
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
     *     path="/api/{three_pl_id}/warehouses",
     *   * operationId="create-warehouse",
     * tags={"Warehouses"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\Parameter(
     *          description="3pl ID",
     *          in="path",
     *          name="three_pl_id",
     *          required=true,
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
     *              required={"name","latitude", "province", "country",
     *                  "longitude","address", "threshold_settings",
     *                  "pin_code","city"},
     *
     *              @OA\Property(property="name",type="string",example="Warehouse Name"),
     *              @OA\Property(property="latitude",type="string",example="33.4444"),
     *              @OA\Property(property="longitude",type="string",example="43.3344"),
     *              @OA\Property(property="country",type="string",example="4"),
     *              @OA\Property(property="province",type="string",example="Province Name"),
     *              @OA\Property(property="city",type="string",example="City Name"),
     *              @OA\Property(property="address",type="string",example="Address"),
     *              @OA\Property(property="pin_code",type="string",description="Pin Code/Zip Code/Postal Code", example="533434"),
     *              @OA\Property(property="threshold_settings",type="object",
     *              @OA\Property(property="three_pl_customers",type="integer",example="10"),
     *                      @OA\Property(property="sku",type="integer",example="10"),
     *                      @OA\Property(property="orders",type="integer",example="10"),
     *                      @OA\Property(property="stores",type="integer",example="10"),
     *               ),
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
     *                       @OA\Property(
     *                         property="ulid",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Warehouse Name",
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="latitude",
     *                         type="string",
     *                         example="26.84.6695"
     *                      ),
     *                      @OA\Property(
     *                         property="longitude",
     *                         type="string",
     *                         example="80.94616"
     *                      ),
     *                      @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="Unit 1, 6305 Danville Road"
     *                      ),
     *                      @OA\Property(
     *                         property="pin_code",
     *                         type="string",
     *                         example="L5T2H7"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="province",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="string",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="threshold_settings",
     *                         type="array",
     *
     *                              @OA\Items(
     *
     *                            @OA\Property(
     *                            property="sku",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="orders",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="stores",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="three_pl_customers",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                             ),

     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-13 06:57:28"
     *                      ),
     *                   ),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Warehouse has been added successfully."
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
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Name is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="latitude",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="latitude",
     *                         type="string",
     *                         example="Latitude is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="longitude",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="logitude",
     *                         type="string",
     *                         example="Longitude is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="address",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="Address is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="pin_code",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="pin_code",
     *                         type="string",
     *                         example="Pin code is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="city",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="City is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="province",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="province",
     *                         type="string",
     *                         example="Province is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="country",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="country",
     *                         type="string",
     *                         example="Country is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.three_pl_customers",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.three_pl_customers",
     *                         type="string",
     *                         example="The threshold settings.three pl customers field is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.sku",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.sku",
     *                         type="string",
     *                         example="The threshold settings.sku field is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.orders",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.orders",
     *                         type="string",
     *                         example="The threshold settings.orders field is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.stores",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.stores",
     *                         type="string",
     *                         example="The threshold settings.stores field is required."
     *                     ),
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
     *     path="/api/{three_pl_id}/warehouses/{warehouse}",
     *   * operationId="get-warehouse-by-id",
     * tags={"Warehouses"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\Parameter(
     *          description="3pl ID",
     *          in="path",
     *          name="three_pl_id",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Warehouse id",
     *          in="path",
     *          name="warehouse",
     *          example="01GT1JY4YM0SX5XY13AY0EGTQD",
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
     *                       @OA\Property(
     *                         property="ulid",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Warehouse Name",
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="latitude",
     *                         type="string",
     *                         example="26.84.6695"
     *                      ),
     *                      @OA\Property(
     *                         property="longitude",
     *                         type="string",
     *                         example="80.94616"
     *                      ),
     *                      @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="Unit 1, 6305 Danville Road"
     *                      ),
     *                      @OA\Property(
     *                         property="pin_code",
     *                         type="string",
     *                         example="L5T2H7"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="province",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="string",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="threshold_settings",
     *                         type="array",
     *
     *                              @OA\Items(
     *
     *                            @OA\Property(
     *                            property="sku",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="orders",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="stores",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="three_pl_customers",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                             ),

     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-13 06:57:28"
     *                      ),
     *                      ),
     *                      ),
     *                   ),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Warehouse has been showed successfully."
     *               ),
     *               ),
     *          ),

     *   ),
     *
     *   @OA\Response(response=404,description="Resource not found"),
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function show()
    {
    }

    /**
     * * * @OA\Put(
     *     path="/api/{three_pl_id}/warehouses/{warehouse}",
     *   * operationId="update-warehouse",
     * tags={"Warehouses"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\Parameter(
     *          description="3pl ID",
     *          in="path",
     *          name="three_pl_id",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     * @OA\Parameter(
     *          required=true,
     *          description="Warehouse id",
     *          in="path",
     *          name="warehouse",
     *          example="01GT1JY4YM0SX5XY13AY0EGTQD",
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
     *              required={"name","latitude", "province", "country",
     *                  "longitude","address", "threshold_settings",
     *                  "pin_code","city"},
     *
     *              @OA\Property(property="name",type="string",example="Warehouse Name"),
     *              @OA\Property(property="latitude",type="string",example="33.4444"),
     *              @OA\Property(property="longitude",type="string",example="43.3344"),
     *              @OA\Property(property="country",type="string",example="4"),
     *              @OA\Property(property="province",type="string",example="Province Name"),
     *              @OA\Property(property="city",type="string",example="City Name"),
     *              @OA\Property(property="address",type="string",example="Address"),
     *              @OA\Property(property="pin_code",type="string",description="Pin Code/Zip Code/Postal Code", example="533434"),
     *              @OA\Property(property="threshold_settings",type="object",
     *               @OA\Property(property="three_pl_customers",type="integer",example="10"),
     *                      @OA\Property(property="sku",type="integer",example="10"),
     *                      @OA\Property(property="orders",type="integer",example="10"),
     *                      @OA\Property(property="stores",type="integer",example="10"),
     *               ),
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
     *                       @OA\Property(
     *                         property="ulid",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Warehouse Name",
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="latitude",
     *                         type="string",
     *                         example="26.84.6695"
     *                      ),
     *                      @OA\Property(
     *                         property="longitude",
     *                         type="string",
     *                         example="80.94616"
     *                      ),
     *                      @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="Unit 1, 6305 Danville Road"
     *                      ),
     *                      @OA\Property(
     *                         property="pin_code",
     *                         type="string",
     *                         example="L5T2H7"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="province",
     *                         type="string",
     *                         example="Mississauga"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="string",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="threshold_settings",
     *                         type="array",
     *
     *                              @OA\Items(
     *
     *                            @OA\Property(
     *                            property="sku",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="orders",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="stores",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                            @OA\Property(
     *                            property="three_pl_customers",
     *                            type="integer",
     *                            example="1"
     *                            ),
     *                             ),

     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-13 06:57:28"
     *                      ),
     *                   ),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Warehouse has been updated successfully."
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
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Name is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="latitude",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="latitude",
     *                         type="string",
     *                         example="Latitude is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="longitude",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="logitude",
     *                         type="string",
     *                         example="Longitude is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="address",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="Address is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="pin_code",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="pin_code",
     *                         type="string",
     *                         example="Pin code is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="city",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="City is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="province",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="province",
     *                         type="string",
     *                         example="Province is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="country",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="country",
     *                         type="string",
     *                         example="Country is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.three_pl_customers",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.three_pl_customers",
     *                         type="string",
     *                         example="The threshold settings.three pl customers field is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.sku",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.sku",
     *                         type="string",
     *                         example="The threshold settings.sku field is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.orders",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.orders",
     *                         type="string",
     *                         example="The threshold settings.orders field is required."
     *                     ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="threshold_settings.stores",
     *                      type="array",
     *
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="threshold_settings.stores",
     *                         type="string",
     *                         example="The threshold settings.stores field is required."
     *                     ),
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
    public function update()
    {
    }

    /**
     * @OA\Get(
     *     path="/api/{three_pl_id}/warehouses/list",
     *   * operationId="3pl warehouses",
     * tags={"Warehouses"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\Parameter(
     *          description="3pl ID",
     *          in="path",
     *          name="three_pl_id",
     *          required=true,
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
     *         @OA\Property(property="data",type="array",
     *
     *                  @OA\Items(
     *
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="ulid",
     *                         type="string",
     *                         example="01GZ0Y82SZM4GK9RDHRGEH4J50"
     *                      ),
     *                       @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Warehouse Name"
     *                      ),
     *
     *                  ),
     *
     *          ),
     *              @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Warehouses returned successfully"
     *               ),
     *               ),
     *      ),
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function get3plWarehouses()
    {
    }

    /**
     * @OA\Get(
     *     path="/api/warehouses/list",
     *   * operationId="all-warehouses",
     * tags={"Warehouses"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *         @OA\Property(property="data",type="array",
     *
     *                  @OA\Items(
     *
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="hash",
     *                         type="string",
     *                         example="_st_MQ=="
     *                      ),
     *                       @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Warehouse Name"
     *                      ),
     *
     *                  ),
     *
     *          ),
     *              @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Warehouses returned successfully"
     *               ),
     *               ),
     *      ),
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function getWarehouses()
    {
    }

    /**
     * * @OA\Post(
     *     path="/api/warehouses/exists",
     *     operationId="check-exists",
     *     tags={"Warehouses"},
     *     security={ {"sanctum": {} }},
     *
     *   @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              required={"warehouses"},
     *
     *              @OA\Property(property="warehouses",type="array",@OA\Items(type="string"),example={"_st_MQ==","_st_Mg=="}),
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *
     *       @OA\JsonContent(
     *
     *        @OA\Property(property="data",type="boolean",example="true"),
     *            @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Warehouse checked successfully"
     *               ),
     *             ),
     *          ),
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function checkWarehouseExists()
    {
    }
}
