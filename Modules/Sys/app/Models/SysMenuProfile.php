<?php

namespace Modules\Sys\app\Models;

use Carbon\Carbon;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SysMenusProfile
 *
 * @property int $id
 * @property int $sys_menus_id
 * @property int $sys_profiles_id
 * @property string $shortcut
 * @property string $allow_create
 * @property string $allow_update
 * @property string $allow_delete
 * @property string $allow_read
 * @property string $allow_duplicate
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 *
 * @property SysMenu $sys_menu
 * @property SysProfile $sys_profile
 *
 * @package App\Models
 */
class SysMenuProfile extends ApiModel
{
	use SoftDeletes;
	protected $connection = 'db_controller';
	protected $table = 'sys_menus_profiles';

	protected $casts = [
		'sys_menus_id' => 'int',
		'sys_profiles_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'sys_menus_id',
		'sys_profiles_id',
		'shortcut',
		'allow_create',
		'allow_update',
		'allow_delete',
		'allow_read',
		'allow_duplicate',
		'status',
		'created_by',
		'updated_by',
		'deleted_by'
	];

	public function sys_menu()
	{
		return $this->belongsTo(SysMenu::class, 'sys_menus_id');
	}

	public function sys_profile()
	{
		return $this->belongsTo(SysProfile::class, 'sys_profiles_id');
	}
}
