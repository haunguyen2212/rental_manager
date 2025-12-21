<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductSearchRequest;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\ProductVariantRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    protected $productRepository, $productVariantRepository, $productImageRepository;
    protected $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        ProductImageRepository $productImageRepository,
        CategoryRepository $categoryRepository
    ){
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->productImageRepository = $productImageRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $data['products'] = $this->productRepository->searchListProduct($request);
            $data['option'] = [
                'category' => $this->categoryRepository->getDropDown(),
                'status' => ['' => ''] + PRODUCT_STATUS,
                'type' => ['' => ''] + PRODUCT_TYPE,
            ];
            return view('admin.product.index', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Validate the form for search
     * 
     * @param ProductSearchRequest $request
     * @return Response
     */
    public function validateSearch(ProductSearchRequest $request)
    {
        try{
            return response()->json([
                'data' => $request->validated(),
                'success' => true
            ]);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $data['option']['category'] = $this->categoryRepository->getDropDown();
            return view('admin.product.create', $data);
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
            
            // Determine status based on save_as_draft
            $status = $request->input('save_as_draft') == '1' ? PRODUCT_STATUS_DRAFT : PRODUCT_STATUS_PUBLIC;
            
            if($request->product_type == SINGLE_PRODUCT){
                $imagePath = null;
                if ($request->hasFile('product_image')) {
                    $imagePath = $request->file('product_image')->store('products', 'public');
                }
                
                $product = $this->productRepository->create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'type' => SINGLE_PRODUCT,
                    'category_id' => $request->category_id,
                    'image' => $imagePath,
                    'status' => $status,
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
                if (!empty($otherImage)) {
                    foreach ($otherImage as $key => $file) {
                        $otherImagePath = $file->store('products/other', 'public');
                        $productImageRows = [
                            'product_id' => $product->id,
                            'image_url' => $otherImagePath,
                            'sort_order' => $key + 1,
                            'created_by' => auth()->id(),
                            'updated_by' => auth()->id(),
                        ];
                        $this->productImageRepository->create($productImageRows);
                    }
                    
                }
            }
            elseif($request->product_type == VARIANT_PRODUCT){
                $imagePath = null;
                if ($request->hasFile('product_image')) {
                    $imagePath = $request->file('product_image')->store('products', 'public');
                }
                
                $product = $this->productRepository->create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'type' => VARIANT_PRODUCT,
                    'category_id' => $request->category_id,
                    'image' => $imagePath,
                    'status' => $status,
                    'description' => $request->description,
                    'short_description' => $request->short_description,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
                
                // Get variant data from request arrays
                $prices = $request->input('price', []);
                $salePrices = $request->input('sale_price', []);
                $stockQuantities = $request->input('stock_quantity', []);
                $skus = $request->input('sku', []);
                $variantImages = $request->file('variant_image', []);
                $displayFlgs = $request->input('display_flg', []);
                
                // Loop through variants and create them
                if (!empty($prices) && is_array($prices)) {
                    foreach ($prices as $index => $price) {
                        $variantData = [
                            'product_id' => $product->id,
                            'sku' => $skus[$index] ?? null,
                            'price' => $price,
                            'sale_price' => $salePrices[$index] ?? null,
                            'stock_quantity' => $stockQuantities[$index] ?? 0,
                            'status' => isset($displayFlgs[$index]) && $displayFlgs[$index] ? FLAG_ON : FLAG_OFF,
                            'created_by' => auth()->id(),
                            'updated_by' => auth()->id(),
                        ];
                        
                        // Handle variant image if exists
                        if (isset($variantImages[$index]) && $variantImages[$index]) {
                            $variantImagePath = $variantImages[$index]->store('products/variants', 'public');
                            $variantData['thumbnail'] = $variantImagePath;
                        }
                        
                        $this->productVariantRepository->create($variantData);
                    }
                }
                
                // Handle other images (similar to SINGLE_PRODUCT)
                $otherImage = $request->file('other_image');
                if (!empty($otherImage)) {
                    foreach ($otherImage as $key => $file) {
                        $otherImagePath = $file->store('products/other', 'public');
                        $productImageRows = [
                            'product_id' => $product->id,
                            'image_url' => $otherImagePath,
                            'sort_order' => $key + 1,
                            'created_by' => auth()->id(),
                            'updated_by' => auth()->id(),
                        ];
                        $this->productImageRepository->create($productImageRows);
                    }
                }
            }
            if(!empty($product)){
                $action = $status == PRODUCT_STATUS_DRAFT ? 'lưu nháp' : 'tạo';
                write_activity_log('create', "Đã {$action} sản phẩm: {$product->name} (id={$product->id})");
            }
            DB::commit();
            $message = $status == PRODUCT_STATUS_DRAFT ? 'Lưu nháp sản phẩm thành công' : 'Tạo sản phẩm thành công';
            return response()->json(['message' => $message, 'success' => true]);
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
