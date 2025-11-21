<?php

namespace Modules\Sys\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SysMenu
 *
 * @property int $id
 * @property int $sys_modules_id
 * @property string $description
 * @property string $type_menu
 * @property string|null $icon
 * @property int $order1
 * @property int $order2
 * @property int $order3
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 *
 * @property SysModule $sys_module
 * @property Collection|SysMenusPackage[] $sys_menus_packages
 * @property Collection|SysMenusProfile[] $sys_menus_profiles
 *
 * @package App\Models
 */
class SysMenu extends ApiModel
{
	use SoftDeletes;
	protected $connection = 'db_controller';
	protected $table = 'sys_menus';

	protected $casts = [
		'sys_modules_id' => 'int',
		'order1' => 'int',
		'order2' => 'int',
		'order3' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'sys_modules_id',
		'description',
		'type_menu',
		'icon',
		'order1',
		'order2',
		'order3',
		'status',
		'created_by',
		'updated_by',
		'deleted_by'
	];

	public function sys_module()
	{
		return $this->belongsTo(SysModule::class, 'sys_modules_id');
	}

	public function sys_menus_packages()
	{
		return $this->hasMany(SysMenuPackage::class, 'sys_menus_id');
	}

	public function sys_menus_profiles()
	{
		return $this->hasMany(SysMenuProfile::class, 'sys_menus_id');
	}
}
