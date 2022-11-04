<?php

namespace App\Repositories;

use App\Models\FurloughType;

class FurloughTypeRepository
{
    private $model;

    public function __construct(FurloughType $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $furloughTypes = $this->model
            ->when(!empty($params['search']['name']), function ($query) use ($params) {
                return $query->where('name', 'LIKE', '%' . $params['search']['name'] . '%');
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderBy('updated_at', $params['order']);
            });

        if (!empty($params['paginate'])) {
            return $furloughTypes->paginate($params['paginate']);
        }

        return $furloughTypes->get();
    }

    public function save(FurloughType $furloughType)
    {
        $furloughType->save();

        return $furloughType;
    }
}
