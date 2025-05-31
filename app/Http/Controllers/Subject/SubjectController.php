<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('dashboard.subject.index', compact('grades', 'teachers'));
    }

    public function getData(Request $request)
    {
        $query = Subject::with(['grade', 'teacher'])
            ->select(
                'subjects.id',
                'subjects.titel', // استخدام الاسم الصحيح مع alias
                'subjects.book',
                'subjects.teacher_id',
                'subjects.grade_id',
                'subjects.created_at',
                'subjects.updated_at'
            );

        if ($request->filled('titel')) {
            $query->where('subjects.titel', 'like', '%' . $request->titel . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('lectures', function ($query) {
                return '<a href="' . route('dash.subject.lectuers', $query->id) . '" class="btn btn-warning btn-sm">جميع المحاضرات</a>';
            })

            //   كتاب"' . $query->titel . '" ' . $query->grade->name . '
            ->addColumn('action', function ($subject) {
                $editBtn = '<button class="btn btn-warning btn-sm btn-action update_btn" 
                data-id="' . $subject->id . '" 
                data-titel="' . e($subject->titel) . '" 
                data-grade_id="' . $subject->grade_id . '" 
                data-teacher_id="' . $subject->teacher_id . '" 
                data-book="' . e($subject->book) . '">
                <i class="bi bi-pencil"></i></button>';
                $deleteBtn = '<button class="btn btn-danger btn-sm btn-action delete_btn" data-id="' . $subject->id . '">
                <i class="bi bi-trash"></i></button>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action', 'book', 'lectures'])
            ->make(true);
    }
    public function add(Request $request)
    {
        $request->validate([
            'titel' => 'required|string:subjects,titel',
            'grade_id' => 'required|exists:grades,id',
            'teacher_id' => 'required|exists:teachers,id',
            'book' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'titel.required' => 'اسم المادة مطلوب',
            'titel.unique' => 'اسم المادة مستخدم مسبقاً',
            'grade_id.required' => 'اختر المرحلة الدراسية',
            'teacher_id.required' => 'اختر معلم المادة',
            'book.mimes' => 'يجب أن يكون الملف من نوع PDF أو Word',
            'book.max' => 'يجب ألا يتجاوز حجم الملف 2MB',
        ]);

        $data = [
            'titel' => $request->titel,
            'grade_id' => $request->grade_id,
            'teacher_id' => $request->teacher_id,
        ];

        if ($request->hasFile('book')) {
            $file = $request->file('book');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/book'), $filename);
            $data['book'] = $filename;
        }


        Subject::create($data);

        return response()->json(['success' => 'تمت إضافة المادة بنجاح']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:subjects,id',
            'titel' => 'required|string:subjects,titel,' . $request->id,
            'grade_id' => 'required|exists:grades,id',
            'teacher_id' => 'required|exists:teachers,id',
            'book' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'titel.required' => 'اسم المادة مطلوب',
            'titel.unique' => 'اسم المادة مستخدم مسبقاً',
            'grade_id.required' => 'اختر المرحلة الدراسية',
            'teacher_id.required' => 'اختر معلم المادة',
            'book.mimes' => 'يجب أن يكون الملف من نوع PDF أو Word',
            'book.max' => 'يجب ألا يتجاوز حجم الملف 2MB',
        ]);

        $subject = Subject::findOrFail($request->id);
        $data = [
            'titel' => $request->titel,
            'grade_id' => $request->grade_id,
            'teacher_id' => $request->teacher_id,
        ];

        if ($request->hasFile('book')) {
            // حذف الملف القديم إذا كان موجودًا
            if ($subject->book && file_exists(public_path('uploads/book/' . $subject->book))) {
                unlink(public_path('uploads/book/' . $subject->book));
            }

            $file = $request->file('book');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/book'), $filename);
            $data['book'] = $filename;
        }

        $subject->update($data);

        return response()->json(['success' => 'تم تحديث المادة بنجاح']);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:subjects,id',
        ]);

        $subject = Subject::findOrFail($request->id);

        // حذف الملف المرفق إذا كان موجودًا
        if ($subject->book && file_exists(public_path('uploads/book/' . $subject->book))) {
            unlink(public_path('uploads/book/' . $subject->book));
        }

        $subject->delete();

        return response()->json(['success' => 'تم حذف المادة بنجاح']);
    }

    public function download($filename)
    {
        $path = public_path('uploads/book/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'الملف غير موجود');
        }

        return response()->download($path);
    }
    public function lectuers($id)
    {
        $subject = Subject::findOrFail($id);
        return view('dashboard.subject.lectuers', compact('subject'));
    }

    public function getDataLectuers(Request $request)
    {
        // dd($request->id);
        $query = Lecture::query()->where('subject_id', $request->id);
        // فلترة البحث
        if ($request->filled('titel')) {
            $query->where('titel', 'like', '%' . $request->titel . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('subject', function ($qur) {
                return $qur->subject->titel;
            })
            ->addColumn('teacher', function ($qur) {
                return $qur->user ? $qur->user->name : '-';
            })
            ->addColumn('link', function ($qur) {
                return '<a class="btn btn-info btn-ms target="_blank" href="' . $qur->link . '">رابط المحاضرة</a>';
            })
            ->addColumn('action', function ($lecture) {
                $data_attr = '';
                // $data_attr .= 'data-id="' . $lecture->id . '" ';
                // $data_attr .= 'data-titel="' . e($lecture->titel) . '" ';
                // $data_attr .= 'data-description="' . e($lecture->description) . '" ';
                // $data_attr .= 'data-link="' . e($lecture->link) . '" ';
                // $data_attr .= 'data-subject_id="' . e($lecture->subject_id) . '" ';
                // $data_attr .= 'data-teacher_id="' . e($lecture->teacher_id) . '" ';

                $action = '<div class="d-flex align-items-center gap-3 fs-6">';
                $action .= '<a href="javascript:;" class="update_btn text-warning" ' . $data_attr . ' title="تعديل"><i class="bi bi-pencil-fill"></i></a>';
                $action .= '<a href="javascript:;" class="delete_btn text-danger" data-id="' . $lecture->id . '" title="حذف"><i class="bi bi-trash-fill"></i></a>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['action', 'teacher', 'subject', 'link'])
            ->make(true);
    }
    // public function getDataLectuers(Request $request)
    // {
    //     $subject_id = $request->id;

    //     $query = Lecture::where('subject_id', $subject_id)->select('id', 'titel', 'description', 'link', 'subject_id');

    //     return DataTables::of($query)
    //         ->addIndexColumn()

    //         ->addColumn('action', function ($lecture) {
    //             return '<button class="btn btn-warning btn-sm update_btn" data-id="' . $lecture->id . '" ...>تعديل</button> 
    //                 <button class="btn btn-danger btn-sm delete_btn" data-id="' . $lecture->id . '">حذف</button>';
    //         })

    //         ->make(true);
    // }
}
