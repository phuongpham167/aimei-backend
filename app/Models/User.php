<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * @method static Builder|User byEmail($email)
 * @property string password
 * @property string name
 * @property string email
 * @property string api_token
 * @see User::scopeByEmail()
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable;
    use Authorizable;

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
