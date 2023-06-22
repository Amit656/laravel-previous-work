<?php

namespace Modules\Vendor\App\Annotations;

use OpenApi\Annotations as OA;

class VendorAnnotation
{
    /**
     * @OA\Get(
     *     path="/api/vendors",
     *   * operationId="get-all-vendors",
     * tags={"Vendors"},
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
     *          description="Search vendor by name",
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
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="integer",
     *                         example=3
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Steve Logistics",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="vendor@gmail.com"
     *                      ),
     *                      @OA\Property(
     *                         property="account_number",
     *                         type="string",
     *                         example="34652745367635"
     *                      ),
     *                      @OA\Property(
     *                         property="internal_note",
     *                         type="string",
     *                         example="Note about vendor"
     *                      ),
     *                      @OA\Property(
     *                         property="po_note",
     *                         type="string",
     *                         example="PO Note"
     *                      ),
     *                      @OA\Property(
     *                         property="address_one",
     *                         type="string",
     *                         example="Address one"
     *                      ),
     *                      @OA\Property(
     *                         property="address_two",
     *                         type="string",
     *                         example="Address two"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Onatrio"
     *                      ),
     *                     @OA\Property(
     *                         property="zip_code",
     *                         type="string",
     *                         example="345768"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="Integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="state",
     *                         type="Integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="currency",
     *                         type="Integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                       @OA\Property(
     *                         property="hash",
     *                         type="string",
     *                         example="_st_Mg=="
     *                      ),
     *                      ),
     *                      ),
     *                      @OA\Property(
     *                         property="first_page_url",
     *                         type="string",
     *                         example="http://localhost/api/vendors?page=1"
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
     *                         example="http://localhost/api/vendors?page=1"
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
     *                         example="http://localhost/api/vendors"
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
     *                       @OA\Property(
     *                         property="to",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="total",
     *                         type="integer",
     *                         example=2
     *                      ),
     *          ),
     *          @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Vendors returned successfully"
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
     *     path="/api/vendors",
     *     operationId="create-vendor",
     *     tags={"Vendors"},
     * security={ {"sanctum": {} }},
     *
     *   @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              required={"name, email, account_number, internal_note, po_note"},
     *
     *              @OA\Property(property="customer_id",type="array",@OA\Items(type="string"),example={"_st_MQ==","_st_Mg=="}),
     *              @OA\Property(property="name",type="string",example="Steve Logistics"),
     *              @OA\Property(property="email",type="email",example="vendor@gmail.com"),
     *              @OA\Property(property="account_number",type="string",example="34652745367635"),
     *              @OA\Property(property="internal_note",type="string",example="Note about vendor"),
     *              @OA\Property(property="po_note",type="string",example="PO Note"),
     *              @OA\Property(property="address_one",type="string",example="Address 1"),
     *              @OA\Property(property="address_two",type="string",example="Address 2"),
     *              @OA\Property(property="city",type="string",example="Ontario"),
     *              @OA\Property(property="zip_code",type="string",example="234567"),
     *              @OA\Property(property="country",type="integer",example=1),
     *              @OA\Property(property="state",type="integer",example=2),
     *              @OA\Property(property="currency",type="integer",example=12),
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *
     *       @OA\JsonContent(
     *
     *         @OA\Property(property="data",type="object",                                             
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Steve Logistics",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="vendor@gmail.com"
     *                      ),
     *                      @OA\Property(
     *                         property="account_number",
     *                         type="string",
     *                         example="34652745367635"
     *                      ),
     *                      @OA\Property(
     *                         property="internal_note",
     *                         type="string",
     *                         example="Note about vendor"
     *                      ),
     *                      @OA\Property(
     *                         property="po_note",
     *                         type="string",
     *                         example="PO Note"
     *                      ),
     *                      @OA\Property(
     *                         property="address_one",
     *                         type="string",
     *                         example="Address one"
     *                      ),
     *                      @OA\Property(
     *                         property="address_two",
     *                         type="string",
     *                         example="Address two"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Onatrio"
     *                      ),
     *                     @OA\Property(
     *                         property="zip_code",
     *                         type="string",
     *                         example="345768"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="Integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="state",
     *                         type="Integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="currency",
     *                         type="Integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                       @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example="2023-05-08 07:50:52"
     *                      ),
     *                   ),
     *            @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Vendor added successfully"
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
     *                          @OA\Items(
     *                              @OA\Property(
     *                              property="name",
     *                              type="string",
     *                              example="Name is required."
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="array",
     *                          @OA\Items(
     *                              @OA\Property(
     *                              property="email",
     *                              type="integer",
     *                              example="Email is required."
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="account_number",
     *                      type="array",
     *                          @OA\Items(
     *                              @OA\Property(
     *                              property="account_number",
     *                              type="integer",
     *                              example="Account number is required"
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="internal_note",
     *                      type="array",
     *                          @OA\Items(
     *                              @OA\Property(
     *                              property="internal_note",
     *                              type="integer",
     *                              example="Internal note is required"
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="po_note",
     *                      type="array",
     *                          @OA\Items(
     *                              @OA\Property(
     *                              property="po_note",
     *                              type="integer",
     *                              example="Po note is required"
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
     *     path="/api/vendors/{vendor}",
     *   * operationId="get-vendor-by-id",
     * tags={"Vendors"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Vendor id",
     *          in="path",
     *          name="vendor",
     *          example="_st_MQ==",
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
     *                         property="three_pl_id",
     *                         type="integer",
     *                         example=2
     *                      ),
     *                      @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="integer",
     *                         example=3
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Brett Logistics",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="brett@gmail.com"
     *                      ),
     *                      @OA\Property(
     *                         property="account_number",
     *                         type="string",
     *                         example="34512345367635"
     *                      ),
     *                      @OA\Property(
     *                         property="internal_note",
     *                         type="string",
     *                         example="Note about vendor"
     *                      ),
     *                      @OA\Property(
     *                         property="po_note",
     *                         type="string",
     *                         example="PO Note"
     *                      ),
     *                      @OA\Property(
     *                         property="address_one",
     *                         type="string",
     *                         example="Address one"
     *                      ),
     *                      @OA\Property(
     *                         property="address_two",
     *                         type="string",
     *                         example="Address two"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Onatrio"
     *                      ),
     *                     @OA\Property(
     *                         property="zip_code",
     *                         type="string",
     *                         example="345768"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="state",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="currency",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                       @OA\Property(
     *                         property="hash",
     *                         type="string",
     *                         example="_st_MQ=="
     *                      ),
     *                      
     *           ),
     *           @OA\Property(property="metadata",type="object",
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="Vendor showed successfully"
     *                 ),
     *              ),
     *            ),
     *          ),
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
     *     path="/api/vendors/{vendor}",
     *   * operationId="update-vendor",
     * tags={"Vendors"},
     * security={ {"sanctum": {} }},
     *  @OA\Parameter(
     *          required=true,
     *          description="Vendor id",
     *          in="path",
     *          name="vendor",
     *          example="_st_MQ==",
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
     *              required={"name, email, account_number, internal_note, po_note"},
     *
     *              @OA\Property(property="name",type="string",example="Steve Logistics"),
     *              @OA\Property(property="email",type="email",example="vendor@gmail.com"),
     *              @OA\Property(property="account_number",type="string",example="34652745367635"),
     *              @OA\Property(property="internal_note",type="string",example="Note about vendor"),
     *              @OA\Property(property="po_note",type="string",example="PO Note"),
     *              @OA\Property(property="address_one",type="string",example="Address 1"),
     *              @OA\Property(property="address_two",type="string",example="Address 2"),
     *              @OA\Property(property="city",type="string",example="Ontario"),
     *              @OA\Property(property="zip_code",type="string",example="234567"),
     *              @OA\Property(property="country",type="integer",example=1),
     *              @OA\Property(property="state",type="integer",example=2),
     *              @OA\Property(property="currency",type="integer",example=12),
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
     *                         property="name",
     *                         type="string",
     *                         example="Steve Logistics",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="vendor@gmail.com"
     *                      ),
     *                      @OA\Property(
     *                         property="account_number",
     *                         type="string",
     *                         example="34652745367635"
     *                      ),
     *                      @OA\Property(
     *                         property="internal_note",
     *                         type="string",
     *                         example="Note about vendor"
     *                      ),
     *                      @OA\Property(
     *                         property="po_note",
     *                         type="string",
     *                         example="PO Note"
     *                      ),
     *                      @OA\Property(
     *                         property="address_one",
     *                         type="string",
     *                         example="Address one"
     *                      ),
     *                      @OA\Property(
     *                         property="address_two",
     *                         type="string",
     *                         example="Address two"
     *                      ),
     *                      @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Onatrio"
     *                      ),
     *                     @OA\Property(
     *                         property="zip_code",
     *                         type="string",
     *                         example="345768"
     *                      ),
     *                      @OA\Property(
     *                         property="country",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="state",
     *                         type="integer",
     *                         example=1
     *                      ),
     *                      @OA\Property(
     *                         property="currency",
     *                         type="integer",
     *                         example=1
     *                      ),                      
     *                      @OA\Property(
     *                         property="last_modified_by",
     *                         type="integer",
     *                         example=1
     *                      ),                      
     *                      @OA\Property(
     *                         property="hash",
     *                         type="string",
     *                         example="_st_MQ=="
     *                      ),
     *                   ),
     *      @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Vendor updated successfully"
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
     *         @OA\Property(property="message",type="string",example="The name field is required. (and 1 more error)"),
     *         @OA\Property(property="errors",type="object",
     *                  
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
     *                      property="email",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="email",
     *                              type="integer",
     *                              example="Email is required."
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="account_number",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="account_number",
     *                              type="integer",
     *                              example="Account number is required"
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="internal_note",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="internal_note",
     *                              type="integer",
     *                              example="Internal note is required"
     *                          ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                      property="po_note",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                              property="po_note",
     *                              type="integer",
     *                              example="Po note is required"
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
     *     path="/api/vendors/{vendor}",
     *   * operationId="delete-vendor",
     * tags={"Vendors"},
     * security={ {"sanctum": {} }},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Vendor id",
     *          in="path",
     *          name="vendor",
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
     *                  example="Vendor deleted successfully"
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
     *     path="/api/3pl-customer/vendors",
     *   * operationId="get-vendors-by-3pl-customer",
     * tags={"Vendors"},
     * security={ {"sanctum": {} }},
     *
     *
     *   @OA\Parameter(
     *          description="Search vendor by name",
     *          in="query",
     *          name="search",
     *          example="Mark Logistics",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *   @OA\Parameter(
     *          description="Three 3pl customer",
     *          in="query",
     *          name="three_pl_customer",
     *          example="_st_mg==",
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
     *  *      @OA\Property(property="data",type="object",
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Steve Logistics",
     *                      ),                                        
     *                      @OA\Property(
     *                         property="hash",
     *                         type="string",
     *                         example="_st_MQ=="
     *                      ),
     *                   ),
     *          @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Vendors returned successfully"
     *               ),
     *           ),
     *      ),
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */

    public function getVendorsBy3plCustomers()
    {
    }

    /**
    * * @OA\Post(
        *     path="/api/vendors/exists",
        *     operationId="vendors-check-exists",
        *     tags={"Vendors"},
        *     security={ {"sanctum": {} }},
        *
        *   @OA\RequestBody(
        *          required=true,
        *
        *          @OA\JsonContent(
        *              required={"vendors"},
        *
        *              @OA\Property(property="vendors",type="array",@OA\Items(type="string"),example={"_st_MQ==","_st_Mg=="}),              
        *          )
        *   ),
        *
        *   @OA\Response(
        *      response=201,
        *       description="Success",
        *
        *       @OA\JsonContent(
        *        @OA\Property(property="data",type="boolean",example="true"),
        *            @OA\Property(property="metadata",type="object",
        *              @OA\Property(
        *                  property="message",
        *                  type="string",
        *                  example="Vendor checked successfully"
        *               ),
        *             ),
        *          ),
        *   ),
        *
        *   @OA\Response(response=500,description="Internal server error"),
        *
        * )
        */
       public function checkVendorExists()
       {
       }
   
}
