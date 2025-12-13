<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    protected $productRepository, $productVariantRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository
    ){
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('admin.product.create');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            if($request->product_type == SINGLE_PRODUCT){
                $imagePath = $request->file('product_image')->store('products', 'public');
                $product = $this->productRepository->create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'type' => SINGLE_PRODUCT,
                    'image' => $imagePath,
                    'description' => $request->description,
                    'short_description' => $request->short_description,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
                $this->productVariantRepository->create([
                    'product_id' => $product->id,
                    'sku' => $request->sku,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'stock_quantity' => $request->stock_quantity,
                    'status' => FLAG_ON,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
                $otherImage = $request->file('other_image');
                $productImageRows = [];
                if (!empty($otherImage)) {
                    foreach ($otherImage as $key => $file) {
                        $otherImagePath = $file->store('products/other', 'public');
                        $productImageRows[] = [
                            'product_id' => $product->id,
                            'image_url' => $otherImagePath,
                            'sort_order' => $key + 1,
                            'created_by' => auth()->id(),
                            'created_at' => Carbon::now()->format(DATETIME_FORMAT_SQL),
                            'updated_by' => auth()->id(),
                            'updated_at' => Carbon::now()->format(DATETIME_FORMAT_SQL),
                        ];
                    }
                    DB::table('product_images')->insert($productImageRows);
                }
            }
            DB::commit();
            return response()->json(['message' => 'Tạo sản phẩm thành công', 'success' => true]);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
