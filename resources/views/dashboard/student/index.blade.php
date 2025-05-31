
@extends('dashboard.master')
@section('title')
مدرسة خانيونس للبنين   | الصفحة الرئيسية للمعلميم  
@stop
@section('page-content')
<main class="page-content">
  <div class="container">
  <div class="row mb-4">
    {{-- المودل لاضافة طالب
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="sectionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionsModalLabel">إضافة  معلم</h5>
      </div>

      <div  class="modal-body" >
        <div class="container">
          <form action="{{ route('dash.student.add') }}" method="POST" id="add-form" class="add-form">
            @csrf 
        
    <div class="md-4">
          <label for="count_section" style="font-size: 16px"> اسم الطالب/ة الاول</label>
      <input type="text" class="form-control mt-2 search-input" name="first_name" id="search-name " placeholder=" اسم الطالب/ة الاول">
      <div class="invalid-feedback" id="error-name"></div>
    </div>
    
    <!-- Email Field -->
    <div class="md-4 mt-4">
         <label for="count_section" style="font-size: 16px"> اسم الطالب/ة الاخير</label>
      <input type="text" class="form-control mt-2 search-input" name="last_name" id="search-email" placeholder=" اسم الطالب/ة الاخير">
      <div class="invalid-feedback" id="error-email"></div>
    </div>

        <div class="md-4 mt-4">
              <label for="count_section" style="font-size: 16px">البريد الإلكتروني </label>
              <input type="email" class="form-control mt-2" id="email" name="email"  placeholder="البريد الإلكتروني">
                <div class="invalid-feedback" id="error-name"></div>
           </div>
    
        <div class="md-4 mt-4">
       <label for="count_section" style="font-size: 16px"> اسم ولي الامر </label>
      <input type="email" class="form-control mt-2 search-input" name="parent_name" id="search-email" placeholder="اسم ولي الامر ">
      <div class="invalid-feedback" id="error-email"></div>
    </div>
    
    <!-- Phone Field -->
    <div class="md-4 mt-4">
                    <label for="count_section" style="font-size: 16px">رقم جوال ولي الامر </label>
      <input class="form-control mt-2 search-input" name="parent_phone" id="search-phone" placeholder="رقم جوال ولي الامر ">
      <div class="invalid-feedback" id="error-phone"></div>
    </div>
      
                 <div class="mb-4 mt-4">
              <label for="count_section" style="font-size: 16px"> الجنس</label>
               <select class="form-control mt-2" id="gender"  name="gender"  >
                <option selected disabled value=""> اختر الجنس </option>
                <option  value="male">  ذكر </option>
                <option  value="female"> انثى  </option>
               </select>
                 <div class="invalid-feedback" id="error-name"></div>
        </div>
            <div class="mb-4">
                <label for="update-grade_id" style="font-size: 16px">اسم المرحلة الدراسية </label>
                <select class="form-select mt-2" id="update-grade_id" name="grade_name">   
                       <option selected disabled value="">اسم المرحلة الدراسية </option>
                       @foreach($grades as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback" id="error-update-grade_id"></div>
              </div>
                <div class="mb-4">
                <label for="update-section_id" style="font-size: 16px">اسم الشعبة الدراسية</label>
                <select class="form-select mt-2" id="update-section_id" name="section_name">   
                       <option selected disabled value=""> اسم الشعبة الدراسية</option>
                       @foreach($sections as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback" id="error-update-section_id"></div>
              </div>
                <div class="mb-4 mt-4">
              <label for="count_section" style="font-size: 16px"> تاريخ الميلاد</label>
              <input type="date" class="form-control mt-2" id="date_of_birth" name="date_of_birth"  placeholder="تاريخ الميلاد">
                <div class="invalid-feedback" id="error-name"></div>
           </div>

       </div>
       </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-primary col-12"> إضافة طالب جديد</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
        </form>
    </div>
  </div>
</div> --}}
{{-- المودل لاضافة طالب --}}
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="sectionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionsModalLabel">إضافة طالب جديد</h5> <!-- تم التصحيح هنا -->
      </div>

      <div class="modal-body">
        <div class="container">
          <form action="{{ route('dash.student.add') }}" method="POST" id="add-form" class="add-form">
            @csrf 
        
            <div class="md-4">
              <label for="first_name" style="font-size: 16px">اسم الطالب/ة الأول</label>
              <input type="text" class="form-control mt-2" name="first_name" id="first_name" placeholder="اسم الطالب/ة الأول">
              <div class="invalid-feedback" id="error-first_name"></div>
            </div>
            
            <div class="md-4 mt-4">
              <label for="last_name" style="font-size: 16px">اسم الطالب/ة الأخير</label>
              <input type="text" class="form-control mt-2" name="last_name" id="last_name" placeholder="اسم الطالب/ة الأخير">
              <div class="invalid-feedback" id="error-last_name"></div>
            </div>

            <div class="md-4 mt-4">
              <label for="email" style="font-size: 16px">البريد الإلكتروني</label>
              <input type="email" class="form-control mt-2" id="email" name="email" placeholder="البريد الإلكتروني">
              <div class="invalid-feedback" id="error-email"></div>
            </div>
    
            <div class="md-4 mt-4">
              <label for="parent_name" style="font-size: 16px">اسم ولي الأمر</label>
              <input type="text" class="form-control mt-2" name="parent_name" id="parent_name" placeholder="اسم ولي الأمر">
              <div class="invalid-feedback" id="error-parent_name"></div>
            </div>
    
            <div class="md-4 mt-4">
              <label for="parent_phone" style="font-size: 16px">رقم جوال ولي الأمر</label>
              <input type="text" class="form-control mt-2" name="parent_phone" id="parent_phone" placeholder="رقم جوال ولي الأمر">
              <div class="invalid-feedback" id="error-parent_phone"></div>
            </div>
      
            <div class="mb-4 mt-4">
              <label for="gender" style="font-size: 16px">الجنس</label>
              <select class="form-control mt-2" id="gender" name="gender">
                <option selected disabled value="">اختر الجنس</option>
                <option value="male">ذكر</option>
                <option value="female">انثى</option>
              </select>
              <div class="invalid-feedback" id="error-gender"></div>
            </div>
            
            <div class="mb-4">
              <label for="grade_id" style="font-size: 16px">اسم المرحلة الدراسية</label>
              <select class="form-select mt-2" id="grade_id" name="grade_id">   
                <option selected disabled value="">اسم المرحلة الدراسية</option>
                @foreach($grades as $g)
                <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback" id="error-grade_id"></div>
            </div>
            
            <div class="mb-4">
              <label for="section_id" style="font-size: 16px">اسم الشعبة الدراسية</label>
              <select class="form-select mt-2" id="section_id" name="section_id">   
                <option selected disabled value="">اسم الشعبة الدراسية</option>
                @foreach($sections as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback" id="error-section_id"></div>
            </div>
            
            <div class="mb-4 mt-4">
              <label for="date_of_birth" style="font-size: 16px">تاريخ الميلاد</label>
              <input type="date" class="form-control mt-2" id="date_of_birth" name="date_of_birth" placeholder="تاريخ الميلاد">
              <div class="invalid-feedback" id="error-date_of_birth"></div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary col-12">إضافة طالب جديد</button> <!-- تم التصحيح هنا -->
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- في قسم الأزرار -->
<div class="col-md-2 mb-2 d-flex align-items-end">
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal">
    <i class="bi bi-plus-circle"></i> إضافة طالب <!-- تم التصحيح هنا -->
  </button>
</div>


  
  </div>
</div>



{{-- المودل لتعديل الصفوف --}}
{{-- <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="sectionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionsModalLabel">تعديل  معلم</h5>
      </div>

      <div  class="modal-body">
        <div class="container">
          <form action="{{ route('dash.teacher.update') }}" method="POST" id="update-form" class="update-form">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <input type="hidden" name="id" value="id">
            <div class="mb-4">
              <label for="count_section" style="font-size: 16px"> اسم المعلم/ة الكامل</label>
              <input type="text" class="form-control mt-2" id="name" name="name"  placeholder="اسم المعلم/ة">
                <div class="invalid-feedback" id="error-name"></div>
            </div>
           <div class="mb-4">
              <label for="count_section" style="font-size: 16px">رقم الهاتف</label>
              <input class="form-control mt-2" id="phone" name="phone"  placeholder="رقم الهاتف">
                <div class="invalid-feedback" id="error-name"></div>
           </div>
           <div class="mb-4">
              <label for="count_section" style="font-size: 16px"> تاريخ الميلاد</label>
              <input type="date" class="form-control mt-2" id="date_of_birth" name="date_of_birth"  placeholder="تاريخ الميلاد">
                <div class="invalid-feedback" id="error-name"></div>
           </div>
           <div class="mb-4">
              <label for="count_section" style="font-size: 16px">البريد الإلكتروني </label>
              <input type="email" class="form-control mt-2" id="email" name="email"  placeholder="البريد الإلكتروني">
                <div class="invalid-feedback" id="error-name"></div>
           </div>
   <div class="mb-4">
    <label for="password_update" style="font-size: 16px">تغيير كلمة السر (اختياري)</label>
    <input type="password" class="form-control mt-2" id="password_update" name="password" placeholder="تغيير كلمة السر">
    <div class="invalid-feedback" id="error-password"></div>
  </div>
  <div class="mb-4">
    <label for="password_confirmation_update" style="font-size: 16px">تأكيد كلمة السر</label>
    <input type="password" class="form-control mt-2" id="password_confirmation_update" name="password_confirmation" placeholder="تأكيد كلمة السر">
    <div class="invalid-feedback" id="error-password_confirmation"></div>
  </div> 

          <div class="mb-4">
              <label for="count_section" style="font-size: 16px">التخصص الجامعي</label>
              <input type="text"  class="form-control mt-2"  id="university_major"  name="university_major"  placeholder="التخصص الجامعي">
                <div class="invalid-feedback" id="error-name"></div>
          </div>
         <div class="mb-4">
              <label for="count_section" style="font-size: 16px">المؤهل العلمي</label>
              <select class="form-control mt-2" id="academic_qualification"  name="academic_qualification"  >
                <option selected disabled value=""> اختر المؤهل العلمي</option>
                  <option  value="diploma">  دبلوم </option>
                   <option  value="bachelors"> بكالوريس  </option>
                    <option  value="master">   ماجستير</option>
                     <option  value="phD">  دكتوراة </option>
              </select>
                <div class="invalid-feedback" id="error-name"></div>
         </div>
        <div class="mb-4">
              <label for="count_section" style="font-size: 16px"> الجنس</label>
               <select class="form-control mt-2" id="gender"  name="gender"  >
                <option selected disabled value=""> اختر الجنس </option>
                <option  value="male">  ذكر </option>
                <option  value="female"> انثى  </option>
               </select>
                 <div class="invalid-feedback" id="error-name"></div>
        </div>
              <div class="mb-4">
              <label for="count_section" style="font-size: 16px"> الحالة</label>
               <select class="form-control mt-2" id="status"  name="status"  >
                <option selected disabled value="">  اختر الحالة </option>
                <option  value="active">  مفعل </option>
                <option  value="inactive"> غير مفعل  </option>
               </select>
                 <div class="invalid-feedback" id="error-name"></div>
        </div>
       <div class="mb-4">
              <label for="count_section" style="font-size: 16px"> تاريخ التعيين</label>
              <input type="date" class="form-control mt-2" id="date_of_appointment"  name="date_of_appointment"  placeholder="تاريخ الإصدار">
                  <div  class="invalid-feedback" id="error-name"></div>
                  
       </div>
       </div>
       </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-info col-12"> تعديل</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
        </form>
    </div>
  </div>
</div>
--}}

 <div class="row">
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header bg-transparent">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0"> جميع المستويات </h5>
            </div>
            <div class="col">
              <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                <div class="dropdown">
                  <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                    </li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
           </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="datatable" class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>الرقم التسلسلي</th>
                  <th> اسم الطالب/ة الاول</th>
                  <th> اسم الطالب/ة الاخير</th>
                  <th>البريد الإلكتروني </th>
                  <th>  اسم ولي الامر </th>
                   <th> رقم جوال ولي الامر </th>
                   <th> الجنس </th>
                   <th> اسم المرحلة الدراسية </th>
                   <th>اسم الشعبة الدراسية</th>
                    <th>  تاريخ الميلاد</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</main><!--end row-->

@stop

@section('js')
    <script>
     var table = $('#datatable').DataTable({ 
         processing: true ,
         serverSide: true ,
         processing: true ,
ajax: {
    url: '{{ route('dash.student.getdata') }}',
    data: function(d) {
        d.name = $('#search-name').val();
        d.email = $('#search-email').val();
        d.phone = $('#search-phone').val();
    }
},

columns:[
{
 data: 'DT_RowIndex' ,
 name: 'DT_RowIndex' ,
 orderable: false ,
 searchable :false ,
},
{
 data: 'first_name' ,
 name: 'first_name' ,
 title :'اسم الطالب/ة الاول ' ,
 orderable: true ,
 searchable :true ,
 },
{
  data: 'last_name' ,
 name: 'last_name' ,
 title :'اسم الطالب/ة الاخير' ,
 orderable: true ,
 searchable :true ,
},
{
  data: 'email' ,
 name: 'email' ,
 title :'البريد الإلكتروني ' ,
 orderable: false ,
 searchable :false ,
}
,
{
  data: 'parent_name' ,
 name: 'parent_name' ,
 title :'  اسم ولي الامر ' ,
 orderable: false ,
 searchable :false ,
}
,
{

  data: 'parent_phone' ,
 name: 'parent_phone' ,
 title :'رقم جوال ولي الامر  ' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'gender' ,
 name: 'gender' ,
 title :'الجنس ' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'grade_name' ,
 name: 'grade_name' ,
 title :'   المرحلة الدراسية ' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'section_name' ,
 name: 'section_name' ,
 title :'  الشعبة الدراسية' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'date_of_birth' ,
 name: 'date_of_birth' ,
 title :' تاريخ الميلاد ' ,
 orderable: false ,
 searchable :false ,
 },
{
  data: 'action' ,
 name: 'action' ,
 title :'العمليات' ,
 orderable: false ,
 searchable :false ,
}

],

language:{
url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
}   
});

$('#search-btn').on('click', function(e) {
    e.preventDefault();
    table.draw();
});
$('#clean-btn').on('click', function(e) {
    e.preventDefault();
    $('.search-input').val("").trigger('change');
    table.draw();
});

        //chat
      $(document).ready(function() {
    // إضافة معلم جديد
   $('#add-form').on('submit', function(e) {
    e.preventDefault();

    // نظف الأخطاء السابقة
    $('#add-form .invalid-feedback').text('');
    $('#add-form .form-control').removeClass('is-invalid');

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
     $('#add-modal').modal('hide');  // إغلاق المودال
    $('#add-form')[0].reset();      // تفريغ الحقول
    table.draw();                  // تحديث الجدول
        },
        error: function(xhr) {
            if (xhr.status === 422) { // Validation error
                let errors = xhr.responseJSON.errors;

                $.each(errors, function(field, messages) {
                    let errorElement = $('#add-form #error-' + field);
                    if (errorElement.length) {
                        errorElement.text(messages[0]); // أول رسالة خطأ
                        $('#add-form #' + field).addClass('is-invalid');
                    }
                });
            } else {
                alert('حدث خطأ غير متوقع');
            }
        }
    });
});

    // ملء نموذج التعديل عند الضغط على زر التعديل
    $(document).on('click', '.upda te_btn', function() {
        let button = $(this);
        $('#update-modal input[name="id"]').val(button.data('id'));
       $('#update-modal input[name="name"]').val(button.data('name'));
       $('#update-modal input[name="phone"]').val(button.data('phone'));
        $('#update-modal input[name="email"]').val(button.data('email'));
        $('#update-modal input[name="date_of_birth"]').val(button.data('date_of_birth'));
        $('#update-modal input[name="university_major"]').val(button.data('university_major'));
        $('#update-modal select[name="academic_qualification"]').val(button.data('academic_qualification'));
        $('#update-modal select[name="gender"]').val(button.data('gender'));
        $('#update-modal input[name="date_of_appointment"]').val(button.data('date_of_appointment'));
        $('#update-modal select[name="status"]').val(button.data('status'));


        // امسح حقل كلمة المرور في التعديل لتركه فارغًا
        $('#update-modal input[name="password"]').val('');

        $('#update-modal').modal('show');
    });

    // تحديث بيانات المعلم
   $('#update-form').on('submit', function(e) {
    e.preventDefault();

    // نظف الأخطاء السابقة
    $('#update-form .invalid-feedback').text('');
    $('#update-form .form-control').removeClass('is-invalid');

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#update-modal').modal('hide');
            table.draw();
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;

                $.each(errors, function(field, messages) {
                    let errorElement = $('#update-form #error-' + field);
                    if (errorElement.length) {
                        errorElement.text(messages[0]);
                        $('#update-form #' + field).addClass('is-invalid');
                    }
                });
            } else {
                alert('حدث خطأ غير متوقع');
            }
        }
    });
});


  
   // حذف معلم باستخدام SweetAlert
$(document).on('click', '.delete_btn', function(e) {
    e.preventDefault();

    let button = $(this);
    let id = button.data('id');

    Swal.fire({
        title: 'هل أنت متأكد من الحذف؟',
        text: "لن تتمكن من التراجع عن هذا!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'نعم، احذف',
        cancelButtonText: 'إلغاء',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("dash.teacher.delete") }}',
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'تم الحذف!',
                        'تم حذف المعلم بنجاح.',
                        'success'
                    );
                    table.draw();
                },
                error: function(xhr) {
                    let errorMessage = 'حدث خطأ أثناء الحذف.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('خطأ!', errorMessage, 'error');
                }
            });
        }
    });
});

$(document).on('click', '.active_btn1', function(e) {
    e.preventDefault();

    let button = $(this);
    let id = button.data('id');
    // let url = button.data('url');

    Swal.fire({
        title: 'هل أنت متأكد من تفعيل هذا المعلم',
        text: "لن تتمكن من التراجع عن هذا!",
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'نعم، فعّل',
        cancelButtonText: 'إلغاء',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("dash.teacher.active1") }}',
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'تم التفعيل!',
                        'تم التفعيل المعلم بنجاح.',
                        'success'
                    );
                    table.draw();
                },
                error: function(xhr) {
                    let errorMessage = 'حدث خطأ أثناء التفعيل.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('خطأ!', errorMessage, 'error');
                }
            });
        }
    });
});

});






    </script>
@stops