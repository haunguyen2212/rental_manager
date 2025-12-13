<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Category";
    }

    /**
     * Search and paginate the user list based on given filters.
     *
     * @param object $search
     * @param int|null $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function searchListCategory($search, $paginate = PAGINATION){
        $query = static::query();
        if(isset($search->name)){
            $query->where('name', 'like', '%'.$search->name.'%');
        }
        if(isset($search->slug)){
            $query->where('slug', 'like', '%'.$search->slug.'%');
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

    /**
     * Retrieve a single category record by ID.
     *
     * @param int $id
     * @return \App\Models\Category|null
     */
    public function getById($id){
        return $this->find($id);
    }

}