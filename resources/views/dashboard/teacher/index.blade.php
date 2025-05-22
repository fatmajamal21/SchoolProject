
@extends('dashboard.master')
@section('title')
مدرسة بنات معن  | المعلم صفحة   
@stop
@section('page-content')
<main class="page-content">
  <div class="container">
  <button class="btn btn-primary col-12 " data-bs-toggle="modal" data-bs-target="#add-modal">
    اضافة  معلم
  </button>
  </div>
  


{{-- المودل لاضافة معلم --}}
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="sectionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionsModalLabel">إضافة  معلم</h5>
      </div>

      <div  class="modal-body">
        <div class="container">
          <form action="{{ route('dash.teacher.add') }}" method="POST" id="add-form" class="add-form">
            @csrf 
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
    <label for="password" style="font-size: 16px">إنشاء كلمة سر</label>
    <input type="password" class="form-control mt-2" id="password" name="password" placeholder="إنشاء كلمة سر" required>
      <div class="invalid-feedback" id="error-name"></div>
</div>
<div class="mb-4">
    <label for="password_confirmation" style="font-size: 16px">تأكيد كلمة السر</label>
    <input type="password" class="form-control mt-2" id="password_confirmation" name="password_confirmation" placeholder="تأكيد كلمة السر" required>
      <div class="invalid-feedback" id="error-name"></div>
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
              <label for="count_section" style="font-size: 16px"> تاريخ التعيين</label>
              <input type="date" class="form-control mt-2" id="date_of_appointment"  name="date_of_appointment"  placeholder="تاريخ الإصدار">
                <div class="invalid-feedback" id="error-name"></div>
       </div>
       </div>
       </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-primary col-12"> إضافة</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
        </form>
    </div>
  </div>
</div>



{{-- المودل لعرض الصفوف --}}
<div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="sectionsModalLabel" aria-hidden="true">
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
    <label for="password" style="font-size: 16px">تغيير كلمة السر (اختياري)</label>
    <input type="password" class="form-control mt-2" id="password_update" name="password" placeholder="تغيير كلمة السر">
      <div class="invalid-feedback" id="error-name"></div>
</div>
<div class="mb-4">
    <label for="password" style="font-size: 16px">تاكيد كلمة السر </label>
    <input type="password" class="form-control mt-2" id="password_update" name="password" placeholder="تغيير كلمة السر">
      <div class="invalid-feedback" id="error-name"></div>
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
                  <div class="invalid-feedback" id="error-name"></div>
       </div>
       </div>
       </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-primary col-12"> إضافة</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
        </form>
    </div>
  </div>
</div>


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
                  <th>الإسم كامل</th>
                  <th> رقم الهاتف</th>
                  <th>تاريخ الميلاد</th>
                  <th> الايميل</th>
                   <th> كلمة السر</th>
                   <th>التخصص الجامعي</th>
                   <th> المؤهل العلمي</th>
                   <th> الجنس</th>
                   <th> تاريخ التعيين</th>
                    <th>  الحالة</th>
                    <th> العمليات</th>
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
  ajax:{
     url: '{{ route('dash.teacher.getdata') }}'
  },
columns:[
{
 data: 'DT_RowIndex' ,
 name: 'DT_RowIndex' ,
 orderable: false ,
 searchable :false ,
},
{
 data: 'name' ,
 name: 'name' ,
 title :'الإسم كامل' ,
 orderable: true ,
 searchable :true ,
 },
{
  data: 'phone' ,
 name: 'phone' ,
 title :'رقم الهاتف' ,
 orderable: true ,
 searchable :true ,
},
{
  data: 'date_of_birth' ,
 name: 'date_of_birth' ,
 title :'تاريخ الميلاد' ,
 orderable: false ,
 searchable :false ,
}
,
{
  data: 'email' ,
 name: 'email' ,
 title :' الايميل' ,
 orderable: false ,
 searchable :false ,
}
,
{

  data: 'password' ,
 name: 'password' ,
 title :' كلمة السر' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'university_major' ,
 name: 'university_major' ,
 title :'التخصص الجامعي' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'academic_qualification' ,
 name: 'university_major' ,
 title :'  المؤهل العلمي' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'gender' ,
 name: 'gender' ,
 title :' الجنس' ,
 orderable: false ,
 searchable :false ,
 },
 {
    data: 'date_of_appointment' ,
 name: 'date_of_appointment' ,
 title :' تاريخ التعيين' ,
 orderable: false ,
 searchable :false ,
 },
{
  data: 'status' ,
 name: 'status' ,
 title :'الحالة' ,
 orderable: true ,
 searchable :true ,
},{
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



//     $('.add-form').on('submit', function (e) {
//     e.preventDefault();
//      var data = new FormData(this);
//      var url = $(this).attr('action');
//      var type = $(this).attr('method');
// //  alert('ahmed');
// //name=ali&gender=18& ....
//         $.ajax({
//             url: url, 
//             type: type,
//             //بمنع ارسل البيانات نص
//           processData: false ,
//            // بخلي المتصفح الي يححد النوع للبيانات المرسلة
//           contentType: false , 
//             data: data ,
//           success: function (res) {
//          $('#add-modal').modal('hide');  // إذا لديك مودال
//            $('#add-form').trigger('reset');
//               // toastr.success(res.success);
//               table.draw(); 
//             },
//            error: function (res) {
//                 alert('حدث مشكلة في الكود');
//              }
//         });
//      });

  

    
            // $(document).ready(function()){

              // $(document).on('click' , '.update_btn' , function(e){
              // e.preventDefault();
              // var button =$(this);


      // var id = button.data('id');
      //    var name = button.data('name');
      //       var phone = button.data('phone');
      //        var email = button.data('email');
      //           var date_of_birth = button.data('date_of_birth');
      //            var university_major = button.data('university_major');
      //             var academic_qualification = button.data('academic_qualification');
      //              var gender = button.data('gender');
      //               var date_of_appointment = button.data('date_of_appointment');
      //                var status = button.data('status');

      //                 $('#id').val(id);
      //                  $('#name').val(name);
      //                   $('#phone').val(phone);
      //                    $('#email').val(email);
      //                     $('#date_of_birth').val(date_of_birth);
      //                      $('#university_major').val(university_major);
      //                       $('#academic_qualification').val(academic_qualification);
      //                        $('#gender').val(gender);
      //                         $('#date_of_appointment').val(date_of_appointment);
      //                          $('#status').val(status);


            // }) ;
        //  }



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
            $('#add-modal').modal('hide');
            $('#add-form')[0].reset();
            table.draw();
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
    $(document).on('click', '.update_btn', function() {
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

      //  var id = button.data('id');
      //    var name = button.data('name');
      //       var phone = button.data('phone');
      //        var email = button.data('email');
      //           var date_of_birth = button.data('date_of_birth');
      //            var university_major = button.data('university_major');
      //             var academic_qualification = button.data('academic_qualification');
      //              var gender = button.data('gender');
      //               var date_of_appointment = button.data('date_of_appointment');
      //                var status = button.data('status');

      //                 $('#id').val(id);
      //                  $('#name').val(name);
      //                   $('#phone').val(phone);
      //                    $('#email').val(email);
      //                     $('#date_of_birth').val(date_of_birth);
      //                      $('#university_major').val(university_major);
      //                       $('#academic_qualification').val(academic_qualification);
      //                        $('#gender').val(gender);
      //                         $('#date_of_appointment').val(date_of_appointment);
      //                          $('#status').val(status);

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


    // حذف معلم
    $(document).on('click', '.delete_btn', function() {
        if (!confirm('هل أنت متأكد من حذف هذا المعلم؟')) {
            return;
        }
        let id = $(this).data('id');

        $.ajax({
            url: '{{ route("dash.teacher.delete") }}',
            method: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                table.draw();
            },
            error: function() {
                alert('حدث خطأ أثناء الحذف');
            }
        });
    });
});






    </script>
@stop