<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function (Model $model) {
            if (!Auth::guard('admin')->check()) {
                return;
            }

            ActivityLog::record(
                'created',
                class_basename($model) . ' #' . $model->getKey() . ' dibuat',
                $model,
                ['attributes' => self::safeAttributes($model)]
            );
        });

        static::updated(function (Model $model) {
            if (!Auth::guard('admin')->check()) {
                return;
            }

            $changes = $model->getChanges();
            unset($changes['updated_at'], $changes['remember_token'], $changes['password']);

            if (empty($changes)) {
                return;
            }

            ActivityLog::record(
                'updated',
                class_basename($model) . ' #' . $model->getKey() . ' diubah',
                $model,
                [
                    'old' => array_intersect_key($model->getOriginal(), $changes),
                    'new' => $changes,
                ]
            );
        });

        static::deleted(function (Model $model) {
            if (!Auth::guard('admin')->check()) {
                return;
            }

            ActivityLog::record(
                'deleted',
                class_basename($model) . ' #' . $model->getKey() . ' dihapus',
                $model,
                ['attributes' => self::safeAttributes($model)]
            );
        });
    }

    protected static function safeAttributes(Model $model): array
    {
        $attrs = $model->getAttributes();
        unset($attrs['password'], $attrs['remember_token']);

        return $attrs;
    }
}
