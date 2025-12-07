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

    /**
     * Search and paginate the user list based on given filters.
     *
     * @param object $search
     * @param int|null
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
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
     * Retrieve a single user record by ID.
     *
     * @param int $id
     * @return \App\Models\User|null
     */
    public function getById($id){
        return $this->find($id);
    }

    /**
     * Retrieve users for export (Excel), based on search filters or selected IDs.
     *
     * @param object $search
     * @param string $mode
     * @return \Illuminate\Support\Collection
     */
    public function getUsersExport($search, $mode = EXPORT_ALL){
        $query = $this->select('id', 'username', 'name', 'role_id', 'status', 'birthday', 'phone', 'email', 'address');
        if($mode == EXPORT_ALL){
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
            if (isset($search->sort_field)) {
                $sortType = (isset($search->sort_type) && strtolower($search->sort_type) === 'desc') ? 'desc' : 'asc';
                $query->orderBy($search->sort_field, $sortType);
            }
            else{
                $query->orderBy('id', 'desc');
            }
        }
        elseif($mode == EXPORT_BY_IDS){
            $ids = explode(',', $search->ids);
            $query->whereIn('id', explode(',', $search->ids))->orderByRaw('FIELD(id, ' . implode(',', $ids) . ')');;
        }
        return $query->get();
    }

    public function checkMailForgetPassword($email, $role_ids = []){
        $query = $this->where('email', $email)->where('status', USER_STATUS_ACTIVE);
        if(!empty($role_ids)){
            $query->whereIn('role_id', $role_ids);
        }
        return $query->first();
    }
}