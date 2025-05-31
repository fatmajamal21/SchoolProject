@extends('dashboard.master')
@section('title')
مدرسة خانيونس للبنين   | الصفحة الرئيسية في المحاضرات
@stop
@section('page-content')
<main class="page-content">
  <div class="container">
    <div class="row mb-4">
          <!-- Teacher Name Field -->
    <div class="col-md-2 mb-2">
      {{-- <label for="search-titel" class="form-label">اسم المعلم/ة الكامل</label> --}}
      <input type="text" class="form-control mt-2 search-input" id="search-titel-lectuer" placeholder=" العنوان">
      <div class="invalid-feedback" id="error-name"></div>
    </div>



    <!-- Search Button -->
       <div class="col-md-2 mb-2 d-flex align-items-end">
       <button type="submit" id="search-btn"  class="btn btn-primary w-100 " >
          <i class="lni lni-search"></i>بحث
        </button>
    </div>

       <!-- Clean Button -->
       <div class="col-md-2 mb-2 d-flex align-items-end">
       <button type="reset" id="clean-btn" class="btn btn-primary w-100">
    <i class="lni lni-brush"></i> تنظيف 
        </button>
    </div>

    <!-- جدول المحاضرات -->
    <div class="row">
      <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card radius-10 w-100">
          <div class="card-header bg-transparent">
            <div class="row g-3 align-items-center">
              <div class="col">
                <h5 class="mb-0">قائمة المحاضرات لمادة  "{{$subject->titel}}"</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable" class="table align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                       <th>المادة</th>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>رابط المحاضرة</th>
                    {{-- <th>المعلم</th> --}}
                    <th>العمليات</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@stop

@section('js')
<script>
$(document).ready(function() {
    // تهيئة DataTable
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
ajax: {
    url: '{{ route("dash.subject.getdata.lectuers") }}',
    data: function(d) {
        d.id = {{$subject->id}};
        d.titel = $('#search-titel-lectuer').val();
        // d.teacher = $('#search-titel-lectuer').val();

    }
},
        columns: [
            { 
            data: 'DT_RowIndex', 
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false 
              }
              ,
            { 
            data: 'subject',
             name: 'subject.name' ,
             orderable: false, 
             searchable: false ,
             }
             ,
            {
             data: 'titel',
             name: 'titel', 
             orderable: false, 
             searchable: false ,
              }
              ,
            { 
            data: 'description',
             name: 'description' ,
             orderable: false, 
             searchable: false ,
             }
             ,
            { 
            data: 'link', 
            name: 'link' ,
            orderable: false, 
             searchable: false ,
            }
            ,
            {
             data: 'action', 
            name: 'action',
             orderable: false, 
             searchable: false 
             }
        ],
        language: {
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
});
</script>
@stop