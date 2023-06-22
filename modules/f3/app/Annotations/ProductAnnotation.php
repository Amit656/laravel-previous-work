<?php

namespace Modules\Product\App\Annotations;

use OpenApi\Annotations as OA;

class ProductAnnotation
{
    /**
     * * @OA\Post(
     *     path="/api/products",
     *   * operationId="create-product",
     * tags={"Product"},
     * security={{"sanctum":{}}},
     *
     *   @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              required={"warehouse_id","name", "sku", "is_kit"},
     *
     *              @OA\Property(property="three_pl_customer_id",type="string",example="_st_MjI="),
     *              @OA\Property(property="warehouse_id",type="integer",example="_st_MjI="),
     *              @OA\Property(property="name",type="string",example="Product Name"),
     *              @OA\Property(property="is_kit",type="boolean",example="false"),
     *              @OA\Property(property="value",type="float",example="11.11"),
     *              @OA\Property(property="weight",type="float",example="11.11"),
     *              @OA\Property(property="sku",type="string",example="GAJJSJDS0DJS0323"),
     *              @OA\Property(property="barcode",type="integer",example="123456789"),
     *              @OA\Property(property="images",type="array", @OA\Items(type="file")),
     *              @OA\Property(property="vendors",type="array",@OA\Items(type="integer")),
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
     *        @OA\Property(property="data",type="object",
     *          ),
     *@OA\Property(property="metadata",type="object",
     *                  @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="Product has been added successfully."
     *                  ),
     *           ),
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
     *                         property="name",
     *                         type="array",
     *
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="name is required."
     *                      ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="array",
     *
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="string",
     *                         example="The 3pl customer field is required."
     *                      ),
     *                      ),
     *                  ),
     *                   @OA\Property(
     *                         property="warehouse_id",
     *                         type="array",
     *
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="string",
     *                         example="The warehouse field is required and must be an array."
     *                      ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                         property="is_kit",
     *                         type="array",
     *
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="is_kit",
     *                         type="boolean",
     *                         example="The is kit field is required and must boolean."
     *                      ),
     *                      ),
     *                  ),
     * *                  @OA\Property(
     *                         property="value",
     *                         type="array",
     *
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="value",
     *                         type="float",
     *                         example="The value field must be float number."
     *                      ),
     *                      ),
     *                  ),
     *                   @OA\Property(
     *                         property="weight",
     *                         type="array",
     *
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="weight",
     *                         type="float",
     *                         example="The weight field must be float number."
     *                      ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                         property="sku",
     *                         type="array",
     *
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="sku",
     *                         type="string",
     *                         example="The sku field is required."
     *                      ),
     *                      ),
     *                  ),
     *              ),
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
     *     path="/api/products",
     *   * operationId="get-all-products",
     * tags={"Product"},
     *  security={{"sanctum":{}}},
     *
     *   @OA\Parameter(
     *          description="Page number",
     *          in="query",
     *          name="page",
     *          example="",
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          )
     *   ),
     *
     *  *   @OA\Parameter(
     *          description="Search by product name or sku",
     *          in="query",
     *          name="search",
     *          example="",
     *
     *          @OA\Schema(
     *              type="string",
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
     *                            @OA\Items(
     *
     *                      @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="string",
     *                         example="_st_MQ=="
     *                      ),
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="string",
     *                         example="_st_Mg=="
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Product name"
     *                      ),
     *                      @OA\Property(
     *                         property="is_kit",
     *                         type="boolean",
     *                         example="true"
     *                      ),
     *                      @OA\Property(
     *                         property="value",
     *                         type="float",
     *                         example="32.32"
     *                      ),
     *                      @OA\Property(
     *                         property="weight",
     *                         type="float",
     *                         example="61987213.95"
     *                      ),
     *                      @OA\Property(
     *                         property="sku",
     *                         type="string",
     *                         example="sapiente"
     *                      ),
     *                      @OA\Property(
     *                         property="barcode",
     *                         type="numeric",
     *                         example="104258753772"
     *                      ),
     *                      @OA\Property(
     *                          property="hash",
     *                          type="string",
     *                          example="_st_MjI="
     *                                ),
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
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/threepl?page=1"
     *                      ),
     *                       @OA\Property(
     *                         property="from",
     *                         type="integer",
     *                         example="1"
     *                      ),
     *                       @OA\Property(
     *                         property="next_page_url",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/threepl?page=2"
     *                      ),
     *                       @OA\Property(
     *                         property="path",
     *                         type="string",
     *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/threepl"
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
     *                  example="Product returned successfully."
     *               ),
     *               ),
     *      )
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
     * @OA\Get(
     *     path="/api/products/{product}",
     *   * operationId="get-product-by-id",
     * tags={"Product"},
     * security={{"sanctum":{}}},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="Product hash",
     *          in="path",
     *          name="product",
     *          example="_st_MjI=",
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
     *                     @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="string",
     *                         example="_st_MQ=="
     *                      ),
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="string",
     *                         example="_st_Mg=="
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Product name"
     *                      ),
     *                      @OA\Property(
     *                         property="is_kit",
     *                         type="boolean",
     *                         example="true"
     *                      ),
     *                      @OA\Property(
     *                         property="value",
     *                         type="float",
     *                         example="32.32"
     *                      ),
     *                      @OA\Property(
     *                         property="weight",
     *                         type="float",
     *                         example="61987213.95"
     *                      ),
     *                      @OA\Property(
     *                         property="sku",
     *                         type="string",
     *                         example="sapiente"
     *                      ),
     *                      @OA\Property(
     *                         property="barcode",
     *                         type="numeric",
     *                         example="104258753772"
     *                      ),
     *                      @OA\Property(
     *                          property="hash",
     *                          type="string",
     *                          example="_st_MjI="
     *                                ),
     *                          ),
     *                       @OA\Property(property="metadata",type="object",
     *                       @OA\Property(
     *                           property="message",
     *                              type="string",
     *                           example="Product returned successfully."
     *                       ),
     *                  ),
     *              ),
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
     * * @OA\Delete(
     *     path="/api/products/{product}",
     *   * operationId="delete-product",
     * tags={"Product"},
     *  security={{"sanctum":{}}},
     *
     *      @OA\Parameter(
     *          required=true,
     *          description="product id",
     *          in="path",
     *          name="product",
     *          example="_st_MQ==",
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
     *         @OA\Property(property="data",type="boolean",example="true"),
     * @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Product deleted successfully."
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
     * * @OA\Put(
     *     path="/api/products/{product}",
     *   * operationId="update-product",
     * tags={"Product"},
     *  security={{"sanctum":{}}},
     *
     *  @OA\Parameter(
     *          required=true,
     *          description="Product id",
     *          in="path",
     *          name="product",
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
     *              required={"warehouse_id","name", "sku", "is_kit", "status"},
     *
     *              @OA\Property(property="three_pl_customer_id",type="string",example="_st_MjI="),
     *              @OA\Property(property="warehouse_id",type="integer",example="_st_MjI="),
     *              @OA\Property(property="name",type="string",example="Product Name"),
     *              @OA\Property(property="is_kit",type="boolean",example="false"),
     *              @OA\Property(property="value",type="float",example="11.11"),
     *              @OA\Property(property="weight",type="float",example="11.11"),
     *              @OA\Property(property="sku",type="string",example="GAJJSJDS0DJS0323"),
     *              @OA\Property(property="barcode",type="integer",example="123456789"),
     *              @OA\Property(property="status",type="boolean",example="true"),
     *              @OA\Property(property="height",type="float",example="1.1"),
     *              @OA\Property(property="width",type="float",example="1.1"),
     *              @OA\Property(property="length",type="float",example="1.1"),
     *              @OA\Property(property="custom_value",type="float",example="1.1"),
     *              @OA\Property(property="custom_description",type="float",example="1.1"),
     *              @OA\Property(property="price",type="float",example="1.1"),
     *              @OA\Property(property="reserve",type="integer",example="11232"),
     *              @OA\Property(property="reorder_amount",type="integer",example="11232"),
     *              @OA\Property(property="reorder_level",type="integer",example="11232"),
     *              @OA\Property(property="replenishment_level",type="integer",example="11232"),
     *              @OA\Property(property="item_count_full",type="boolean",example="1"),
     *              @OA\Property(property="country_of_manufacturer",type="integer",example="1"),
     *              @OA\Property(property="currency",type="integer",example="1"),
     *              @OA\Property(property="tarrif_code",type="integer",example="1"),
     *              @OA\Property(property="tags",type="string",example="[tag1,tag2,tag3]"),
     *              @OA\Property(property="final_sale_item",type="boolean",example="1"),
     *              @OA\Property(property="cycle_count",type="boolean",example="1"),
     *              @OA\Property(property="add_to_invoice",type="boolean",example="1"),
     *              @OA\Property(property="dont_show_on_custom_form",type="boolean",example="1"),
     *              @OA\Property(property="assembly_sku",type="boolean",example="1"),
     *              @OA\Property(property="dropship_only",type="boolean",example="1"),
     *              @OA\Property(property="need_serial_number",type="boolean",example="1"),
     *              @OA\Property(property="lithium_ion",type="boolean",example="1"),
     *              @OA\Property(property="is_virtual",type="boolean",example="1"),
     *              @OA\Property(property="dangerous_goods_code",type="integer",example="1"),
     *              @OA\Property(property="auto_fulfill",type="boolean",example="1"),
     *              @OA\Property(property="auto_pack",type="boolean",example="1"),
     *              @OA\Property(property="product_note",type="string",example="Product Note"),
     *              @OA\Property(property="product_packer_note",type="string",example="Product packer note"),
     *              @OA\Property(property="product_return_note",type="string",example="Product return Note"),
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *        @OA\Property(property="data",type="object",
     *                 @OA\Property(property="metadata",type="object",
     *                  @OA\Property(
     *                     property="message",
     *                     type="string",
     *                     example="3PL updated successfully."
     *                  ),
     *                  ),
     *          ),
     *   ),
     *
     *   @OA\Response(
     *      response=422,
     *       description="Validation error for required",
     *
     *      @OA\JsonContent(
     *
     *            @OA\Property(property="message",type="string",example="The name field is required. (and 1 more error)"),
     *  *      @OA\Property(property="errors",type="object",
     *                  @OA\Property(
     *                         property="name",
     *                         type="array",
     *
     *                      @OA\Items(
     *
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="name is required."
     *                      ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="array",
     *
     *                      @OA\Items(
     *
     *                      @OA\Property(
     *                         property="three_pl_customer_id",
     *                         type="string",
     *                         example="The 3pl customer field is required."
     *                      ),
     *                      ),
     *                  ),
     *                   @OA\Property(
     *                         property="warehouse_id",
     *                         type="array",
     *
     *                      @OA\Items(
     *
     *                      @OA\Property(
     *                         property="warehouse_id",
     *                         type="string",
     *                         example="The warehouse field is required and must be an array."
     *                      ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                         property="is_kit",
     *                         type="array",
     *
     *                      @OA\Items(
     *
     *                      @OA\Property(
     *                         property="is_kit",
     *                         type="boolean",
     *                         example="The is kit field is required and must boolean."
     *                      ),
     *                      ),
     *                  ),
     * *                  @OA\Property(
     *                         property="value",
     *                         type="array",
     *
     *                      @OA\Items(
     *
     *                      @OA\Property(
     *                         property="value",
     *                         type="float",
     *                         example="The value field must be float number."
     *                      ),
     *                      ),
     *                  ),
     *                   @OA\Property(
     *                         property="weight",
     *                         type="array",
     *
     *                      @OA\Items(
     *
     *                      @OA\Property(
     *                         property="weight",
     *                         type="float",
     *                         example="The weight field must be float number."
     *                      ),
     *                      ),
     *                  ),
     *                  @OA\Property(
     *                         property="sku",
     *                         type="array",
     *
     *                      @OA\Items(
     *
     *                      @OA\Property(
     *                         property="sku",
     *                         type="string",
     *                         example="The sku field is required."
     *                      ),
     *                      ),
     *                  ),
     *              ),
     *              ),
     *              ),
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
       *     path="/api/vendor/products/{vendorid}",
       *     operationId="vendor-products",
       *     tags={"Product"},
       *     security={{"sanctum":{}}},
       *
       *      @OA\Parameter(
       *          required=true,
       *          description="Vendor id ",
       *          in="path",
       *          name="vendorid",
       *          example="_st_Mg==",
       *
       *          @OA\Schema(
       *              type="string"
       *          )
       *   ),
       *
       *      @OA\Parameter(
       *          description="Filter by product, SKU",
       *          in="query",
       *          name="name",
       *
       *          @OA\Schema(
       *              type="string"
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
       *   ),
       *
       *      @OA\Parameter(
       *          description="Limit",
       *          in="query",
       *          name="per_page",
       *          example="1",
       *
       *          @OA\Schema(
       *              type="integer",
       *              format="int64",
       *          )
       *   ),
       *
       *   @OA\Response(
       *      response=200,
       *      description="Success",
       *
       *      @OA\JsonContent(
       *
       *         @OA\Property(property="data",type="object",
       *                  @OA\Property(
       *                      property="current_page",
       *                      type="integer",
       *                      example="1"
       *                  ),
       *                  @OA\Property(
       *                         property="data",
       *                         type="array",
       *
       *                         @OA\Items(
       *
       *                              @OA\Property(
       *                                  property="three_pl_customer_id",
       *                                  type="string",
       *                                  example="_st_MQ=="
       *                              ),
       *                              @OA\Property(
       *                                  property="warehouse_id",
       *                                  type="string",
       *                                  example="_st_Mg=="
       *                              ),
       *                              @OA\Property(
       *                                  property="name",
       *                                  type="string",
       *                                  example="Product name"
       *                              ),
       *                              @OA\Property(
       *                                  property="is_kit",
       *                                  type="boolean",
       *                                  example=true
       *                              ),
       *                              @OA\Property(
       *                                  property="value",
       *                                  type="float",
       *                                  example="32.32"
       *                              ),
       *                              @OA\Property(
       *                                  property="weight",
       *                                  type="float",
       *                                  example="61987213.95"
       *                              ),
       *                              @OA\Property(
       *                                  property="sku",
       *                                  type="string",
       *                                  example="sapiente"
       *                              ),
       *                              @OA\Property(
       *                                  property="barcode",
       *                                  type="numeric",
       *                                  example="104258753772"
       *                              ),
       *                              @OA\Property(
       *                                  property="status",
       *                                  type="boolean",
       *                                  example=true
       *                              ),
       *                              @OA\Property(
       *                                  property="last_updated_by",
       *                                  type="integer",
       *                                  example=2
       *                              ),
       *                              @OA\Property(
       *                                  property="hash",
       *                                  type="string",
       *                                  example="_st_MjI="
       *                              ),
       *
       *                         ),
       *                      ),
       *                      @OA\Property(
       *                         property="first_page_url",
       *                         type="string",
       *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/vendor/products?page=1"
       *                      ),
       *                      @OA\Property(
       *                         property="from",
       *                         type="integer",
       *                         example=1
       *                      ),
       * *                    @OA\Property(
       *                         property="last_page",
       *                         type="integer",
       *                         example=1
       *                      ),
       *                      @OA\Property(
       *                         property="last_page_url",
       *                         type="string",
       *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/vendor/products?page=1"
       *                      ),
       *                      @OA\Property(
       *                         property="links",
       *                         type="array",
       *
       *                         @OA\Items(
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
       *                         ),
       *                      ),
       *                      @OA\Property(
       *                         property="next_page_url",
       *                         type="string",
       *                         example=null
       *                      ),
       *                      @OA\Property(
       *                         property="path",
       *                         type="string",
       *                         example="http://localhost/stallion/wh-super-admin-backend/public/api/vendor/products"
       *                      ),
       *                      @OA\Property(
       *                         property="per_page",
       *                         type="integer",
       *                         example=10
       *                      ),
       *                      @OA\Property(
       *                         property="prev_page_url",
       *                         type="string",
       *                         example=null
       *                      ),
       *                      @OA\Property(
       *                         property="to",
       *                         type="integer",
       *                         example=3
       *                      ),
       *          ),
       *          @OA\Property(property="metadata",type="object",
       *              @OA\Property(
       *                  property="message",
       *                  type="string",
       *                  example="Vendor products returned successfully"
       *               ),
       *          ),
       *      )
       *   ),
       *
       *   @OA\Response(response=500,description="Internal server error"),
       *
       * )
       */
      public function getProductsByVendor()
      {
      }

      /**
       * @OA\Get(
       *     path="/api/products/search/{vendorid}",
       *     operationId="search-products-for-vendor",
       *     tags={"Vendors Product"},
       *     security={{"sanctum":{}}},
       *
       *      @OA\Parameter(
       *          required=true,
       *          description="Vendor id ",
       *          in="path",
       *          name="vendorid",
       *          example="_st_MQ==",
       *
       *          @OA\Schema(
       *              type="string"
       *          )
       *      ),
       *
       *      @OA\Parameter(
       *          description="Filter by product, SKU",
       *          in="query",
       *          name="search",
       *
       *          @OA\Schema(
       *              type="string"
       *          )
       *      ),
       *
       *   @OA\Response(
       *      response=200,
       *      description="Success",
       *
       *      @OA\JsonContent(
       *
       *                  @OA\Property(
       *                         property="data",
       *                         type="array",
       *
       *                         @OA\Items(
       *
       *                              @OA\Property(
       *                                  property="hash",
       *                                  type="string",
       *                                  example="_st_Mg=="
       *                              ),
       *                              @OA\Property(
       *                                  property="name",
       *                                  type="string",
       *                                  example="Product Name"
       *                              ),
       *                              @OA\Property(
       *                                  property="sku",
       *                                  type="string",
       *                                  example="78765456"
       *                              ),
       *                          ),
       *                    ),
       *      ),
       *   ),
       *
       *   @OA\Response(response=500,description="Internal server error"),
       *
       * )
       */
      public function searchProductsForVendor()
      {
      }

      /**
       * @OA\Get(
       *     path="/api/product/vendors/{productId}",
       *     operationId="Get-vendor-by-product",
       *     tags={"Product"},
       *     security={{"sanctum":{}}},
       *
       *      @OA\Parameter(
       *          required=true,
       *          description="Product id ",
       *          in="path",
       *          name="productId",
       *          example="_st_Mg==",
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
       *      @OA\Parameter(
       *          description="Limit",
       *          in="query",
       *          name="per_page",
       *          example="1",
       *
       *          @OA\Schema(
       *              type="integer",
       *              format="int64",
       *          )
       *   ),
       *
       *   @OA\Response(
       *      response=200,
       *      description="Success",
       *
       *      @OA\JsonContent(
       *
       *         @OA\Property(property="data",type="object",
       *                  @OA\Property(
       *                         property="data",
       *                         type="array",
       *
       *                         @OA\Items(
       *
       *                              @OA\Property(
       *                                  property="price",
       *                                  type="float",
       *                                  example="100.12"
       *                              ),
       *                              @OA\Property(
       *                                  property="manufacturer_sku",
       *                                  type="string",
       *                                  example="SHJD-EUNF-DN"
       *                              ),
       *                              @OA\Property(
       *                                  property="hash",
       *                                  type="string",
       *                                  example="_st_Ng== name"
       *                              ),
       *                              @OA\Property(
       *                                  property="details",
       *                                  type="object",
       *                              @OA\Property(
       *                                  property="name",
       *                                  type="string",
       *                                  example="Steve"
       *                              ),
       *                              @OA\Property(
       *                                  property="email",
       *                                  type="string",
       *                                  example="vendor@gmail.com"
       *                              ),
       *                              @OA\Property(
       *                                  property="account_number",
       *                                  type="number",
       *                                  example="324234232"
       *                              ),
       *                              @OA\Property(
       *                                  property="internal_note",
       *                                  type="string",
       *                                  example="100.12"
       *                              ),
       *                              @OA\Property(
       *                                  property="po_note",
       *                                  type="string",
       *                                  example="PO Note"
       *                              ),
       *                              @OA\Property(
       *                                  property="address_one",
       *                                  type="string",
       *                                  example="Address 1"
       *                              ),
       *                              @OA\Property(
       *                                  property="city",
       *                                  type="string",
       *                                  example="Ontario"
       *                              ),
       *                              @OA\Property(
       *                                  property="zip_code",
       *                                  type="string",
       *                                  example="100312"
       *                              ),
       *                              @OA\Property(
       *                                  property="country",
       *                                  type="integer",
       *                                  example="1"
       *                              ),
       *                              @OA\Property(
       *                                  property="currency",
       *                                  type="integer",
       *                                  example="1"
       *                              ),
       *                              @OA\Property(
       *                                  property="state",
       *                                  type="string",
       *                                  example="Ontario"
       *                              ),
       *                              @OA\Property(
       *                                  property="hash",
       *                                  type="string",
       *                                  example="_st_MQ=="
       *                              ),
       *                              ),
       *
       *                         ),
       *                      ),
       *          ),
       *          @OA\Property(property="metadata",type="object",
       *              @OA\Property(
       *                  property="message",
       *                  type="string",
       *                  example="Vendor products returned successfully"
       *               ),
       *          ),
       *      )
       *   ),
       *
       *   @OA\Response(response=500,description="Internal server error"),
       *
       * )
       */
      public function getVendorsByProducts()
      {
      }

        /**
         *   @OA\Delete(
         *     path="/api/vendor/products/delete-vendor-product",
         *     operationId="delete-vendor-product",
         *     tags={"Vendors Product"},
         *     security={ {"sanctum": {} }},
         *
         *   @OA\RequestBody(
         *          required=true,
         *
         *          @OA\JsonContent(
         *               required={"product_id, vendor_id"},
         *
         *               @OA\Property(property="product_id",type="string",example="_st_MQ=="),
         *               @OA\Property(property="vendor_id",type="string",example="_st_MQ=="),
         *
         *          )
         *   ),
         *
         *   @OA\Response(
         *      response=201,
         *       description="Success",
         *
         *       @OA\JsonContent(
         *
         *        @OA\Property(property="data",type="boolean",example=null),
         *            @OA\Property(property="metadata",type="object",
         *              @OA\Property(
         *                  property="message",
         *                  type="string",
         *                  example="Vendor product deleted successfully"
         *               ),
         *             ),
         *          ),
         *   ),
         *
         *   @OA\Response(response=500,description="Internal server error"),
         *
         * )
         */
        public function deleteVendorProduct()
        {
        }

    /**
     *  @OA\Put(
     *     path="/api/vendor/products/update/{productVendorId}",
     *     operationId="update-vendor-product",
     *     tags={"Vendors Product"},
     *     security={ {"sanctum": {} }},
     *
     *  @OA\Parameter(
     *          required=true,
     *          description="Product Vendor id ",
     *          in="path",
     *          name="productVendorId",
     *          example="_st_Mg==",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     *  @OA\Parameter(
     *          required=false,
     *          description="Price",
     *          in="path",
     *          name="price",
     *          example=23.56,
     *
     *          @OA\Schema(
     *              type="decimal"
     *          )
     *   ),
     *
     *   @OA\Parameter(
     *          required=false,
     *          description="Manufacturer SKU",
     *          in="path",
     *          name="manufacturer_sku",
     *          example="QWE123",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *
     *   @OA\RequestBody(
     *          required=false,
     *
     *          @OA\JsonContent(
     *              required={"price", "manufacturer_sku"},
     *
     *              @OA\Property(property="price",type="decimal",example=34.56),
     *              @OA\Property(property="manufacturer_sku",type="string",example="QWE123"),
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *         @OA\Property(property="data",type="object",
     *                      example="[]"
     *         ),
     *          @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Vendor product updated successfully"
     *               ),
     *          ),
     *       ),
     *   ),
     *
     *   @OA\Response(response=500,description="Internal server error"),
     *
     * )
     */
    public function updateVendorProduct()
    {
    }

    /**
     *  @OA\Post(
     *     path="/api/vendor/products/assign",
     *     operationId="assign-product-to-vendor",
     *     tags={"Vendors Product"},
     *     security={ {"sanctum": {} }},
     *
     *     @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              required={"product_id, vendor_id"},
     *
     *              @OA\Property(property="product_id",type="string",example="_st_MQ=="),
     *              @OA\Property(property="vendor_id",type="string",example="_st_MQ=="),
     *          )
     *   ),
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *
     *      @OA\JsonContent(
     *
     *  *      @OA\Property(property="data",type="object",example="[]"
     *
     *         ),
     *         @OA\Property(property="metadata",type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Product assigned to vendor successfully"
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
     *  *      @OA\Property(property="message",type="string",example="The product_id field is required. (and 1 more error)"),
     *  *      @OA\Property(property="errors",type="object",
     *                  @OA\Property(
     *                      property="product_id",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                                  property="product_id",
     *                                  type="string",
     *                                  example="product_id is required."
     *                              ),
     *                          ),
     *                  ),
     *                  @OA\Property(
     *                      property="vendor_id",
     *                      type="array",
     *
     *                          @OA\Items(
     *
     *                              @OA\Property(
     *                                  property="vendor_id",
     *                                  type="string",
     *                                  example="vendor_id is required."
     *                              ),
     *                          ),
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
    public function assignProductToVendor()
    {
    }
}
