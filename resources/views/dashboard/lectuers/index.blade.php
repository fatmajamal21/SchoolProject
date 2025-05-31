@extends('dashboard.master')
@section('title')
مدرسة خانيونس للبنين   | الصفحة الرئيسية في المحاضرات
@stop
@section('page-content')
<main class="page-content">
  <div class="container">
    <div class="row mb-4">
      <!-- عنوان المحاضرة -->
      <div class="col-md-2 mb-2">
        <input type="text" class="form-control mt-2 search-input" id="search-name"  placeholder="بحث بالعنوان">
      </div>
      
      <!-- اسم المادة -->
      <div class="col-md-2 mb-2">
        <input type="text" class="form-control mt-2 search-input" id="search-subject" placeholder="بحث بالمادة">
      </div>
      
      <!-- اسم المعلم -->
      <div class="col-md-2 mb-2">
        <input class="form-control mt-2 search-input" id="search-teacher" placeholder="بحث بالمعلم">
      </div>

      <!-- زر البحث -->
      <div class="col-md-2 mb-2 d-flex align-items-end">
        <button type="button" id="search-btn" class="btn btn-primary w-100">
          <i class="lni lni-search"></i> بحث
        </button>
      </div>

      <!-- زر التنظيف -->
      <div class="col-md-2 mb-2 d-flex align-items-end">
        <button type="button" id="clean-btn" class="btn btn-primary w-100">
          <i class="lni lni-brush"></i> تنظيف 
        </button>
      </div>

      <!-- زر الإضافة -->
      <div class="col-md-2 mb-2 d-flex align-items-end">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-modal">
          <i class="bi bi-plus-circle"></i> إضافة محاضرة
        </button>
      </div>
    </div>

    <!-- مودال الإضافة -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">إضافة محاضرة جديدة</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="add-form">
            @csrf
            <div class="modal-body">
              <div class="mb-4">
                <label for="titel" style="font-size: 16px">العنوان</label>
                <input type="text" class="form-control mt-2" id="titel" name="titel" placeholder="عنوان المحاضرة">
                <div class="invalid-feedback" id="error-name"></div>
              </div>
              <div class="mb-4">
                <label for="description" style="font-size: 16px">الوصف</label>
                <input type="text" class="form-control mt-2" id="description" name="description" placeholder="وصف المحاضرة">
                <div class="invalid-feedback" id="error-description"></div>
              </div>
              <div class="mb-4">
                <label for="link" style="font-size: 16px">رابط المحاضرة</label>
                <input type="url" class="form-control mt-2" id="link" name="link" placeholder="رابط المحاضرة">
                <div class="invalid-feedback" id="error-link"></div>
              </div>
              <div class="mb-4">
                <label for="subject_id" style="font-size: 16px">اسم المادة</label>
                <select class="form-select mt-2" id="subject_id" name="subject_id">
                  <option value="">اختر المادة</option>
                  @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->titel }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback" id="error-subject_id"></div>
              </div>
{{--               
              <div class="mb-4">
                <label for="teacher_id" style="font-size: 16px">اسم المعلم</label>
                <select class="form-select mt-2" id="teacher_id" name="teacher_id">
                  <option value="">اختر المعلم</option>
                  @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback" id="error-teacher_id"></div>
              </div> --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
              <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- مودال التعديل -->
    <div class="modal fade" id="update-modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="update-form">
            @csrf
            <input type="hidden" name="id" id="update-id">
            <div class="modal-header">
              <h5 class="modal-title">تعديل المحاضرة</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <label for="update-titel" style="font-size: 16px">العنوان</label>
                <input type="text" class="form-control mt-2" id="update-titel" name="titel" placeholder="عنوان المحاضرة">
                <div class="invalid-feedback" id="error-update-titel"></div>
              </div>
              <div class="mb-4">
                <label for="update-description" style="font-size: 16px">الوصف</label>
                <input type="text" class="form-control mt-2" id="update-description" name="description" placeholder="وصف المحاضرة">
                <div class="invalid-feedback" id="error-update-description"></div>
              </div>
              <div class="mb-4">
                <label for="update-link" style="font-size: 16px">رابط المحاضرة</label>
                <input type="url" class="form-control mt-2" id="update-link" name="link" placeholder="رابط المحاضرة">
                <div class="invalid-feedback" id="error-update-link"></div>
              </div>
              <div class="mb-4">
                <label for="update-subject_id" style="font-size: 16px">اسم المادة</label>
                <select class="form-select mt-2" id="update-subject_id" name="subject_id">
                  @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->titel }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback" id="error-update-subject_id"></div>
              </div>
    
              {{-- <div class="mb-4">
                <label for="update-teacher_id" style="font-size: 16px">اسم المعلم</label>
                <select class="form-select mt-2" id="update-teacher_id" name="teacher_id">
                  @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback" id="error-update-teacher_id"></div>
              </div> --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
              <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- جدول المحاضرات -->
    <div class="row">
      <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card radius-10 w-100">
          <div class="card-header bg-transparent">
            <div class="row g-3 align-items-center">
              <div class="col">
                <h5 class="mb-0">قائمة المحاضرات</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable" class="table align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>رابط المحاضرة</th>
                    <th>المادة</th>
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
  url: '{{ route("dash.lectuers.getdata") }}',
  data: function(d) {
      d.titel  = $('#search-name').val();
      d.subject = $('#search-subject').val();
      d.teacher = $('#search-teacher').val();
  }
}
,
        columns: [
            { data: 'DT_RowIndex', 
            name: 'DT_RowIndex',
             orderable: false,
              searchable: false 
              },
            {
             data: 'titel',
             name: 'titel'
              },
            { data: 'description',
             name: 'description' 
             },
            { 
            data: 'link', 
            name: 'link' 
            }
            ,
            { data: 'subject',
             name: 'subject.name' 
             }
             ,
              //  { data: 'teacher',
              //   name: 'teacher.name' 
              //   },
            // { data: 'teacher', name: 'user.name' },
            { data: 'action', 
            name: 'action',
             orderable: false, 
             searchable: false 
             }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
        }
    });

    // البحث
    $('#search-btn').click(function() {
        table.draw();
    });

    // تنظيف البحث
    $('#clean-btn').click(function() {
        $('.search-input').val('');
        table.draw();
    });

    // إضافة محاضرة جديدة
    $('#add-form').submit(function(e) {
        e.preventDefault();
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');

        $.ajax({
            url: '{{ route("dash.lectuers.add") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#add-modal').modal('hide');
                $('#add-form')[0].reset();
                table.draw();
                // toastr.success(response.success);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        $('#error-' + field).text(messages[0]);
                        $('#' + field).addClass('is-invalid');
                    });
                } else {
                    // toastr.error('حدث خطأ غير متوقع');
                }
            }
        });
    });

    // ملء بيانات التعديل
    $(document).on('click', '.update_btn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var link = $(this).data('link');
        var subject_id = $(this).data('subject_id');
        // var teacher_id = $(this).data('teacher_id');

        $('#update-id').val(id);
       $('#update-titel').val(name);
        $('#update-description').val(description);
        $('#update-link').val(link);
        $('#update-subject_id').val(subject_id);
        // $('#update-teacher_id').val(teacher_id);

        $('#update-modal').modal('show');
    });

    // تعديل المحاضرة
    $('#update-form').submit(function(e) {
        e.preventDefault();
        $('.invalid-feedback').text('');
        $('.form-control').removeClass('is-invalid');

        $.ajax({
            url: '{{ route("dash.lectuers.update") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#update-modal').modal('hide');
                table.draw();
                // toastr.success(response.success);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        $('#error-update-' + field).text(messages[0]);
                        $('#update-' + field).addClass('is-invalid');
                    });
                } else {
                    // toastr.error('حدث خطأ غير متوقع');
                }
            }
        });
    });

    // حذف المحاضرة
    $(document).on('click', '.delete_btn', function() {
        var id = $(this).data('id');
        if (confirm('هل أنت متأكد من حذف هذه المحاضرة؟')) {
            $.ajax({
                url: '{{ route("dash.lectuers.delete", "") }}/' + id,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    table.draw();
                    // toastr.success(response.success);
                },
                error: function() {
                    // toastr.error('حدث خطأ أثناء الحذف');
                }
            });
        }
    });
});
</script>
@stop