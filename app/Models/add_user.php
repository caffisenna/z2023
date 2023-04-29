<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class add_user
 * @package App\Models
 * @version April 28, 2023, 10:24 pm JST
 *
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string $password
 */
class add_user extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'add_users';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'role',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'role' => 'string',
        'password' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'role' => 'required',
        'password' => 'required'
    ];

    
}
