<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

class Helper
{
    public static function paginate($builder)
    {
        $pag = $builder->paginate(request()->perPage ?? 25);

        if ($builder instanceof Builder) {
            return $pag;
        }

        if (isset($builder->from)) {
            $model = self::getModelByTable($builder->from);
            $model = (new $model())->hydrate($pag->items());
        }

        $paginated = new LengthAwarePaginator($model ?? $builder, $pag->total(), $pag->perPage(), $pag->currentPage());
        // $paginated->setPageName('page'.ucfirst(isset($model) ? $model->first()->getTable() : $pag->first()->getTable()));
        $paginated->withPath(request()->url());
        return $paginated;
    }

    public static function getModelByTable($tb)
    {
        return 'App\\Models\\' . Str::studly(Str::singular(strtok($tb, ' ')));
    }

    public static function setUrlParam($param, $value)
    {
        parse_str(Request::getQueryString(), $params);
        $params[$param] = $value;
        return Request::getSchemeAndHttpHost() . '/' . Request::path() . '?' . http_build_query($params);
    }
}
