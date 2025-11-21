<?php

namespace Modules\Sys\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Sys\app\Models\SysUser;

/**
 * Class SysMessage
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property string|null $message
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 *
 * @property Collection|SysUser[] $sys_users
 *
 * @package App\Models
 */
class SysMessage extends ApiModel
{
    use SoftDeletes;
    protected $connection = 'db_controller';
    protected $table = 'sys_messages';

    protected $casts = [
        'created_by' => 'int',
        'updated_by' => 'int',
        'deleted_by' => 'int'
    ];

    protected $fillable = [
        'title',
        'subtitle',
        'message',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function sys_users()
    {
        return $this->hasMany(SysUser::class, 'sys_messages_id');
    }
}
