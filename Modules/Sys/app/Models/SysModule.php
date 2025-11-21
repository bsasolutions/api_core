<?php

namespace Modules\Sys\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SysModule
 *
 * @property int $id
 * @property string $description
 * @property string|null $icon
 * @property int $order
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 *
 * @property Collection|SysMenu[] $sys_menus
 *
 * @package App\Models
 */
class SysModule extends ApiModel
{
	use SoftDeletes;
	protected $connection = 'db_controller';
	protected $table = 'sys_modules';

	protected $casts = [
		'order' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'description',
		'icon',
		'order',
		'status',
		'created_by',
		'updated_by',
		'deleted_by'
	];

	public function sys_menus()
	{
		return $this->hasMany(SysMenu::class, 'sys_modules_id');
	}
}
