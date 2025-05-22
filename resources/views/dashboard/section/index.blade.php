
@extends('dashboard.master')
@section('title')
مدرسة بنات معن  | الصفحة الرئيسية في المستويات
@stop
@section('page-content')
<main class="page-content">
  <div class="container">
  <button class="btn btn-primary col-12 " data-bs-toggle="modal" data-bs-target="#addModal">
    اضافة  شُعب
  </button>
  </div>
  


{{-- المودل للصفوف --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="sectionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sectionsModalLabel">إضافة عدد الشُعب</h5>
      </div>

      <div  class="modal-body">
        <div class="container">
          <form action="{{ route('dash.section.add') }}" method="POST" id="add-form" class="add-form">
            @csrf 
            <div class="mb-4">
              <label for="count_section" style="font-size: 16px">أدخل عدد الشُعب المرغوب فيها</label>
              <input 
                class="form-control mt-2" type="number" name="count_section" id="count_section"   min="1" >
              <div class="invalid-feedback" id="count_section_error" style="display:none;"></div>
            </div>

            <button type="submit" class="btn btn-primary col-12">
              إضافة
            </button>
          </form>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
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
                  <th>الإسم</th>
                  {{-- <th>المرحلة</th> --}}
                  <th> الحالة</th>
                  <th>العمليات</th>
                   <th>العمليات2</th>
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
     url: '{{ route('dash.section.getdata') }}'
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
 title :'الإسم' ,
 orderable: true ,
 searchable :true ,
 },
{
  data: 'status' ,
 name: 'status' ,
 title :'الحالة' ,
 orderable: true ,
 searchable :true ,
},
{
  data: 'action' ,
 name: 'action' ,
 title :'العمليات' ,
 orderable: false ,
 searchable :false ,
},
 {
    data: 'action2' ,
 name: 'action2' ,
 title :'العمليات2' ,
 orderable: false ,
 searchable :false ,
 }

],

language:{
url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
}
});

    $('.add-form').on('submit', function (e) {
     e.preventDefault();
     var data = new FormData(this);
     var url = $(this).attr('action');
     var type = $(this).attr('method');
    //  alert('ahmed');
// name=ali&gender=18& ....
        $.ajax({
            url: url, 
            type: type,
            //بمنع ارسل البيانات نص
            processData: false ,
            // بخلي المتصفح الي يححد النوع للبيانات المرسلة
            contentType: false , 
            data: data ,

          success: function (res) {
          $('#addModal').modal('hide');  // إذا لديك مودال
            $('#add-form').trigger('reset');
              // toastr.success(res.success);
              table.draw(); 
            },
            error: function (res) {
                alert('حدث مشكلة في الكود');
            }
        });
    });


     $(document).ready(function(){
         $(document).on('change' , '.active-section-switch' , function(e){
              var id = $(this).data('id');
              var status = $(this).data('status');
              e.preventDefault();
              
        $.ajax({
            url: "{{ route('dash.section.changestatus') }}", 
            type: "POST",
           data: {
                    'id': id,
                    'status':status , 
                   '_token': "{{ csrf_token() }}" ,
                  },

          success: function (res) {
              // toastr.success(res.success);
              table.draw(); 
            },
            error: function (res) {
                alert('حدث مشكلة في الكود');
            }
        });
    });
 


    $(document).on('click', '.toggle-status-btn', function(e) {
    e.preventDefault();

    // var parentDiv = $(this).closest('.active-section-input');

    var id =  $(this).data('id');
    var status = $(this).data('status');

    $.ajax({
        url: "{{ route('dash.section.changestatus2') }}",
        type: "POST",
        data: {
            'id': id,
            'status': status,
            '_token': "{{ csrf_token() }}"
        },
        success: function(res) {
            // toastr.success(res.success);
            table.draw();  
        },
        error: function(res) {
            alert('حدثت مشكلة في تحديث الحالة');
        }
    });
});

  //  $(document).on('click' , '.active-section-input' , function(e){
  // e.preventDefault();
  // var id = $(this).data('id');
  // var status = $(this).data('status');

  // $.ajax({
  //     url: "{{ route('dash.section.changestatus2') }}",
  //     type: "POST",
  //     data: {
  //         'id': id,
  //         'status': status,
  //         '_token': "{{ csrf_token() }}"
  //     },
  //     success: function(res) {
  //         toastr.success(res.success);
  //         table.draw();  // إعادة تحميل بيانات الجدول
  //     },
  //     error: function(res) {
  //         alert('حدثت مشكلة في تحديث الحالة');
  //     }
  //     });
  // });
    

 })

         
  


  // $('.grade-checkbox').on('change', function() {
  //   var target = $(this).data('target');
  //   var checked = $(this).prop('checked');
  //   if (!checked) {
  //     $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات
  //   } else {
  //     $(target).find('input[type=checkbox]').prop('disabled', false); // تمكين التشيك بوكسات
  //   }
  // });


//     $('.grade-checkbox').on('change', function () {
//       var checkbox = $(this);
//         var isChecked = checkbox.is(':checked') ? 1 : 0;
//         var stage = checkbox.data('stage');
//         var tag = checkbox.data('grade');
//         var name = checkbox.data('name');

//         $.ajax({
//             url: "{{ route('dash.grade.add') }}",
//             type: "POST",
//             data: {
//               'name': name,
//               'tag': tag,
//               'stage': stage,
//                'status'  : isChecked ,
//               '_token': "{{ csrf_token() }}"
//        },


//       success: function (res) {
//                 // console.log(res.message);

//                     toastr.success(res.success);
//                 // fبروح يطلب كل التيبل ملارة تانية وبحدثهم 
//                 table.draw(); 
//             },
//             error: function (res) {
//                 alert('حدث مشكلة في الكود');
//             }
//         });
//     });


//     $.ajax({
//             url: "{{ route('dash.grade.getactive') }}",
//             type: "GET",
//             success: function(res){
//                var activeTages = res.tags.map(Number);
//               //  alert(activeTages);

//               $('.grade-checkbox').not('master.checkbox').each(function(){
//                 var checkbox = $(this);
//                 var datagrade = checkbox.data('grade');
//                if(activeTages.includes(datagrade)){
//                 checkbox.prop('checked' , true) ;
//                 checkbox.prop('disabled' , false) ;
//                }
//               })
//             },
//             });

// /////////////////////////////////////////////////

//        $.ajax({
//             url: "{{ route('dash.grade.getactivestage') }}",
//             type: "GET",
//             success: function(res){
//                var activeTages = res.tags;
//               //  alert(activeTages);

//               $('.master-checkbox').each(function(){
//                 var checkbox = $(this);
//                 var datatag = checkbox.data('tag');
//                if(activeTages.includes(datatag)){
//                 checkbox.prop('checked' , true) ;
//                 checkbox.prop('disabled' , false) ;
//                }else{
//                  checkbox.prop('checked' , false) ;
//                      var target = $(this).data('target');
//                      $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات
//                }
//               })
//             },
//             });


//             $(document).ready(function(){

//               $(document).on('click' , '.btn-add-section' , function(e){
//               e.preventDefault();
//               var button =$(this);
//               var gradetag = button.data('grade');
//               // alert(gradetag);
//               $('#gradetag').val(gradetag);

//             }) 
//             });



//    $('.section-checkbox').on('change', function () {
//       var checkbox = $(this);
//         var status = checkbox.is(':checked') ? 1 : 0;
//         var section = checkbox.data('section');
//        var gradetag = $('#gradetag').val();

//         $.ajax({
//             url: "{{ route('dash.grade.addsection') }}",
//             type: "POST",
//             data: {
//               'section': section,
//               'gradetag' :gradetag ,
//               'status'  : status ,
//               '_token': "{{ csrf_token() }}" ,
//        },


//       success: function (res) {
//                 // console.log(res.message);

//                 toastr.success(res.success);

//                 // fبروح يطلب كل التيبل ملارة تانية وبحدثهم 
//                 table.draw(); 
//             },
//             error: function (res) {
//                 alert('حدث مشكلة في الكود');
//             }
//         });
//     });

//  $('.master-checkbox').on('change', function () {
//       var checkbox = $(this);
//         var status = checkbox.is(':checked') ? 1 : 0;
//         var tag = checkbox.data('tag');

//         $.ajax({
//             url: "{{ route('dash.grade.changemaster') }}",
//             type: "POST",
//             data: {
//               'tag': tag,
//               'status'  : status ,
//               '_token': "{{ csrf_token() }}" ,
//        },


//       success: function (res) {
//                 // console.log(res.message);
//                 toastr.success(res.success);

//                 // fبروح يطلب كل التيبل ملارة تانية وبحدثهم 
//                 table.draw(); 
//             },
//             error: function (res) {
//                 alert('حدث مشكلة في الكود');
//             }
//         });
//     });



//       $(document).ready(function(){

//               $(document).on('click' , '.btn-add-section' , function(e){
//               e.preventDefault();
//               var button = $(this);
//               var gradeid = button.data('grade-id');
      
//               // alert(gradeid);


//       $.ajax({
//             url: "{{ route('dash.grade.getactivesection') }}",
//             type: "GET",
//             data : {
//               'gradeId' : gradeid ,
//             },
//             success: function(res){
//                var activeSection = res.names.map(Number);
//               //  alert(activeTages);

//               $('.section-checkbox').each(function(){
//                 var checkbox = $(this);
//                 var datasection = checkbox.data('section');
//                if(activeSection.includes(datasection)){
//                 checkbox.prop('checked' , true) ;
//                 checkbox.prop('disabled' , false) ;
//                }else{
//                checkbox.prop('checked' , false);
//                }
//               })
//             },

//             });



//             }) 

            // });



    </script>
@stop