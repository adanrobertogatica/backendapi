<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Enums\ProductCategory;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductPaginateRequest;

/**
* @OA\Info(
*             title="API Products E-commerce", 
*             version="1.0",
*             description="URL List for MailUp Products API"
* )
*
* @OA\Server(url=L5_SWAGGER_CONST_HOST)
*/

class ProductController extends Controller
{
    private $product_repository;

    public function __construct(ProductRepository $product_repository){

        $this->product_repository = $product_repository;

    }

    /**
     * List all products
     * @OA\Get (
     *     path="/api/products",
     *     tags={"Product"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="MacBook Pro 13.3 Retina"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="MacBook Description"
     *                     ),
     *                     @OA\Property(
     *                         property="image",
     *                         type="string",
     *                         example="apple.com/v/macbook-pro/ac/images/overview/hero_13__d1tfa5zby7e6_large_2x.jpg"
     *                     ),
     *                     @OA\Property(
     *                         property="brand",
     *                         type="string",
     *                         example="Apple"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="float",
     *                         example="2000"
     *                     ),
     *                     @OA\Property(
     *                         property="price_sale",
     *                         type="float",
     *                         example="1950"
     *                     ),
     *                     @OA\Property(
     *                         property="category",
     *                         type="string",
     *                         example="Macbook Pro"
     *                     ),
     *                     @OA\Property(
     *                         property="stock",
     *                         type="integer",
     *                         example="5"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
        return ["data"=>$this->product_repository->all()];
    }

    /**
     * Show product information
     * @OA\Get (
     *     path="/api/products/{id}",
     *     tags={"Product"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="MacBook Pro 13"),
     *              @OA\Property(property="description", type="string", example=""),
     *              @OA\Property(property="image", type="string", example="apple.com/v/macbook-pro/ac/images/overview/hero_13__d1tfa5zby7e6_large_2x.jpg"),
     *              @OA\Property(property="brand", type="string", example="Apple"),
     *              @OA\Property(property="price", type="number", example=2000),
     *              @OA\Property(property="price_sale", type="number", example=1950),
     *              @OA\Property(property="category", type="string", example="Macbook Pro"),
     *              @OA\Property(property="stock", type="number", example=5),
     * 
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Product] #id"),
     *          )
     *      )
     * )
     */
    
     public function show($id)
    {
        return $this->product_repository->get($id);
    }

     /**
     * Register a new product
     * @OA\Post (
     *     path="/api/products",
     *     tags={"Product"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="image",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="brand",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="price",
     *                          type="float"
     *                      ),
     *                      @OA\Property(
     *                          property="price_sale",
     *                          type="float"
     *                      ),
     *                      @OA\Property(
     *                          property="category",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="stock",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                      "name": "Desktop i7 DDR5",
     *                      "description": "Desktop gamer",
     *                      "image": "https://www.megatecnologia.com.ar/thumb/1679754167614_800x800.jpg",
     *                      "brand": "Intel",
     *                      "price": 15.52,
     *                      "price_sale": 11.52,
     *                      "category": "others",
     *                      "stock": 10
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Desktop i7 DDR5"),
     *              @OA\Property(property="description", type="string", example="Desktop gamer"),
     *              @OA\Property(property="image", type="string", example="https://www.megatecnologia.com.ar/thumb/1679754167614_800x800.jpg"),
     *              @OA\Property(property="brand", type="string", example="Intel"),
     *              @OA\Property(property="price", type="number", example=15.52),
     *              @OA\Property(property="price_sale", type="number", example=11.52),
     *              @OA\Property(property="category", type="string", example="others"),
     *              @OA\Property(property="stock", type="number", example=10),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The name field is required."),
     *              @OA\Property(property="errors", type="string", example="Errors object"),
     *          )
     *      )
     * )
     */

     public function store(ProductStoreRequest $request)
    {
        $product = new Product($request->all());
        return $this->product_repository->save($product);
    }

    /**
     * Update a product informatin
     * @OA\Put (
     *     path="/api/products/{id}",
     *     tags={"Product"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="image",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="brand",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="price",
     *                          type="float"
     *                      ),
     *                      @OA\Property(
     *                          property="price_sale",
     *                          type="float"
     *                      ),
     *                      @OA\Property(
     *                          property="category",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="stock",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                      "name": "Desktop i7 DDR5",
     *                      "description": "Desktop gamer",
     *                      "image": "https://www.megatecnologia.com.ar/thumb/1679754167614_800x800.jpg",
     *                      "brand": "Intel",
     *                      "price": 17.52,
     *                      "price_sale": 11.52,
     *                      "category": "others",
     *                      "stock": 10
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Desktop i7 DDR5"),
     *              @OA\Property(property="description", type="string", example="Desktop gamer"),
     *              @OA\Property(property="image", type="string", example="https://www.megatecnologia.com.ar/thumb/1679754167614_800x800.jpg"),
     *              @OA\Property(property="brand", type="string", example="Intel"),
     *              @OA\Property(property="price", type="number", example=15.52),
     *              @OA\Property(property="price_sale", type="number", example=11.52),
     *              @OA\Property(property="category", type="string", example="others"),
     *              @OA\Property(property="stock", type="number", example=10)
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The name field is required."),
     *              @OA\Property(property="errors", type="string", example="Errors object"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Product] #id"),
     *          )
     *      )
     * )
     */

    public function update(ProductUpdateRequest $request, int $id)
    {
        $product=$this->product_repository->get($id);
        $product->fill($request->all());
        return $this->product_repository->save($product);
    }

    /**
     * Delete a product
     * @OA\Delete (
     *     path="/api/products/{id}",
     *     tags={"Product"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content"
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Product] #id"),
     *          )
     *      )
     * )
     */

    public function destroy($id)
    {
        $product=$this->product_repository->get($id);
        return $this->product_repository->delete($product);
    }

    /**
     * List with pagination and filters
     * @OA\Post (
     *     path="/api/products/paginate",
     *     tags={"Product"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="start",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="length",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="search",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="orderdir",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="ordercolumn",
     *                          type="float"
     *                      )
     *                 ),
     *                 example={
     *                      "start": "0",
     *                      "length": "10",
     *                      "search": "MAC",
     *                      "orderdir": "DESC",
     *                      "ordercolumn": "name"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="MacBook Pro 13.3 Retina"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="MacBook Description"
     *                     ),
     *                     @OA\Property(
     *                         property="image",
     *                         type="string",
     *                         example="apple.com/v/macbook-pro/ac/images/overview/hero_13__d1tfa5zby7e6_large_2x.jpg"
     *                     ),
     *                     @OA\Property(
     *                         property="brand",
     *                         type="string",
     *                         example="Apple"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="float",
     *                         example="2000"
     *                     ),
     *                     @OA\Property(
     *                         property="price_sale",
     *                         type="float",
     *                         example="1950"
     *                     ),
     *                     @OA\Property(
     *                         property="category",
     *                         type="string",
     *                         example="Macbook Pro"
     *                     ),
     *                     @OA\Property(
     *                         property="stock",
     *                         type="integer",
     *                         example="5"
     *                     )
     *                 ),
     *             ),
     *             @OA\Property(
     *                  property="recordsTotal",
     *                  type="integer",
     *                  example="6"
     *              ), 
     *             @OA\Property(
     *                  property="recordsFiltered",
     *                  type="integer",
     *                  example="1"
     *              )        
     *         )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The selected orderdir is invalid."),
     *              @OA\Property(property="errors", type="string", example="Errors object"),
     *          )
     *     )
     * )
     */
    public function paginate(ProductPaginateRequest $request)
    {
        /*
        Ejemplo de solicitud postman
        {
            "start":"0",
            "length":"2",
            "search":"Windows",
            "orderdir":"DESC",
            "ordercolumn":"name"
        }
         */
        $start = $request->start;
        $length = $request->length;

        //Datos variables...busqueda y filtros
        $search = $request->search;

        //Direccion y orden
        $order_dir=$request->orderdir;
        $order_name =$request->ordercolumn;

        return $this->product_repository->paginate($start,$length,$order_dir,$order_name,$search); 

    }


}
