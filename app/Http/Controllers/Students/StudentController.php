<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        $sections = Section::all();
        return view('dashboard.student.index', compact('grades', 'sections'));
    }

    public function getData(Request $request)
    {
        $query = Student::with(['grade', 'section', 'user'])->select('students.*');

        // مثال على فلتر للبحث
        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('grade_name', function ($student) {
                return $student->grade ? $student->grade->name : '-';
            })
            ->addColumn('section_name', function ($student) {
                return $student->section ? $student->section->name : '-';
            })
            ->addColumn('email', function ($student) {
                return $student->user ? $student->user->email : '-';
            })
            ->addColumn('gender', function ($student) {
                if ($student->gender == 'male') {
                    return '<span class="badge bg-info">ذكر</span>';
                } else {
                    return '<span class="badge" style="background-color: #c74375">انثى</span>';
                }
            })
            ->rawColumns(['gender'])
            ->make(true);
    }

    public function add(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'parent_name'  => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'gender'       => 'required|in:male,female',
            'grade_id'     => 'required|exists:grades,id',
            'section_id'   => 'required|exists:sections,id',
            'date_of_birth' => 'nullable|date',
        ], [
            'first_name.required'   => 'هذا الحقل مطلوب',
            'last_name.required'    => 'هذا الحقل مطلوب',
            'email.required'        => 'هذا الحقل مطلوب',
            'email.email'           => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique'          => 'هذا البريد الإلكتروني مستخدم من قبل',
            'parent_name.required'  => 'هذا الحقل مطلوب',
            'parent_phone.required' => 'هذا الحقل مطلوب',
            'gender.required'       => 'هذا الحقل مطلوب',
            'gender.in'             => 'القيمة غير صحيحة',
            'grade_id.required'     => 'هذا الحقل مطلوب',
            'grade_id.exists'       => 'القيمة غير صحيحة',
            'section_id.required'   => 'هذا الحقل مطلوب',
            'section_id.exists'     => 'القيمة غير صحيحة',
            'date_of_birth.date'    => 'تاريخ غير صالح',
        ]);

        // إنشاء مستخدم جديد
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make('123'), // يفضل تغير كلمة المرور لاحقًا
        ]);

        // إنشاء الطالب وربطه بالمستخدم والمرحلة والشعبة
        $student = Student::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'parent_name'  => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'gender'       => $request->gender,
            'grade_id'     => $request->grade_id,
            'section_id'   => $request->section_id,
            'user_id'      => $user->id,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return response()->json(['success' => 'تمت إضافة الطالب بنجاح']);
    }
}
