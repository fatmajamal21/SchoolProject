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
                }
                return '-';
            })
            ->addColumn('action', function ($qur) {
                $lastSection =  Section::query()->where('status', 'active')->orderBy('id', 'desc')->first();
                $sectionondisble = Section::query()->where('status', 'inactive')->first();


                if ($lastSection->id == $qur->id) {
                    return '<div data-status ="inactive" data-id="' . $qur->id . '" class=" active-section-switch form-check form-switch">
                             <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" checked>
                     
                   </div>';
                }
                //@ : اقبل ال unll عادي بدون اخطاء
                if (@$sectionondisble->id == $qur->id) {
                    return '<div data-status ="active" data-id="' . $qur->id . '" class=" active-section-switch form-check form-switch">
                           <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked">
                           </div>';
                }
            })
            ->addColumn('action2', function ($qur) {
                if ($qur->status == 'active') {

                    return '<div>
                         <button class="btn btn-success" disabled title="مفعل">
                        <i class="lni lni-checkmark"></i>
                         </button>
                        <button class=" active-section-input btn btn-outline-danger toggle-status-btn" data-id="' . $qur->id . '" 
                        data-status="inactive" title="تعطيل">
                          <i class="lni lni-close"></i>
                          </button>
                        </div> ';
                } else {

                    return ' <div>
                                    <button class=" active-section-input btn btn-outline-success toggle-status-btn" data-id="' . $qur->id . '" 
                                    data-status="active" title="تفعيل">
                               <i class="lni lni-checkmark"></i>
                                    </button>
                                <button class="btn btn-danger" disabled title="غير مفعل">
                                  <i class="lni lni-close"></i>
                          </button>
                                   </div>';
                }
            })

            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return ' مفعل ';
                }
                return 'غير مفعل ';
            })->rawColumns(['action', 'action2'])
            ->make(true);
    }


    public function add(Request $request)
    {
        // dd($request->all());
        $newCount = $request->count_section;
        $currentCount = Section::count();
        // dd($currentCount);
        if ($newCount  >    $currentCount) {

            // لتشغيل الشعب الغير مفعلة
            $sectionInActive = Section::query()->where('status', 'inactive')->get();
            foreach ($sectionInActive as $aa) {
                $aa->update([
                    "status" => 'active',
                ]);
            }



            //لانشاء شعب جديدة بالرقم المدخل المطلوب ومفعلات
            for ($i = $currentCount + 1; $i <= $newCount; $i++) {
                Section::create([
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


    function changestatus(Request $request)
    {
        $section = Section::query()->findOrFail($request->id);
        if ($request->status == 'active') {
            $section->update([
                "status" => 'active',
            ]);
        } else {
            $section->update([
                "status" => 'inactive',
            ]);
        }

        return response()->json([
            'success' => 'تمت التعديل بنجاح',
        ]);
    }




    function changestatus2(Request $request)
    {
        $section = Section::findOrFail($request->id);

        $newStatus = $request->status;

        if (!in_array($newStatus, ['active', 'inactive'])) {
            return response()->json([
                'error' => 'حالة غير صحيحة',
            ], 422);
        }

        $section->status = $newStatus;
        $section->save();

        return response()->json([
            'success' => 'تم تحديث حالة الشعبة بنجاح',
            'new_status' => $section->status,
        ]);
    }
}
// function changestatus2(Request $request)
// {
//     $section = Section::query()->findOrFail($request->id);
//     if ($request->status == 'active') {
//         $section->update([
//             "status" => 'inactive',
//         ]);
//     } else {
//         $section->update([
//             "status" => 'active',
//         ]);
//     }

//     return response()->json([
//         'success' => 'تمت التعديل بنجاح',
//     ]);
// }
