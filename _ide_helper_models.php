<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Participant
 *
 * @package App\Models
 * @version February 6, 2022, 2:50 am UTC
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
 * @property int $id
 * @property string|null $furigana
 * @property string|null $is_proxy
 * @property int $wheel_chair
 * @property string|null $with_helper
 * @property string|null $go_with_leader
 * @property string|null $go_with_scouts
 * @property string|null $self_absent
 * @property string|null $checkedin_at
 * @property string|null $reception_checkedin_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ParticipantFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Query\Builder|Participant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCheckedinAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereDan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereFeeCheckedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereFurigana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereGoWithLeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereGoWithScouts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereIsProxy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant wherePref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereReceptionCheckedinAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereReceptionSeatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereSeatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereSelfAbsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereWheelChair($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereWithHelper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Participant withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Participant withoutTrashed()
 */
	class Participant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Staffinfo
 *
 * @package App\Models
 * @version October 7, 2022, 10:00 pm JST
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
 * @property int $id
 * @property int|null $user_id
 * @property string|null $birth_day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\StaffinfoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo newQuery()
 * @method static \Illuminate\Database\Query\Builder|Staffinfo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereBirthDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereBsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereCellPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereDan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereFurigana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo wherePrefecture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staffinfo whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Staffinfo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Staffinfo withoutTrashed()
 */
	class Staffinfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $is_admin
 * @property int $is_staff
 * @property string|null $is_pref
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Staffinfo|null $staffinfo
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsPref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsStaff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

