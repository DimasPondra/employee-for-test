<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\FurloughTypeRepository;
use App\Repositories\SubmissionFurloughRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $submissionFurloughRepository, $furloughTypeRepository;

    public function __construct(
        SubmissionFurloughRepository $submissionFurloughRepository,
        FurloughTypeRepository $furloughTypeRepository
    ) {
        $this->submissionFurloughRepository = $submissionFurloughRepository;
        $this->furloughTypeRepository = $furloughTypeRepository;
    }

    public function index(Request $request)
    {
        $submissionFurloughs = $this->submissionFurloughRepository->get();
        $furloughTypes = $this->furloughTypeRepository->get();

        $dataBarChart = $this->submissionFurloughRepository->getForBarChart([
            'search' => [
                'year' => $request->year,
                'name' => $request->name,
                'furlough_type' => $request->furlough_type
            ]
        ]);

        return view('pages.admin.dashboard', [
            'submissionFurloughs' => count($submissionFurloughs),
            'furloughTypes' => $furloughTypes,
            'dataBarChart' => $dataBarChart
        ]);
    }
}
