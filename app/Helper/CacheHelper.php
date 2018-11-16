<?php

namespace App\Helper;

use Cache;

class CacheHelper
{
    public static function find($key, $refresh = false, $ttl = 60)
    {
        if ($refresh) {
            $cache = self::$key();
            Cache::put($key, $cache, $ttl);
        } else {
            $cache = Cache::remember($key, $ttl, function() use($key) {
               $cache = self::$key();
               return $cache;
            });
        }
        return $cache;
    }

    public static function findOne($key, $target) {
        $caches = self::find($key);
        $result = false;
        if (is_array($target)) {
            $result = [];
            foreach ($caches as $id => $cache) {
                if (in_array($id, $target)) {
                    $result[$id] = $cache;
                }
            }
        } elseif (is_numeric($target) || is_string($target)) {
            $result = !empty($caches[$target]) ? $caches[$target] : [];
        } elseif ($target == 'all') {
            $result = !empty($caches) ? $caches : [];
        }
        return $result;
    }

    public static function flush()
    {
        $keys = func_get_args();
        foreach ($keys as $key) {
            self::find($key, true);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if (!class_exists('\App\\Model\\'.studly_case($name))) {
            return [];
        }
        $model = 'App\\Models\\'.studly_case($name);
        $model = new $model();
        if (isset($model->cacheOptions)) {
            if (isset($model->cacheOptions['order'])) {
                $model = $model->orderBy($model->cacheOptions['order'], $model->cacheOptions['sort'] ?? 'ASC');
            }
            if (isset($model->cacheOptions['limit'])) {
                $model = $model->take($model->cacheOptions['limit']);
            }
            if (!empty($model->cacheOptions['conditions'])) {
                foreach ($model->cacheOptions['conditions'] as $condition) {
                    if (count($condition) == 3) {
                        $model = $model->where($condition[0], $condition[1], $condition[2]);
                    } elseif (count($condition) == 2) {
                        $model = $model->where($condition[0], $condition[1]);
                    }
                }
            }
        }
        return $model->get()->keyBy($model->cacheOptions['key'] ?? 'id')->toArray();
    }

    public static function category()
    {
        return \App\Models\Category::orderBy('id', 'ASC')->get()->keyBy('id')->toArray();
    }
}