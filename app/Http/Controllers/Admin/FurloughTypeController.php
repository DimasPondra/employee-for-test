<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FurloughTypeStoreRequest;
use App\Http\Requests\FurloughTypeUpdateRequest;
use App\Models\FurloughType;
use App\Repositories\FurloughTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FurloughTypeController extends Controller
{
    private $furloughTypeRepository;

    public function __construct(FurloughTypeRepository $furloughTypeRepository)
    {
        $this->furloughTypeRepository = $furloughTypeRepository;
    }

    public function index(Request $request)
    {
        $furloughTypes = $this->furloughTypeRepository->get([
            'search' => [
                'name' => $request->name,
            ],
            'order' => 'DESC',
            'paginate' => 10
        ]);

        return view('pages.admin.furlough-types.index', [
            'furloughTypes' => $furloughTypes
        ]);
    }

    public function create()
    {
        $furloughType = new FurloughType();

        return view('pages.admin.furlough-types.create', [
            'furloughType' => $furloughType
        ]);
    }

    public function store(FurloughTypeStoreRequest $request)
    {
        $data = $request->only(['name']);

        try {
            DB::beginTransaction();

            $furloughType = new FurloughType();
            $this->furloughTypeRepository->save($furloughType->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.furlough-types.index')->with([
            'success' => 'Furlough type successfully created.'
        ]);
    }

    public function edit(FurloughType $furloughType)
    {
        return view('pages.admin.furlough-types.edit', [
            'furloughType' => $furloughType
        ]);
    }

    public function update(FurloughTypeUpdateRequest $request, FurloughType $furloughType)
    {
        $data = $request->only(['name']);

        try {
            DB::beginTransaction();

            $this->furloughTypeRepository->save($furloughType->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.furlough-types.index')->with([
            'success' => 'Furlough type successfully updated.'
        ]);
    }

    public function destroy(FurloughType $furloughType)
    {
        try {
            DB::beginTransaction();

            $furloughType->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.furlough-types.index')->with([
            'success' => 'Furlough type successfully deleted.'
        ]);
    }
}
