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
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property string|null $staff_memo
 * @property int|null $absent_ceremony
 * @property bool|null $absent_reception
 * @property string|null $reception_table
 * @property string|null $checkin_type_ceremony
 * @property string|null $checkin_type_reception
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $checkedin_at
 * @property string|null $reception_checkedin_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ParticipantFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereAbsentCeremony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereAbsentReception($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCeremony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCeremonyWith($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCheckedinAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCheckinTypeCeremony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCheckinTypeReception($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCongress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereDan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereFurigana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereLivingArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereMember($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant wherePref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereReception($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereReceptionCheckedinAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereReceptionTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereRoleCouncil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereRoleDan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereRoleDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereRoleSaj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereStaffMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereThemeDivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participant withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant withoutTrashed()
 */
	class Participant extends \Eloquent {}
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
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
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
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsStaff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * Class add_user
 *
 * @package App\Models
 * @version April 28, 2023, 10:24 pm JST
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string $password
 * @method static \Database\Factories\add_userFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|add_user newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|add_user newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|add_user onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|add_user query()
 * @method static \Illuminate\Database\Eloquent\Builder|add_user withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|add_user withoutTrashed()
 */
	class add_user extends \Eloquent {}
}

