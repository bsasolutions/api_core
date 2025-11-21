<?php

namespace Modules\Sys\app\Models;

//use App\Http\Middleware\Authenticate;
use Carbon\Carbon;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Sys\app\Models\SysGroup;
use Modules\Sys\app\Models\SysMessage;
use Modules\Sys\app\Models\SysPackage;
use Modules\Sys\app\Models\SysProfile;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Contracts\Auth\Authenticatable;
//use Tymo\JWTAuth\Contracts\JWTSubject;

/**
 * Class SysUser
 *
 * @property int $id
 * @property int $sys_groups_id
 * @property int $sys_packages_id
 * @property int $sys_profiles_id
 * @property int $sys_messages_id
 * @property string $description
 * @property string $short_name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $remember_token
 * @property string $password
 * @property string $status
 * @property string $phone
 * @property string $phone2
 * @property string $job_title
 * @property string $image
 * @property Carbon|null $last_acess
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 *
 * @property SysGroup $sys_group
 * @property SysMessage $sys_message
 * @property SysPackage $sys_package
 * @property SysProfile $sys_profile
 * @property SysServer $sys_server
 *
 * @package App\Models
 */
class SysUser extends ApiModel
//class SysUser extends Authenticatable implements JWTSubject //login foi movido para model app/User
{
    use  SoftDeletes;
    protected $connection = 'db_controller';
    protected $table = 'sys_users';

    protected $casts = [
        'sys_groups_id' => 'int',
        'sys_packages_id' => 'int',
        'sys_profiles_id' => 'int',
        'sys_messages_id' => 'int',
        'email_verified_at' => 'datetime',
        'last_acess' => 'datetime',
        'created_by' => 'int',
        'updated_by' => 'int',
        'deleted_by' => 'int'
    ];

    protected $hidden = [
        'remember_token',
        'password'
    ];

    protected $fillable = [
        'sys_groups_id',
        'sys_packages_id',
        'sys_profiles_id',
        'sys_messages_id',
        'description',
        'short_name',
        'email',
        'email_verified_at',
        'remember_token',
        'password',
        'status',
        'phone',
        'phone2',
        'job_title',
        'image',
        'last_acess',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function sys_group()
    {
        return $this->belongsTo(SysGroup::class, 'sys_groups_id');
    }

    public function sys_message()
    {
        return $this->belongsTo(SysMessage::class, 'sys_messages_id');
    }

    public function sys_package()
    {
        return $this->belongsTo(SysPackage::class, 'sys_packages_id');
    }

    public function sys_profile()
    {
        return $this->belongsTo(SysProfile::class, 'sys_profiles_id');
    }
}
