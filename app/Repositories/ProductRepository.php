<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Product";
    }

    /**
     * Search and paginate the product list based on given filters.
     *
     * @param object $search
     * @param int|null $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function searchListProduct($search, $paginate = PAGINATION){
        $query = $this->with(['category', 'variants']);
        
        if(isset($search->name)){
            $query->where('name', 'like', '%'.$search->name.'%');
        }
        if(isset($search->slug)){
            $query->where('slug', 'like', '%'.$search->slug.'%');
        }
        if(isset($search->category_id)){
            $query->where('category_id', $search->category_id);
        }
        if(isset($search->status)){
            $query->where('status', $search->status);
        }
        if(isset($search->type)){
            $query->where('type', $search->type);
        }
        
        if (isset($search->sort_field)) {
            $sortType = (isset($search->sort_type) && strtolower($search->sort_type) === 'desc') ? 'desc' : 'asc';
            $query->orderBy($search->sort_field, $sortType);
        }
        else{
            $query->orderBy('id', 'desc');
        }
        
        if(empty($paginate)){
            return $query->get();
        }
        return $query->paginate($paginate);
    }
}