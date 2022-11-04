<?php

namespace App\Exports;

use App\Models\SubmissionFurlough;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubmissionFurloughExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function headings(): array
    {
        $heading = [];

        in_array('name', $this->columns) ? array_push($heading, 'Name') : null;
        in_array('start_date', $this->columns) ? array_push($heading, 'Start Date') : null;
        in_array('last_date', $this->columns) ? array_push($heading, 'Last Date') : null;
        in_array('furlough_type', $this->columns) ? array_push($heading, 'Furlough Type') : null;
        in_array('employee_occupation', $this->columns) ? array_push($heading, 'Occupation') : null;
        in_array('status', $this->columns) ? array_push($heading, 'Status') : null;

        return $heading;
    }

    public function map($submissionFurlough): array
    {
        $data = [];

        in_array('name', $this->columns) ? array_push($data, $submissionFurlough->user->name) : null;
        in_array('start_date', $this->columns) ? array_push($data, $submissionFurlough->start_date) : null;
        in_array('last_date', $this->columns) ? array_push($data, $submissionFurlough->last_date) : null;
        in_array('furlough_type', $this->columns) ? array_push($data, $submissionFurlough->furlough_type) : null;
        in_array('employee_occupation', $this->columns) ? array_push($data, $submissionFurlough->employee_occupation) : null;
        in_array('status', $this->columns) ? array_push($data, $submissionFurlough->status) : null;

        return $data;
    }

    public function query()
    {
        return SubmissionFurlough::query();
    }
}
