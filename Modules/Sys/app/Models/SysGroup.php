<?php

namespace Modules\Sys\app\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ApiModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Sys\app\Models\SysUser;
use App\Models\TenantInfo;
use Modules\Adm\app\Models\AdmCompanyGroup;

/**
 * Class SysGroup
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
 * @property Collection|AdmCompaniesGroup[] $adm_companies_groups
 * @property Collection|SysUser[] $sys_users
 *
 * @package App\Models
 */
class SysGroup extends ApiModel
{
    use SoftDeletes;
    protected $connection = 'db_controller';
    protected $table = 'sys_groups';

    protected $casts = [
        //'sys_tenants_id' => 'int',
        'created_by' => 'int',
        'updated_by' => 'int',
        'deleted_by' => 'int'
    ];

    protected $fillable = [
        'sys_tenants_id',
        'description',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    public function sys_tenant()
    {
        //return $this->belongsTo(TenantInfo::class, 'sys_tenants_id');
        return $this->belongsTo(TenantInfo::class, 'sys_tenants_id', 'id');
    }

    public function adm_companies_groups()
    {
        return $this->hasMany(AdmCompanyGroup::class, 'sys_groups_id');
    }

    public function sys_users()
    {
        return $this->hasMany(SysUser::class, 'sys_groups_id');
    }
}
