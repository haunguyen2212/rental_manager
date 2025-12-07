<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'email';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at',
        'expire_at',
    ];

    protected $dates = [
        'created_at',
        'expire_at',
    ];

    /**
     * Check if the token has expired
     */
    public function isExpired(): bool
    {
        return $this->expire_at && Carbon::now()->greaterThan($this->expire_at);
    }
}
