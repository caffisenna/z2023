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
 * @property string $email
 * @property string $name
 * @property string $furigana
 * @property string $phone
 * @property string $ceremony
 * @property string $ceremony_with
 * @property string $member
 * @property string $pref
 * @property string $dan
 * @property string $role_dan
 * @property string $role_district
 * @property string $role_council
 * @property string $role_saj
 * @property string $reception
 * @property string $congress
 * @property string $organization
 * @property string $living_area
 * @property string $reason
 * @property string $theme_division
 * @property string $memo
 * @property string $uuid
 */
class Participant extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'participants';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'email',
        'name',
        'furigana',
        'phone',
        'ceremony',
        'ceremony_with',
        'member',
        'pref',
        'dan',
        'role_dan',
        'role_district',
        'role_council',
        'role_saj',
        'reception',
        'congress',
        'organization',
        'living_area',
        'reason',
        'theme_division',
        'memo',
        'staff_memo',
        'absent_ceremny',
        'absent_reception',
        'uuid',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'name' => 'string',
        'furigana' => 'string',
        'phone' => 'string',
        'ceremony' => 'string',
        'ceremony_with' => 'string',
        'member' => 'string',
        'pref' => 'string',
        'dan' => 'string',
        'role_dan' => 'string',
        'role_district' => 'string',
        'role_council' => 'string',
        'role_saj' => 'string',
        'reception' => 'string',
        'congress' => 'string',
        'organization' => 'string',
        'living_area' => 'string',
        'reason' => 'string',
        'theme_division' => 'string',
        'memo' => 'string',
        'uuid' => 'string',
        'staff_memo' => 'string',
        'absent_ceremny' => 'boolean',
        'absent_reception' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'furigana' => 'required',
        'member' => 'required',
    ];

    public static $messages = [
        'name.required' => '氏名を入力して下さい',
        'furigana.required' => 'ふりがなを入力して下さい',
        'member.required' => '加盟員/一般 を選択してください',
    ];
}
