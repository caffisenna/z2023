<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Participant
 * @package App\Models
 * @version February 6, 2022, 2:50 am UTC
 *
 * @property string $name
 * @property string $uuid
 * @property string $pref
 * @property string $district
 * @property string $dan
 * @property string $role
 * @property string $category
 * @property string $email
 * @property string $phone
 * @property string $seat_number
 * @property string $reception_seat_number
 * @property string $zip
 * @property string $address
 * @property string $fee_checked_at
 */
class Participant extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'participants';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'furigana',
        'uuid',
        'pref',
        'district',
        'dan',
        'category',
        'role',
        'email',
        'phone',
        'seat_number',
        'reception_seat_number',
        'zip',
        'address',
        'fee_checked_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category' => 'string',
        'name' => 'string',
        'furigana' => 'string',
        'uuid' => 'string',
        'pref' => 'string',
        'district' => 'string',
        'dan' => 'string',
        'role' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'seat_number' => 'string',
        'reception_seat_number' => 'string',
        'zip' => 'string',
        'address' => 'string',
        'fee_checked_at' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'furigana' => 'required',
        'pref' => 'required',
        'email' => 'nullable | required_unless:category,県連代表(5),県連代表(6)', // nullを許容してVS,BS以外は必須に
    ];

    public static $messages = [
        'name.required' => '氏名を入力して下さい',
        'furigana.required' => 'ふりがなを入力して下さい',
        'pref.required' => '県連盟を入力して下さい',
        'email.required_unless' => 'emailを入力して下さい',
    ];
}
