<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategorySearchRequest;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();
            $category = $this->categoryRepository->create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
            write_activity_log('create', "Đã tạo danh mục mới: {$category->name} (id={$category->id})");
            DB::commit();
            return response()->json([
                'data' => $category,
                'url_redirect' => route('admin.category.index'),
                'message' => __('messages.insert_success'),
                'success' => true
            ]);
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
            $oldData = $this->categoryRepository->getById($id);
            $dataChange = $this->parseDataChangeCategory($oldData->toArray(), $params);
            if($dataChange['is_changed']){
                DB::beginTransaction();
                $category = $this->categoryRepository->update($params, $id);
                write_activity_log('update', "Đã cập nhật thông tin danh mục: {$category->name} (id={$category->id}) <br> {$dataChange['message']}");
                DB::commit();
                return response()->json([
                    'data' => $category,
                    'message' => __('messages.update_success'),
                    'success' => true
                ]);
            }
            return response()->json([
                'data' => $oldData,
                'message' => __('messages.update_no_change'),
                'success' => true
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Parse the data change category
     * 
     * @param array $before
     * @param array $after
     * @return array
     */
    private function parseDataChangeCategory($before = [], $after = []){
        try{
            $data = [];
            $message = '';
            $attributes = [
                'name' => 'Tên danh mục',
                'slug' => 'Slug',
                'description' => 'Mô tả',
            ];
            foreach($after as $key => $value){
                if(in_array($key, ['updated_by'])){
                    continue;
                }
                if($value != $before[$key]){
                    $data[$key] = $value;
                    if($key == 'description'){
                        $message .= " - {$attributes[$key]} đã được thay đổi.";
                    }
                    else{
                        $message .= " - {$attributes[$key]}: {$before[$key]} → {$value} <br> ";
                    }
                }
            }
            return [
                'is_changed' => !empty($data),
                'data' => $data,
                'message' => $message,
            ];
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
                DB::beginTransaction();
                $ids = explode(',', $request->id);
                $categories = $this->categoryRepository->whereIn('id', $ids)->pluck('name', 'id')->toArray();
                $categoryDelete = [];
                foreach ($categories as $id => $name) {
                    $categoryDelete[] = "{$name} (id={$id})";
                }
                $categoryDeleteText = implode(', ', $categoryDelete);
                $totalCategoryDelete = count($categories);
                $this->categoryRepository->whereIn('id', $ids)->delete();
                write_activity_log('delete', "Đã xóa {$totalCategoryDelete} danh mục: {$categoryDeleteText}");
                DB::commit();
                return response()->json(['success' => true, 'message' => __('messages.delete_success')]);
            }
            return response()->json(['success' => true, 'message' => __('messages.delete_error')], 500);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
