<?php

namespace Modules\Sys\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Sys\app\Models\SysUser;

/**
 * Class SysPackage
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
 * @property Collection|SysMenusPackage[] $sys_menus_packages
 *
 * @package App\Models
 */
class SysPackage extends ApiModel
{
    use SoftDeletes;
    protected $connection = 'db_controller';
    protected $table = 'sys_packages';

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
        return $this->hasMany(SysUser::class, 'sys_packages_id');
    }

    public function sys_menus_packages()
    {
        return $this->hasMany(SysMenuPackage::class, 'sys_packages_id');
    }
}
