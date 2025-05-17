<?php

namespace App\Http\Controllers\section;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\GradeSection;
use App\Models\Section;
use App\Models\Stage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{


    function index()
    {
        return view('dashboard.section.index');
    }

    // DT_RowIndex
    function getdata(Request $request)
    {
        $sections = Section::query();
        return DataTables::of($sections)->addIndexColumn()
            ->addColumn('name', function ($qur) {
                if ($qur->status == 'active') {
                    return ' الشعبة ' . ' ' . "'$qur->name'";
                    // return ' الشعبة ' . ' ' . $qur->name;
                }
                return '-';
            })
            ->addColumn('action', function ($qur) {
                if ($qur->status == 'active') {
                    return '';
                }
                return '-';
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return ' مفعل ';
                }
                return 'غير مفعل ';
            })
            ->make(true);
    }
    // // public function store(Request $request)
    // // {
    // //     $request->validate([
    // //         'name' => 'required|unique:sections,name',
    // //         'status' => 'required|in:active,inactive',
    // //     ]);

    // //     Section::create([
    // //         'name' => $request->name,
    // //         'status' => $request->status,
    // //     ]);

    // //     return response()->json(['success' => 'تم إضافة القسم بنجاح']);
    // // }

    public function add(Request $request)
    {
        // dd($request->all());
        $newCount = $request->count_section;
        $currentCount = Section::count();
        // dd($currentCount);
        if ($newCount  >    $currentCount) {

            // لتشغيل الشعب الغير مفعلة
            $sectuinInActive = Section::query()->where('status', 'inactive')->get();
            foreach ($sectuinInActive as $aa) {
                $aa->update([
                    "status" => 'active',
                ]);
            }

            //لانشاء شعب جديدة بالرقم المدخل المطلوب ومفعلات
            for ($i = $currentCount + 1; $i <= $newCount; $i++) {
                Section::create([
                    // "name" => 'الشعبة ' . $i,
                    "name" => $i,
                    "status" => 'active',
                ]);
            }
        } elseif ($newCount  <    $currentCount) {
            $limit = $currentCount - $newCount;
            // الحد الي اخر بدك ياه  بدك  - لو 3 بتجيب اخر 3 وهكذاlimit($الحد) 
            // لو بدنا نعدل اي شعبة يدويا من خلال whrer
            $lasrSection = Section::query()->orderBy('id', 'desc')->limit($limit)->get();
            // dd($lasrSection);
            foreach ($lasrSection as $ls) {
                $ls->update([
                    // 'name' => $ls->name,
                    "status" => 'inactive',
                ]);
            }
        } else {
            $sectuinInActive = Section::query()->where('status', 'inactive')->get();
            foreach ($sectuinInActive as $aa) {
                $aa->update([
                    "status" => 'active',
                ]);
            }
        }
        return response()->json([
            'success' => 'تمت التعديل بنجاح',
        ]);
    }
}



























    //     $sections = Section::query();

    //     return DataTables::of($sections)
    //         ->addIndexColumn()
    //         ->addColumn('action', function ($section) {
    //             return '
    //                 <button class="btn btn-primary btn-sm edit-btn" data-id="' . $section->id . '">تعديل</button>
    //                 <button class="btn btn-danger btn-sm delete-btn" data-id="' . $section->id . '">حذف</button>
    //             ';
    //         })
    //         ->addColumn('status', function ($section) {
    //             return $section->status == 'active' ? 1 : 0;
    //         })
    //         ->rawColumns(['action', 'status'])
    //         ->make(true);
    // }

    // // public function store(Request $request)
    // // {
    // //     $request->validate([
    // //         'name' => 'required|unique:sections,name',
    // //         'status' => 'required|in:active,inactive',
    // //     ]);

    // //     Section::create([
    // //         'name' => $request->name,
    // //         'status' => $request->status,
    // //     ]);

    // //     return response()->json(['success' => 'تم إضافة القسم بنجاح']);
    // // }


    // // public function update(Request $request, $id)
    // // {
    // //     $request->validate([
    // //         'name' => 'required|unique:sections,name,' . $id,
    // //         'status' => 'required|in:active,inactive',
    // //     ]);

    // //     $section = Section::findOrFail($id);
    // //     $section->update([
    // //         'name' => $request->name,
    // //         'status' => $request->status,
    // //     ]);

    // //     return response()->json(['success' => 'تم تحديث القسم بنجاح']);
    // // }




    // // DT_RowIndex
    // function getdata(Request $request)
    // {
    //     $grades = Grade::query();
    //     return DataTables::of($grades)->addIndexColumn()
    //         ->addColumn('section', function ($qur) {
    //             return response()->json(['data' => Section::all()]);
    //         })
    //         ->addColumn('stage', function ($qur) {
    //             return $qur->stage->name;
    //         })
    //         ->addColumn('status', function ($qur) {
    //             if ($qur->status == 'active') {
    //                 return ' مفعل ';
    //             }
    //             return 'غير مفعل ';
    //         })
    //         ->make(true);
    // }


    // function create()
    // {
    //     $stages = Stage::all();
    //     return view('dashboard.grades.create', compact('stages'));
    // }
    // public function add(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'name' => 'required',
    //         'stage' => 'required',
    //         'status' => 'required',
    //         'tag' => 'required',
    //     ], [
    //         'name.required' => 'يرجى إدخال حقل الاسم',
    //         'stage.required' => 'يرجى إدخال حقل المرحلة',
    //         'status.required' => 'يرجى إدخال حقل المرحلة',
    //         'tag.required' => 'يرجى إدخال حقل المرحلة',
    //     ]);
    //     $stage_id = Stage::getIdByTag($request->stage);
    //     $status = Grade::getStatusByCode($request->status);
    //     $grade = Grade::query()->where('tag', $request->tag)->first();

    //     $grade->update([
    //         'name' => $request->name,
    //         'tag' => $request->tag,
    //         'stage_id' => $stage_id,
    //         'status' => $status,
    //     ]);
    //     return response()->json([
    //         'success' => 'تمت العملية'
    //     ]);
    // }
    // function getactive()
    // {
    //     $actives = Grade::query()->where('status', 'active')->pluck('tag');
    //     // dd($actives);
    //     return response()->json([
    //         'tags' => $actives
    //     ]);
    // }

    // ///////////////////////////////////


    // function getactivestage()
    // {
    //     $actives = Stage::query()->where('status', 'active')->pluck('tag');
    //     // dd($actives);
    //     return response()->json([
    //         'tags' => $actives
    //     ]);
    // }


    // function addsection(Request $request)
    // {
    //     // dd($request->all());
    //     $section = Section::query()->where('name', $request->section)->first();
    //     $grade = Grade::query()->where('tag', $request->gradetag)->first();

    //     if ($request->status == '1') {
    //         $status = 'active';
    //     } else {
    //         $status = 'inactive';
    //     }

    //     //لو ما كانوا مع بعض في نفس الرو يعمل update
    //     //ولو ما كانوا موجودين يعمل create
    //     //section_id= 1
    //     //grade_id=2 
    //     //هذول ممنوع يلتقوا في صف =>عشان تصير عملية انشاء create
    //     //لكن اذا التقوا بنفس الصف بنعمل اله تعديل update
    //     GradeSection::query()->updateOrCreate([
    //         'grade_id' => $grade->id,
    //         'section_id' => $section->id,
    //     ], [
    //         'status' => $status,
    //     ]);
    //     return response()->json([
    //         'success' => 'تمت العملية'
    //     ]);
    // }


    // function getactivesection(Request $request)
    // {
    //     dd($request->all());
    //     $actives = GradeSection::query()->where('status', 'active')->where('gradeid', $request->gradeId)->get()->pluck('section.name');
    //     //مخزن عندي الاسم رقم في الانبت  "name" 
    //     // dd($actives);
    //     return response()->json([
    //         'names' => $actives
    //     ]);
    // }

    // function changemaster(Request $request)
    // {
    //     $stage = Stage::query()->where('tag', $request->tag)->first();
    //     $gradesActive = Grade::query()->where('status', 'active')->where('stage_id', $stage->id)->get();
    //     // dd($gradesActive);


    //     if ($request->status == 1) {
    //         $stage->update([
    //             'status' => 'active',
    //         ]);
    //     } else {
    //         $stage->update([
    //             'status' => 'inactive',
    //         ]);
    //         foreach ($gradesActive as $g) {
    //             $g->update([
    //                 'status' => 'inactive',
    //             ]);
    //         }
    //     }
    //     return response()->json([
    //         'success' => 'تمت التعديل بنجاح',
    //     ]);

    //     // dd($gradesActive);
    // }
// }
