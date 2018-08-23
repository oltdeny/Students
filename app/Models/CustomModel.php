<?php

namespace App\Models;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class CustomModel extends Model
{
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);
        $perPage = $perPage ?: $this->model->getPerPage();
        $total = $this->query->toBase()->getCountForPagination($columns);
        if ($total) {
            if ($this->query instanceof Builder) {
                $distinct = $this->query->getQuery()->distinct;
            }
            if ($this->query instanceof Relation) {
                $distinct = $this->query->getBaseQuery()->distinct;
            }
            if ($distinct) {
                $this->query->groupBy($columns);
            }
            $results = $this->query->forPage($page, $perPage)->get($columns);
        } else {
            $results = $this->model->newCollection();
        }
//        $results = ($total = $this->toBase()->getCountForPagination())
//            ? $this->forPage($page, $perPage)->get($columns)
//            : $this->model->newCollection();
        return $this->paginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);
    }
}
