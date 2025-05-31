<?php

namespace App\Http\Controllers\lectuer;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LectuerController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('dashboard.lectuers.index', compact('subjects', 'teachers'));
    }

    public function getdata(Request $request)
    {
        // $query = Lecture::with(['subject', 'user']);
        $query = Lecture::query();

        // فلترة البحث
        if ($request->filled('titel')) {
            $query->where('titel', 'like', '%' . $request->titel . '%');
        }

        if ($request->filled('subject')) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('titel', 'like', '%' . $request->subject . '%');
            });
        }

        if ($request->filled('teacher')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->teacher . '%');
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('subject', function ($qur) {
                return $qur->subject->titel;
                //     return $lecture->subject ? $lecture->subject->titel : '-';
            })
            ->addColumn('teacher', function ($qur) {
                return $qur->user ? $qur->user->name : '-';
            })
            ->addColumn('link', function ($qur) {
                return '<a class="btn btn-info btn-ms target="_blank" href="' . $qur->link . '">رابط المحاضرة</a>';
            })
            ->addColumn('action', function ($lecture) {
                $data_attr = '';
                $data_attr .= 'data-id="' . $lecture->id . '" ';
                $data_attr .= 'data-titel="' . e($lecture->titel) . '" ';
                $data_attr .= 'data-description="' . e($lecture->description) . '" ';
                $data_attr .= 'data-link="' . e($lecture->link) . '" ';
                $data_attr .= 'data-subject_id="' . e($lecture->subject_id) . '" ';
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

    public function add(Request $request)
    {

        $request->validate([
            'titel' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'subject_id' => 'required|exists:subjects,id',
            // 'teacher_id' => 'required|exists:users,id',
        ]);

        Lecture::create([
            'titel' => $request->titel,
            'description' => $request->description,
            'link' => $request->link,
            'subject_id' => $request->subject_id,
            // 'teacher_id' => $request->teacher_id,
        ]);

        return response()->json(['success' => 'تم إضافة المحاضرة بنجاح']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:lectures,id',
            'titel' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'subject_id' => 'required|exists:subjects,id',
            // 'teacher_id' => 'required|exists:users,id',
        ]);

        $lecture = Lecture::findOrFail($request->id);
        $lecture->update([
            'titel' => $request->titel,
            'description' => $request->description,
            'link' => $request->link,
            'subject_id' => $request->subject_id,
            // 'teacher_id' => $request->teacher_id,
        ]);

        return response()->json(['success' => 'تم تحديث المحاضرة بنجاح']);
    }

    public function delete($id)
    {
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();
        return response()->json(['success' => 'تم حذف المحاضرة بنجاح']);
    }
}
