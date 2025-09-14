<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Role";
    }

    /**
     * @param bool $topNull
     * @param string $nullLabel
     * 
     * @return array
     */
    public function getDropdown($topNull = true, $nullLabel = ''){
        $data = $this->pluck('name', 'id')->toArray();
        if ($topNull) {
            $data = ['' => $nullLabel] + $data;
        }
        return $data;
    }
}