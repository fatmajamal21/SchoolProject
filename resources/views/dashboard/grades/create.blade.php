



@extends('dashboard.master')
@section('title')
    مدرسة بنات معن | إدارة الأقسام
@stop
@section('page-content')
    <main class="page-content">
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h5 class="mb-0">جميع الأقسام</h5>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="sectionsTable" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>اسم القسم</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Section Modal -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addSectionForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم القسم</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">الحالة</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">مفعل</option>
                                <option value="inactive">غير مفعل</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Section Modal -->
    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل القسم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSectionForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">اسم القسم</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">الحالة</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="active">مفعل</option>
                                <option value="inactive">غير مفعل</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#sectionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                 url: "{{ route('dash.section.getSectionsData') }}",
                },

        data: {
              'name': name,
              'action': action,
               'status'  : isChecked ,
              '_token': "{{ csrf_token() }}"
            },
                   success: function (res) {
                // console.log(res.message);

                    toastr.success(res.success);
                // fبروح يطلب كل التيبل ملارة تانية وبحدثهم 
                table.draw(); 
            },
            error: function (res) {
                alert('حدث مشكلة في الكود');
            }
            })

        });
    </script>
@stop

























{{-- 
@extends('dashboard.master')
@section('title')
مدرسة بنات معن  |    إدارة الشُعب
@stop
@section('page-content')
<main class="page-content">
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
                  <th>المرحلة</th>
                  <th> الحالة</th>
                  <th>الشُعب </th>
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
     url: '{{ route('dash.grade.getdata') }}'
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
  data: 'stage' ,
 name: 'stage_id' ,
 title :'المرحلة' ,
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
  data: 'section' ,
 name: 'section' ,
 title :'الشُعب ' ,
 orderable: false ,
 searchable :false ,
}
],

language:{
url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
}});

  $('.grade-checkbox').on('change', function() {
    var target = $(this).data('target');
    var checked = $(this).prop('checked');
    if (!checked) {
      $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات
    } else {
      $(target).find('input[type=checkbox]').prop('disabled', false); // تمكين التشيك بوكسات
    }
  });


    $('.grade-checkbox').on('change', function () {
      var checkbox = $(this);
        var isChecked = checkbox.is(':checked') ? 1 : 0;
        var stage = checkbox.data('stage');
        var tag = checkbox.data('grade');
        var name = checkbox.data('name');

        $.ajax({
            url: "{{ route('dash.grade.add') }}",
            type: "POST",
            data: {
              'name': name,
              'tag': tag,
              'stage': stage,
               'status'  : isChecked ,
              '_token': "{{ csrf_token() }}"
       },


      success: function (res) {
                // console.log(res.message);

                    toastr.success(res.success);
                // fبروح يطلب كل التيبل ملارة تانية وبحدثهم 
                table.draw(); 
            },
            error: function (res) {
                alert('حدث مشكلة في الكود');
            }
        });
    });


    $.ajax({
            url: "{{ route('dash.grade.getactive') }}",
            type: "GET",
            success: function(res){
               var activeTages = res.tags.map(Number);
              //  alert(activeTages);

              $('.grade-checkbox').not('master.checkbox').each(function(){
                var checkbox = $(this);
                var datagrade = checkbox.data('grade');
               if(activeTages.includes(datagrade)){
                checkbox.prop('checked' , true) ;
                checkbox.prop('disabled' , false) ;
               }
              })
            },
            });

/////////////////////////////////////////////////

       $.ajax({
            url: "{{ route('dash.grade.getactivestage') }}",
            type: "GET",
            success: function(res){
               var activeTages = res.tags;
              //  alert(activeTages);

              $('.master-checkbox').each(function(){
                var checkbox = $(this);
                var datatag = checkbox.data('tag');
               if(activeTages.includes(datatag)){
                checkbox.prop('checked' , true) ;
                checkbox.prop('disabled' , false) ;
               }else{
                 checkbox.prop('checked' , false) ;
                     var target = $(this).data('target');
                     $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات
               }
              })
            },
            });


            $(document).ready(function(){

              $(document).on('click' , '.btn-add-section' , function(e){
              e.preventDefault();
              var button =$(this);
              var gradetag = button.data('grade');
              // alert(gradetag);
              $('#gradetag').val(gradetag);

            }) 
            });



   $('.section-checkbox').on('change', function () {
      var checkbox = $(this);
        var status = checkbox.is(':checked') ? 1 : 0;
        var section = checkbox.data('section');
       var gradetag = $('#gradetag').val();

        $.ajax({
            url: "{{ route('dash.grade.addsection') }}",
            type: "POST",
            data: {
              'section': section,
              'gradetag' :gradetag ,
              'status'  : status ,
              '_token': "{{ csrf_token() }}" ,
       },


      success: function (res) {
                // console.log(res.message);

                toastr.success(res.success);

                // fبروح يطلب كل التيبل ملارة تانية وبحدثهم 
                table.draw(); 
            },
            error: function (res) {
                alert('حدث مشكلة في الكود');
            }
        });
    });

 $('.master-checkbox').on('change', function () {
      var checkbox = $(this);
        var status = checkbox.is(':checked') ? 1 : 0;
        var tag = checkbox.data('tag');

        $.ajax({
            url: "{{ route('dash.grade.changemaster') }}",
            type: "POST",
            data: {
              'tag': tag,
              'status'  : status ,
              '_token': "{{ csrf_token() }}" ,
       },


      success: function (res) {
                // console.log(res.message);
                toastr.success(res.success);

                // fبروح يطلب كل التيبل ملارة تانية وبحدثهم 
                table.draw(); 
            },
            error: function (res) {
                alert('حدث مشكلة في الكود');
            }
        });
    });



      $(document).ready(function(){

              $(document).on('click' , '.btn-add-section' , function(e){
              e.preventDefault();
              var button = $(this);
              var gradeid = button.data('grade-id');
      
              // alert(gradeid);


      $.ajax({
            url: "{{ route('dash.grade.getactivesection') }}",
            type: "GET",
            data : {
              'gradeId' : gradeid ,
            },
            success: function(res){
               var activeSection = res.names.map(Number);
              //  alert(activeTages);

              $('.section-checkbox').each(function(){
                var checkbox = $(this);
                var datasection = checkbox.data('section');
               if(activeSection.includes(datasection)){
                checkbox.prop('checked' , true) ;
                checkbox.prop('disabled' , false) ;
               }else{
               checkbox.prop('checked' , false);
               }
              })
            },

            });



            }) 

            });




    </script>
@stop --}}












































{{-- @extends('dashboard.master')
@section('title')
مدرسة بنات معن  | الصفحة الرئيسية في المستويات
@stop
@section('page-content')
<main class="page-content">
 <div class="row">
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header bg-transparent">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">إضافة مستوى جديد </h5>
            </div>
          
           </div>
        </div>
        <div class="card-body">
              @if($errors->any())
    <div class="alert alert-danger border-0 bg-light-danger alert-dismissible fade show py-2">
        <div class="d-flex align-items-center">
            <div class="fs-3 text-danger">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div class="ms-3">
                <div class="text-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<form id="formcreate">
    <label style="font-size: 17px;" class="mb-3">اسم المستوي</label>
    <input id="name" name="name" class="form-control mb-3" type="text" placeholder="اسم المستوي" />

    <label style="font-size: 17px;" class="mb-3" for="stage">المرحلة</label>
    <select id="stage" name="stage" class="form-control mb-3">
        <option selected disabled>اختر المرحلة</option>
        @foreach ($stages as $stage)
            <option value="{{ $stage->id }}">{{ $stage->name }}</option> 
        @endforeach
    </select>

    <button type="submit" class="form-control mb-3 btn btn-outline-primary">إنشاء</button>
</form>

            
        </div>
      </div>
    </div>
    
  </div>
</main><!--end row-->
 
@stop

@section('js')
<script>
    // Capture form submission event
    $('#formcreate').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        var name = $('#name').val(); 
        var stage = $('#stage').val(); 

        //  Ajax request  
        $.ajax({
    url: "{{ route('dash.grade.add') }}", 
    type: 'POST',
    data: {
        "name" :name ,
        "stage" : stage ,
        "_token" : '{{ csrf_token() }}',
    },
    success: function(res) {
        console.log(res );
    },
    error: function(e) {
        console.log(e);
    }
});

    });
</script>
@endsection --}}
