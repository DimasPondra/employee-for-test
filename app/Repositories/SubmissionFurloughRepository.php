<?php

namespace App\Repositories;

use App\Models\SubmissionFurlough;

class SubmissionFurloughRepository
{
    private $model;

    public function __construct(SubmissionFurlough $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $submissionFurloughs = $this->model
            ->when(!empty($params['search']['name']), function ($query) use ($params) {
                return $query->where('name', 'LIKE', '%' . $params['search']['name'] . '%');
            })
            ->when(!empty($params['search']['user_id']), function ($query) use ($params) {
                return $query->where('user_id', $params['search']['user_id']);
            })
            ->when(!empty($params['furlough_type']), function ($query) use ($params) {
                return $query->where('furlough_type', $params['furlough_type']);
            })
            ->when(!empty($params['name']), function ($query) use ($params) {
                return $query->whereHas('user', function ($query) use ($params) {
                    return $query->where('name', 'LIKE', '%' . $params['name'] . '%');
                });
            })
            ->when(!empty($params['month']), function ($query) use ($params) {
                return $query->whereMonth('start_date', $params['month']);
            })
            ->when(!empty($params['year']), function ($query) use ($params) {
                return $query->whereYear('start_date', $params['year']);
            })
            ->when(!empty($params['order']), function ($query) use ($params) {
                return $query->orderBy('updated_at', $params['order']);
            });

        if (!empty($params['count']) && $params['count'] == true) {
            return count($submissionFurloughs->get());
        }

        if (!empty($params['paginate'])) {
            return $submissionFurloughs->paginate($params['paginate']);
        }

        return $submissionFurloughs->get();
    }

    public function getForBarChart($params = [])
    {
        $jan = $this->get([
            'month' => 1,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $feb = $this->get([
            'month' => 2,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $mar = $this->get([
            'month' => 3,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $apr = $this->get([
            'month' => 4,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $may = $this->get([
            'month' => 5,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $jun = $this->get([
            'month' => 6,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $jul = $this->get([
            'month' => 7,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $aug = $this->get([
            'month' => 8,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $sep = $this->get([
            'month' => 9,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $oct = $this->get([
            'month' => 10,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $nov = $this->get([
            'month' => 11,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);
        $dec = $this->get([
            'month' => 12,
            'count' => true,
            'year' => $params['search']['year'],
            'name' => $params['search']['name'],
            'furlough_type' => $params['search']['furlough_type']
        ]);

        $barData = [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];

        return $barData;
    }

    public function save(SubmissionFurlough $submissionFurlough)
    {
        $submissionFurlough->save();

        return $submissionFurlough;
    }
}
