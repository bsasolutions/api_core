<?php

namespace Modules\Sys\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Sys\app\Models\SysUser;

/**
 * Class SysProfile
 *
 * @property int $id
 * @property string $description
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 *
 * @property Collection|SysUser[] $sys_users
 * @property Collection|SysMenusProfile[] $sys_menus_profiles
 *
 * @package App\Models
 */
class SysProfile extends ApiModel
{
    use SoftDeletes;
    protected $connection = 'db_controller';
    protected $table = 'sys_profiles';

    protected $casts = [
        'created_by' => 'int',
        'updated_by' => 'int',
        'deleted_by' => 'int'
    ];

    protected $fillable = [
        'description',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function sys_users()
    {
        return $this->hasMany(SysUser::class, 'sys_profiles_id');
    }

    public function sys_menus_profiles()
    {
        return $this->hasMany(SysMenuProfile::class, 'sys_profiles_id');
    }
}
