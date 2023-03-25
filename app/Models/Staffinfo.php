<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Staffinfo
 * @package App\Models
 * @version October 7, 2022, 10:00 pm JST
 *
 * @property string $furigana
 * @property string $gender
 * @property string $bs_id
 * @property string $prefecture
 * @property string $district
 * @property string $dan
 * @property string $role
 * @property string $cell_phone
 * @property string $zip
 * @property string $address
 * @property string $memo
 * @property string $team
 */
class Staffinfo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'staffinfos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'birth_day',
        'furigana',
        'gender',
        'bs_id',
        'prefecture',
        'district',
        'dan',
        'role',
        'cell_phone',
        'zip',
        'address',
        'memo',
        'team'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'birth_day' => 'string',
        'furigana' => 'string',
        'gender' => 'string',
        'bs_id' => 'string',
        'prefecture' => 'string',
        'district' => 'string',
        'dan' => 'string',
        'role' => 'string',
        'cell_phone' => 'string',
        'zip' => 'string',
        'address' => 'string',
        'memo' => 'string',
        'team' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'birth_day' => 'required|date_format:Y-m-d',
        'furigana' => 'required',
        'gender' => 'required',
        'bs_id' => 'required',
        'prefecture' => 'required',
        'district' => 'required',
        'dan' => 'required',
        'role' => 'required',
        'cell_phone' => 'required',
        'zip' => 'required',
        'address' => 'required',
    ];

    public static $messages= [
        'birth_day.required' => '生年月日を入力して下さい',
        'birth_day.date_format' => '生年月日をYYYY-mm-ddの形式で入力して下さい',
        'furigana.required' => 'ふりがなを入力してください',
        'gender.required' => '性別を入力してください',
        'bs_id.required' => '登録番号を入力して下さい',
        'prefecture.required' => '県連盟を入力して下さい',
        'district.required' => '地区を入力して下さい',
        'dan.required' => '団名を入力して下さい',
        'role.required' => '役務を入力して下さい',
        'cell_phone.required' => 'ケータイ番号を入力して下さい',
        'zip.required' => '郵便番号を入力して下さい',
        'address.required' => '住所を入力して下さい',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
