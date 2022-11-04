<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OccupationStoreRequest;
use App\Http\Requests\OccupationUpdateRequest;
use App\Models\Occupation;
use App\Repositories\OccupationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OccupationController extends Controller
{
    private $occupationRepository;

    public function __construct(OccupationRepository $occupationRepository)
    {
        $this->occupationRepository = $occupationRepository;
    }

    public function index(Request $request)
    {
        $occupations = $this->occupationRepository->get([
            'search' => [
                'name' => $request->name,
            ],
            'order' => 'DESC',
            'paginate' => 10
        ]);

        return view('pages.admin.occupation.index', [
            'occupations' => $occupations
        ]);
    }

    public function create()
    {
        $occupation = new Occupation();

        return view('pages.admin.occupation.create', [
            'occupation' => $occupation
        ]);
    }

    public function store(OccupationStoreRequest $request)
    {
        $data = $request->only(['name']);

        try {
            DB::beginTransaction();

            $occupation = new Occupation();
            $this->occupationRepository->save($occupation->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.occupation.index')->with([
            'success' => 'Occupation successfully created.'
        ]);
    }

    public function edit(Occupation $occupation)
    {
        return view('pages.admin.occupation.edit', [
            'occupation' => $occupation
        ]);
    }

    public function update(OccupationUpdateRequest $request, Occupation $occupation)
    {
        $data = $request->only(['name']);

        try {
            DB::beginTransaction();

            $this->occupationRepository->save($occupation->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.occupation.index')->with([
            'success' => 'Occupation successfully updated.'
        ]);
    }

    public function destroy(Occupation $occupation)
    {
        try {
            DB::beginTransaction();

            if ($occupation->profiles()->exists()) {
                return redirect()->back()->withErrors([
                    'errors' => 'Used occupation cannot be deleted'
                ]);
            } else {
                $occupation->delete();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.occupation.index')->with([
            'success' => 'Occupation successfully deleted.'
        ]);
    }
}
