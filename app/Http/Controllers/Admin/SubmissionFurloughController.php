<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SubmissionFurloughExport;
use App\Http\Controllers\Controller;
use App\Models\SubmissionFurlough;
use App\Repositories\SubmissionFurloughRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SubmissionFurloughController extends Controller
{
    private $submissionFurloughRepository;

    public function __construct(SubmissionFurloughRepository $submissionFurloughRepository)
    {
        $this->submissionFurloughRepository = $submissionFurloughRepository;
    }

    public function index(Request $request)
    {
        $submissionFurloughs = $this->submissionFurloughRepository->get([
            'order' => 'DESC',
            'paginate' => 10
        ]);

        return view('pages.admin.submission-furloughs.index', [
            'submissionFurloughs' => $submissionFurloughs
        ]);
    }

    public function show(SubmissionFurlough $submissionFurlough)
    {
        return view('pages.admin.submission-furloughs.show', [
            'submissionFurlough' => $submissionFurlough
        ]);
    }

    public function approve(SubmissionFurlough $submissionFurlough)
    {
        try {
            DB::beginTransaction();

            $data = [
                'status' => SubmissionFurlough::STATUS_APPROVE,
                'approve_date' => Carbon::now()->format('Y-m-d')
            ];

            $this->submissionFurloughRepository->save($submissionFurlough->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.submission-furlough.show', $submissionFurlough)->with([
            'success' => 'Status submission furlough successfully updated.'
        ]);
    }

    public function export(Request $request)
    {
        if (empty($request->columns)) {
            return redirect()->back()->withErrors([
                'errors' => 'Please select column before export.'
            ]);
        }

        return (new SubmissionFurloughExport($request->columns))->download('submission-furlough.xlsx');
    }
}
