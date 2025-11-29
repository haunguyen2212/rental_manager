<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

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
