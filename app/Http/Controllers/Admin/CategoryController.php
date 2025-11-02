<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategorySearchRequest;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
    ){
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $data['categories'] = $this->categoryRepository->searchListCategory($request);
            return view('admin.category.index', $data);
        }
        catch(\Exception $e){
            throw $e;
        }   
    }

    /**
     * Validate the form for search
     * 
     * @param CategorySearchRequest $request
     * @return Response
     */
    public function validateSearch(CategorySearchRequest $request)
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
            return view('admin.category.create');
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        try{
            $category = $this->categoryRepository->create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
            return response()->json([
                'data' => $category,
                'url_redirect' => route('admin.category.index'),
                'message' => __('messages.insert_success'),
                'success' => true
            ]);
        }
        catch(\Exception $e){
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
        try{
            $data['category'] = $this->categoryRepository->getById($id);
            return view('admin.category.edit', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
         try{
            $params = [
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'updated_by' => auth()->id(),
            ];
            $category = $this->categoryRepository->update($params, $id);
            return response()->json([
                'data' => $category,
                'message' => __('messages.update_success'),
                'success' => true
            ]);
        }
        catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            if(!empty($request->id)){
                $ids = explode(',', $request->id);
                $this->categoryRepository->whereIn('id', $ids)->delete();
                return response()->json(['success' => true, 'message' => __('messages.delete_success')]);
            }
            return response()->json(['success' => true, 'message' => __('messages.delete_error')], 500);
        }
        catch(\Exception $e){
            throw $e;
        }
    }
}
