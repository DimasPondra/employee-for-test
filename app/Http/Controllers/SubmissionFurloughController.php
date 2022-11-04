<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionFurloughStoreRequest;
use App\Models\SubmissionFurlough;
use App\Repositories\FurloughTypeRepository;
use App\Repositories\SubmissionFurloughRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionFurloughController extends Controller
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
        $submissionFurloughs = $this->submissionFurloughRepository->get([
            'search' => [
                'name' => $request->name,
                'user_id' => auth()->user()->id
            ],
            'order' => 'DESC',
            'paginate' => 10
        ]);

        return view('pages.employee.submission-furloughs.index', [
            'submissionFurloughs' => $submissionFurloughs
        ]);
    }

    public function create()
    {
        $submissionFurlough = new SubmissionFurlough();
        $furloughTypes = $this->furloughTypeRepository->get();

        return view('pages.employee.submission-furloughs.create', [
            'submissionFurlough' => $submissionFurlough,
            'furloughTypes' => $furloughTypes
        ]);
    }

    public function store(SubmissionFurloughStoreRequest $request)
    {
        $request->merge([
            'submission_date' => Carbon::now()->format('Y-m-d'),
            'status' => SubmissionFurlough::STATUS_PENDING,
            'user_id' => auth()->user()->id,
            'employee_occupation' => auth()->user()->profile->occupation->name
        ]);

        $data = $request->only([
            'start_date', 'last_date', 'reason', 'submission_date',
            'status', 'user_id', 'employee_occupation', 'furlough_type'
        ]);

        try {
            DB::beginTransaction();

            $submissionFurlough = new SubmissionFurlough();
            $this->submissionFurloughRepository->save($submissionFurlough->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('employee.submission-furlough.index')->with([
            'success' => 'Submission furlough successfully created.'
        ]);
    }

    public function show(SubmissionFurlough $submissionFurlough)
    {
        if ($submissionFurlough->user_id != auth()->user()->id) {
            return redirect()->back()->withErrors([
                'errors' => 'You cannot access this data'
            ]);
        }

        return view('pages.employee.submission-furloughs.show', [
            'submissionFurlough' => $submissionFurlough
        ]);
    }
}
