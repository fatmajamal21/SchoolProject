<?php

namespace App\Http\Controllers\grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GradeController extends Controller
{
    function index()
    {
        return view('dashboard.grades.index');
    }
    // DT_RowIndex
    function getdata(Request $request)
    {
        $grades = Grade::query();
        return DataTables::of($grades)->addIndexColumn()
            ->addColumn('action', function () {
                return '<div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                              </div>';
            })
            ->addColumn('Stage', function ($grade) {
                return $grade->stage->name;
            })
            ->make(true);
    }
    function create()
    {
        $stages = Stage::all();
        return view('dashboard.grades.create', compact('stages'));
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'tag' => 'required',
            'stage' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'يرجى إدخال حقل الاسم',
            'status.required' => 'يرجى اختيار الحالة',
            'stage.required' => 'يرجى إدخال حقل المرحلة',
            'tag.required' => 'يرجى إدخال حقل المرحلة',
        ]);

        $stage_id = Stage::getIdByTag($request->tag);
        // $stage_id = Stage::getIdByTag('p');


        $status = Grade::getStatusByCode($request->status);

        $grade = Grade::query()->where('tag', $request->tag)->first();


        if ($grade) {
            $grade->update([
                'name' => $request->name,
                'tag' => $request->tag,
                'stage_id' => $stage_id,
                'status' => $request->status,
            ]);
            return response()->json(['message' => 'Grade updated successfully']);
        } else {
            return response()->json(['error' => 'Grade not found'], 404);
        }
        // return 'تم الإضافة بنجاح!';
    }
}
