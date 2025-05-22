<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class teacherController extends Controller
{
    function index()
    {
        // ربط بين المتغير و الي بعده "بنفس الاسم    "
        // $text = 'fatma';
        // $text .= 'jamal';
        // return $text;

        return view('dashboard.teacher.index');
    }



    function getdata(Request $request)
    {
        $sections = Teacher::query();
        return DataTables::of($sections)->addIndexColumn()

            ->addColumn('email', function ($qur) {
                return $qur->user->email;
            })->addColumn('password', function ($qur) {
                return $qur->user->password;  // فقط لو كانت نص عادي (لا تفعل هذا في مشروع حقيقي)
            })
            ->addColumn('gender', function ($qur) {
                if ($qur->gender == 'male') {
                    return 'ذكر';
                }
                return ' أنثى';
            })
            ->addColumn('academic_qualification', function ($qur) {
                return $qur->get_academic_qualification_code($qur->academic_qualification);
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return ' مفعل ';
                }
                return 'غير مفعل ';
            })
            ->addColumn('action', function ($qur) {
                $data_attr = '';
                $data_attr .= 'data-id ="' . $qur->id . '" ';
                $data_attr .= 'data-name ="' . $qur->name . '" ';
                $data_attr .= 'data-phone ="' . $qur->phone . '" ';
                $data_attr .= 'data-email ="' . $qur->user->email . '" ';
                $data_attr .= 'data-date_of_birth ="' . $qur->date_of_birth . '" ';
                $data_attr .= 'data-university_major ="' . $qur->university_major . '" ';
                $data_attr .= 'data-academic_qualification ="' . $qur->academic_qualification . '" ';
                $data_attr .= 'data-gender ="' . $qur->gender . '" ';
                $data_attr .= 'data-date_of_appointment ="' . $qur->date_of_appointment . '" ';
                $data_attr .= 'data-status ="' . $qur->status . '"';

                $action = '<div class="d-flex align-items-center gap-3 fs-6">'
                    . '<a ' . $data_attr . ' href="javascript:;" class="update_btn text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit info" aria-label="Edit">'
                    . '<i class="bi bi-pencil-fill"></i></a>'
                    . '<a href="javascript:;" class="delete_btn text-danger" data-id="' . $qur->id . '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" aria-label="Delete">'
                    . '<i class="bi bi-trash-fill"></i></a>'
                    . '</div>';

                return $action;
            })

            ->make(true);
    }
    // داخل دالة add
    function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^[0-9]{8,15}$/'], // رقم هاتف مكون من 8 إلى 15 رقم فقط
            'date_of_birth' => ['required', 'date', 'before:today', 'after:' . now()->subYears(80)->format('Y-m-d')],
            // تاريخ الميلاد لازم قبل اليوم و مش أكبر من 80 سنة (تعديل حسب الحاجة)
            'university_major' => ['required', 'string', 'max:255'],
            'academic_qualification' => ['required', Rule::in(['diploma', 'bachelors', 'master', 'phD'])],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'date_of_appointment' => ['required', 'date', 'after_or_equal:date_of_birth', 'before_or_equal:today'],
            // تاريخ التعيين لازم يكون بعد أو يساوي تاريخ الميلاد وقبل اليوم
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            // كلمة السر لازم تكون 8 أحرف على الأقل، تحتوي على حرف كبير وصغير ورقم
        ], [
            'phone.regex' => 'رقم الهاتف يجب أن يحتوي على أرقام فقط ويتراوح بين 8 إلى 15 رقم.',
            'date_of_birth.before' => 'تاريخ الميلاد يجب أن يكون قبل اليوم.',
            'date_of_birth.after' => 'يجب ألا يتجاوز عمر المعلم 80 سنة.',
            'date_of_appointment.after_or_equal' => 'تاريخ التعيين يجب أن يكون بعد أو في نفس تاريخ الميلاد.',
            'date_of_appointment.before_or_equal' => 'تاريخ التعيين يجب أن لا يكون في المستقبل.',
            'academic_qualification.in' => 'المؤهل العلمي غير صالح.',
            'gender.in' => 'الجنس غير صالح.',
            'password.confirmed' => 'تأكيد كلمة السر غير متطابق.',
            'password.regex' => 'كلمة السر يجب أن تحتوي على حرف كبير، حرف صغير، ورقم.',
        ]);

        // إنشاء مستخدم جديد مع كلمة السر المشفرة
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // إنشاء معلم مرتبط بالمستخدم
        Teacher::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'university_major' => $request->university_major,
            'academic_qualification' => $request->academic_qualification,
            'gender' => $request->gender,
            'date_of_appointment' => $request->date_of_appointment,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => 'تمت الإضافة بنجاح',
        ]);
    }

    // داخل دالة update
    function update(Request $request)
    {
        $teacher = Teacher::findOrFail($request->id);
        $user = User::findOrFail($teacher->user_id);

        $request->validate([
            'id' => ['required', 'exists:teachers,id'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^[0-9]{8,15}$/'],
            'date_of_birth' => ['required', 'date', 'before:today', 'after:' . now()->subYears(80)->format('Y-m-d')],
            'university_major' => ['required', 'string', 'max:255'],
            'academic_qualification' => ['required', Rule::in(['diploma', 'bachelors', 'master', 'phD'])],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'date_of_appointment' => ['required', 'date', 'after_or_equal:date_of_birth', 'before_or_equal:today'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ], [
            'phone.regex' => 'رقم الهاتف يجب أن يحتوي على أرقام فقط ويتراوح بين 8 إلى 15 رقم.',
            'date_of_birth.before' => 'تاريخ الميلاد يجب أن يكون قبل اليوم.',
            'date_of_birth.after' => 'يجب ألا يتجاوز عمر المعلم 80 سنة.',
            'date_of_appointment.after_or_equal' => 'تاريخ التعيين يجب أن يكون بعد أو في نفس تاريخ الميلاد.',
            'date_of_appointment.before_or_equal' => 'تاريخ التعيين يجب أن لا يكون في المستقبل.',
            'academic_qualification.in' => 'المؤهل العلمي غير صالح.',
            'gender.in' => 'الجنس غير صالح.',
            'password.confirmed' => 'تأكيد كلمة السر غير متطابق.',
            'password.regex' => 'كلمة السر يجب أن تحتوي على حرف كبير، حرف صغير، ورقم.',
            'status.in' => 'حالة المعلم يجب أن تكون مفعل أو غير مفعل.',
        ]);

        // تحديث بيانات المستخدم
        $userData = ['email' => $request->email];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $user->update($userData);

        // تحديث بيانات المعلم
        $teacher->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'university_major' => $request->university_major,
            'academic_qualification' => $request->academic_qualification,
            'gender' => $request->gender,
            'status' => $request->status,
            'date_of_appointment' => $request->date_of_appointment,
        ]);

        return response()->json([
            'success' => 'تم التعديل بنجاح',
        ]);
    }

    // دالة delete تبقى كما هي، لا تحتاج تغيير خاص بالـ password


    function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:teachers,id',
        ]);

        $teacher = Teacher::findOrFail($request->id);
        $user = User::findOrFail($teacher->user_id);

        // حذف المعلم والمستخدم (يمكن إضافة معاملة قاعدة بيانات Transaction)
        $teacher->delete();
        $user->delete();

        return response()->json([
            'success' => 'تم الحذف بنجاح',
        ]);
    }
}




    // function add(Request $request)
    // {
    //     // dd($request);
    //     $request->validate(
    //         [
    //             //tabel teacher
    //             'name' => 'required',
    //             'phone' => 'required',
    //             'date_of_birth' => 'required',
    //             'university_major' => 'required',
    //             'academic_qualification' => 'required',
    //             'gender' => 'required',
    //             'date_of_appointment' => 'required',
    //             //tabel user
    //             'email' => 'required',
    //             'password' => 'required',
    //         ],
    //         [
    //             //tabel teacher
    //             'name.required' => 'يرجى إدخال حقل الاسم',
    //             'phone.required' => 'يرجى إدخال رقم الهاتف',
    //             'date_of_birth.required' => 'يرجى إدخال تاريخ الميلاد ',
    //             'university_major.required' => 'يرجى إدخال حقل التخصص الجامعي',
    //             'academic_qualification.required' => 'يرجى اختيار حقل المؤهل العلمي ',
    //             'gender.required' => 'يرجى إدخال حقل الجنس',
    //             'date_of_appointment.required' => 'يرجى إدخال حقل تاريخ التعيين',
    //             //tabel user
    //             'email.required' => 'يرجى إدخال حقل الايميل',
    //             'password.required' => 'يرجى إدخال حقل كلمة السر',
    //         ]
    //     );

    //     //tabel user create new teacher "User"
    //     $user =  User::create([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->phone),
    //     ]);
    //     //tabel teacher create teacher
    //     Teacher::create([
    //         'name' => $request->name,
    //         'phone' => $request->phone,
    //         'date_of_birth' => $request->date_of_birth,
    //         'university_major' => $request->university_major,
    //         'academic_qualification' => $request->academic_qualification,
    //         'gender' => $request->gender,
    //         'date_of_appointment' => $request->date_of_appointment,
    //         //tabel user_id  من البيانات الي انشءناهم في المستخد جيب الid بتاعه وخزنه في المعلم 
    //         'user_id' => $user->id,

    //     ]);

    //     return response()->json([
    //         'success' => 'تمت التعديل بنجاح',
    //     ]);
    // }
