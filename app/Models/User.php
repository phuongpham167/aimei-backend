<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder|User byEmail($email)
 * @property string password
 * @property string name
 * @property string email
 * @property string api_token
 * @see User::scopeByEmail()
 */
class User extends Model
{
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function scopeByEmail(Builder $builder, $email)
    {
        $builder->where('email', $email);
    }

    public static function findByEmail($email)
    {
        return static::byEmail($email)->first();
    }
}
