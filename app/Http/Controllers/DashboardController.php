<?php

namespace App\Http\Controllers;

use App\Repositories\SubmissionFurloughRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $submissionFurloughRepository;

    public function __construct(SubmissionFurloughRepository $submissionFurloughRepository)
    {
        $this->submissionFurloughRepository = $submissionFurloughRepository;
    }

    public function index(Request $request)
    {
        $submissionFurloughs = $this->submissionFurloughRepository->get([
            'search' => [
                'user_id' => auth()->user()->id
            ]
        ]);

        return view('pages.employee.dashboard', [
            'submissionFurloughs' => count($submissionFurloughs)
        ]);
    }
}
