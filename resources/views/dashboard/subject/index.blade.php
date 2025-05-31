@extends('dashboard.master')

@section('titel')
مدرسة خانيونس للبنين   | الصفحة الرئيسية للمواد الدراسية
@stop

@section('page-content')
<main class="page-content">
  <div class="container">

    {{-- عنوان الصفحة --}}
    <div class="row mb-4">
      <div class="col-12">
        <h4 class="text-center">جميع المواد الدراسية</h4>
      </div>
    </div>

    {{-- زر الإضافة --}}
    <div class="row mb-4">
      <div class="col-12 text-end">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal">
          <i class="bi bi-plus-circle"></i> إضافة مادة
        </button>
      </div>
    </div>

    {{-- جدول المواد --}}
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive"> 
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>اسم المادة</th>
                    <th>الكتاب</th>
                    <th>جميع المحاضرات</th>
                    <th>معلم المادة</th>
                    <th>المرحلة الدراسية</th>
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

@section('css')
<style>
  .btn-action {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    margin: 0 2px;
  }
</style>
@stop

@section('js')
<script>
  $(document).ready(function() {
    // تهيئة DataTable
    var table = $('#datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{{ route("dash.subject.getdata") }}',
        data: function(d) {
          d.titel = $('#search-titel').val();
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
          data:  'titel', 
          name: 'titel' 
         }
         ,
        {
         data: 'book',
          name: 'book',
          render: function(data, type, row) {
            if (data) {
              return '<a href="{{ url("dashboard/subject/download") }}/' + encodeURIComponent(data) + '" class="btn btn-sm btn-outline-primary" download><i class="bi bi-download"></i> ' + data + '</a>';
            } else {
              return 'لا يوجد كتاب';
            }
          }
        }
       ,
     {
data: 'lectures', name: 'lectures',
}
        ,
        { data: 'teacher.name', 
        name: 'teacher.name' 
        },
        { data: 'grade.name',
         name: 'grade.name' 
        }
    
        ,
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          render: function(data, type, row) {
            return `
              <button class="btn btn-warning btn-sm btn-action update_btn" 
                data-id="${row.id}" 
                data-titel="${row.titel}" 
                data-grade_id="${row.grade_id}" 
                data-teacher_id="${row.teacher_id}" 
                data-book="${row.book}">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn btn-danger btn-sm btn-action delete_btn" data-id="${row.id}">
                <i class="bi bi-trash"></i>
              </button>
            `;
          }
        }
      ],
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
      },
      responsive: true
    });

    // إضافة مادة
    $('#add-form').on('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      
      $.ajax({
        url: '{{ route("dash.subject.add") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $('#add-modal').modal('hide');
          table.draw();
          // toastr.success(response.success);
          $('#add-form')[0].reset();
        },
        error: function(xhr) {
          var errors = xhr.responseJSON.errors;
          $.each(errors, function(key, value) {
            // toastr.error(value[0]);
          });
        }
      });
    });

    // فتح مودال التعديل
    $(document).on('click', '.update_btn', function() {
      var id = $(this).data('id');
      var titel = $(this).data('titel');
      var grade_id = $(this).data('grade_id');
      var teacher_id = $(this).data('teacher_id');
      var book = $(this).data('book');

      $('#update_id').val(id);
      $('#update_titel').val(titel);
      $('#update_grade_id').val(grade_id);
      $('#update_teacher_id').val(teacher_id);
      
      $('#update-modal').modal('show');
    });

    // تعديل مادة
    $('#update-form').on('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      
      $.ajax({
        url: '{{ route("dash.subject.update") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $('#update-modal').modal('hide');
          table.draw();
          // toastr.success(response.success);
        },
        error: function(xhr) {
          var errors = xhr.responseJSON.errors;
          $.each(errors, function(key, value) {
            // toastr.error(value[0]);
          });
        }
      });
    });

    // حذف مادة
    $(document).on('click', '.delete_btn', function() {
      var id = $(this).data('id');
      
  
        $.ajax({
          url: '{{ route("dash.subject.delete") }}',
          type: 'POST',
          data: { id: id },
          success: function(response) {
            table.draw();
            // toastr.success(response.success);
          },
          error: function(xhr) {
            // toastr.error('حدث خطأ أثناء محاولة حذف المادة');
          }
        });
    
    });
  });
</script>
@stop