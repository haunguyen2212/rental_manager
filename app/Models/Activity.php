<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'user_name',
        'action',
        'action_text',
        'description',
        'ip_address',
    ];
}
