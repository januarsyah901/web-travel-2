<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = [
        'admin_id',
        'admin_email',
        'admin_name',
        'action',
        'model_type',
        'model_id',
        'description',
        'properties',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'properties' => 'array',
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public static function record(
        string $action,
        string $description,
        ?Model $model = null,
        ?array $properties = null
    ): self {
        $admin = Auth::guard('admin')->user();

        return self::create([
            'admin_id' => $admin?->id,
            'admin_email' => $admin?->email,
            'admin_name' => $admin?->name,
            'action' => $action,
            'model_type' => $model ? $model::class : null,
            'model_id' => $model?->getKey(),
            'description' => $description,
            'properties' => $properties,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
