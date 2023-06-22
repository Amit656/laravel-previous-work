<?php

namespace Modules\Locationtype\App\Annotations;

use OpenApi\Annotations as OA;

class LocationTypeAnnotation
{
    /**
     * @OA\Get(
     *     path="/api/location-types",
     *   * operationId="get-all-location-types",
     * tags={"Locationtypes"},
     * security={ {"sanctum": {} }},
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
     *          description="Search location type by name",
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
     *                     property="data",
     *                     type="array",
     *
     *                     @OA\Items(
     *
     *                          @OA\Property(
     *                              property="three_pl_id",
     *                              type="integer",
     *                              example=2
     *                          ),
     *                          @OA\Property(
     *                              property="name",
     *                              type="string",
     *                              example="Canada"
     *                          ),
     *                          @OA\Property(
     *                              property="hash",
     *                              type="string",
     *                              example="_st_MQ=="
     *                          ),
     *
     *                      ),
     *                   ),
     *                   @OA\Property(
     *                         property="first_page_url",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/location-types?page=1"
     *                   ),
     *                   @OA\Property(
     *                         property="from",
     *                         type="integer",
     *                         example="1"
     *                   ),
     *                   @OA\Property(
     *                         property="last_page",
     *                         type="integer",
     *                         example=1
     *                   ),
     *                   @OA\Property(
     *                         property="last_page_url",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/_st_Mg%3D%3D/location-types?page=1"
     *                   ),
     *                   @OA\Property(
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
     *                   ),
     *                   @OA\Property(
     *                         property="next_page_url",
     *                         type="string",
     *                         example=null
     *                   ),
     *                   @OA\Property(
     *                         property="path",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/_st_Mg%3D%3D/location-types"
     *                   ),
     *                   @OA\Property(
     *                         property="per_page",
     *                         type="integer",
     *                         example="10"
     *                   ),
     *                   @OA\Property(
     *                         property="prev_page_url",
     *                         type="string",
     *                         example=null
     *                   ),
     *                   @OA\Property(
     *                         property="to",
     *                         type="integer",
     *                         example=2
     *                   ),
     *                   @OA\Property(
     *                         property="total",
     *                         type="integer",
     *                         example=2
     *                   ),
     *          ),
     *          @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location types returned successfully"
     *               ),
     *          ),
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
     *     path="/api/location-types",
     *   * operationId="create-location-type",
     * tags={"Locationtypes"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              required={"name"},
     *
     *              @OA\Property(property="name",type="string",example="Ontario"),
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
     *                         property="name",
     *                         type="string",
     *                         example="Ontario",
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-04-20 05:34:12"
     *                      ),
     *                   ),
     *            @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location type added successfully"
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
     *                       @OA\Items(
     *
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Name is required."
     *                     ),
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
    public function store()
    {
    }

    /**
     * @OA\Get(
     *     path="/api/location-types/{locationType}",
     *   * operationId="get-location-type-by-id",
     * tags={"Locationtypes"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Location type id",
     *          in="path",
     *          name="locationType",
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
     *                         property="name",
     *                         type="string",
     *                         example="Canada",
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-04-13 02:34:45"
     *                      ),
     *                      ),
     *                      ),
     *                   ),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location type showed successfully"
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
     *     path="/api/location-types/{locationType}",
     *   * operationId="update-location-type",
     * tags={"Locationtypes"},
     * security={ {"sanctum": {} }},
     *
     * @OA\Parameter(
     *          required=true,
     *          description="Location type id",
     *          in="path",
     *          name="locationType",
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
     *              required={"name"},
     *
     *              @OA\Property(property="name",type="string",example="Location Type Name"),
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
     *                         property="name",
     *                         type="string",
     *                         example="Canada",
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="string",
     *                         example="_st_Mg=="
     *                      ),
     *                    @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-04-20 03:23:45"
     *                      ),
     *                   ),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location type updated successfully"
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
     *     path="/api/location-types/{locationType}",
     *   * operationId="delete-location-type",
     * tags={"Locationtypes"},
     * security={ {"sanctum": {} }},
     *  
*      * @OA\Parameter(
*          required=true,
*          description="Location type id",
*          in="path",
*          name="locationType",
*          example="_st_Mg==",
*
*          @OA\Schema(
*              type="string"
*          )
     *   ),
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
     *                  example="Location type deleted successfully"
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
     *     path="/api/all/location-types",
     *   * operationId="all-location-types",
     * tags={"Locationtypes"},   *
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
     *                         property="name",
     *                         type="string",
     *                         example="Location type name"
     *                      ),
     *                      @OA\Property(
     *                         property="hash",
     *                         type="string",
     *                         example="_st_Mg=="
     *                      ),
     *
     *                  ),
     *
     *          ),
     *              @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Location type list returned successfully"
     *               ),
     *               ),
     *      ),
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function getLocationTypes()
    {
    }
}
