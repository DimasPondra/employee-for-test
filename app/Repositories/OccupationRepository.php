<?php

namespace App\Repositories;

use App\Models\Occupation;

class OccupationRepository
{
    private $model;

    public function __construct(Occupation $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $occupations = $this->model
            ->when(!empty($params['search']['name']), function ($query) use ($params) {
                return $query->where('name', 'LIKE', '%' . $params['search']['name'] . '%');
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderBy('updated_at', $params['order']);
            });

        if (!empty($params['paginate'])) {
            return $occupations->paginate($params['paginate']);
        }

        return $occupations->get();
    }

    public function save(Occupation $occupation)
    {
        $occupation->save();

        return $occupation;
    }
}
