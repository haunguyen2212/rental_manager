<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    protected $table = 'mail_logs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'from_email',
        'from_name',
        'to_email',
        'to_name',
        'subject',
        'body',
        'status',
        'error_message',
        'template',
        'created_by',
        'updated_by',
    ];
}
