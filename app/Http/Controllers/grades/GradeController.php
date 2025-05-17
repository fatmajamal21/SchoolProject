<?php

namespace App\Http\Controllers\grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\GradeSection;
use App\Models\Section;
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
            ->addColumn('action', function ($qur) {
                if ($qur->status == 'active') {
                    return '<div data-grade-id="' . $qur->id . '"  data-grade=" ' . $qur->tag . ' " data-bs-toggle="modal" data-bs-target="#sectionModal" class="d-flex align-items-center gap-3 fs-6 btn-add-section">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="fadeIn animated bx bx-message-square-add"></i></a>
                              </div>';
                }
                return '-';
            })
            ->addColumn('stage', function ($qur) {
                return $qur->stage->name;
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return ' مفعل ';
                }
                return 'غير مفعل ';
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
            'stage' => 'required',
            'status' => 'required',
            'tag' => 'required',
        ], [
            'name.required' => 'يرجى إدخال حقل الاسم',
            'stage.required' => 'يرجى إدخال حقل المرحلة',
            'status.required' => 'يرجى إدخال حقل المرحلة',
            'tag.required' => 'يرجى إدخال حقل المرحلة',
        ]);
        $stage_id = Stage::getIdByTag($request->stage);
        $status = Grade::getStatusByCode($request->status);
        $grade = Grade::query()->where('tag', $request->tag)->first();

        $grade->update([
            'name' => $request->name,
            'tag' => $request->tag,
            'stage_id' => $stage_id,
            'status' => $status,
        ]);
        return response()->json([
            'success' => 'تمت العملية'
        ]);
    }
    function getactive()
    {
        $actives = Grade::query()->where('status', 'active')->pluck('tag');
        // dd($actives);
        return response()->json([
            'tags' => $actives
        ]);
    }

    ///////////////////////////////////


    function getactivestage()
    {
        $actives = Stage::query()->where('status', 'active')->pluck('tag');
        // dd($actives);
        return response()->json([
            'tags' => $actives
        ]);
    }


    function addsection(Request $request)
    {
        // dd($request->all());
        $section = Section::query()->where('name', $request->section)->first();
        $grade = Grade::query()->where('tag', $request->gradetag)->first();

        if ($request->status == '1') {
            $status = 'active';
        } else {
            $status = 'inactive';
        }

        //لو ما كانوا مع بعض في نفس الرو يعمل update
        //ولو ما كانوا موجودين يعمل create
        //section_id= 1
        //grade_id=2 
        //هذول ممنوع يلتقوا في صف =>عشان تصير عملية انشاء create
        //لكن اذا التقوا بنفس الصف بنعمل اله تعديل update
        GradeSection::query()->updateOrCreate([
            'grade_id' => $grade->id,
            'section_id' => $section->id,
        ], [
            'status' => $status,
        ]);
        return response()->json([
            'success' => 'تمت العملية'
        ]);
    }


    function getactivesection(Request $request)
    {
        dd($request->all());
        $actives = GradeSection::query()->where('status', 'active')->where('gradeid', $request->gradeId)->get()->pluck('section.name');
        //مخزن عندي الاسم رقم في الانبت  "name" 
        // dd($actives);
        return response()->json([
            'names' => $actives
        ]);
    }

    function changemaster(Request $request)
    {
        $stage = Stage::query()->where('tag', $request->tag)->first();
        $gradesActive = Grade::query()->where('status', 'active')->where('stage_id', $stage->id)->get();
        // dd($gradesActive);


        if ($request->status == 1) {
            $stage->update([
                'status' => 'active',
            ]);
        } else {
            $stage->update([
                'status' => 'inactive',
            ]);
            foreach ($gradesActive as $g) {
                $g->update([
                    'status' => 'inactive',
                ]);
            }
        }
        return response()->json([
            'success' => 'تمت التعديل بنجاح',
        ]);

        // dd($gradesActive);
    }
}
