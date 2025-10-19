<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\User";
    }

    public function searchListUser($search, $paginate = PAGINATION){
        $query = $this->with(['role']);
        if(isset($search->name)){
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', '%'.$search->name.'%')
                    ->orWhere('name', 'like', '%'.$search->name.'%');
            });
        }
        if(isset($search->role_id)){
            $query->where('role_id', $search->role_id);
        }
        if(isset($search->status)){
            $query->where('status', $search->status);
        }
        if(isset($search->birthday)){
            $query->where('birthday', $search->birthday);
        }
        if(isset($search->phone)){
            $query->where('phone', 'like', '%'.$search->phone.'%');
        }
        if(isset($search->email)){
            $query->where('email', 'like', '%'.$search->email.'%');
        }
        if(empty($paginate)){
            return $query->get();
        }
        return $query->paginate($paginate);
    }

    public function getById($id){
        return $this->find($id);
    }
}