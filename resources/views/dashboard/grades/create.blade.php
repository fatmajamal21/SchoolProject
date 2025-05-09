@extends('dashboard.master')
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
        <option value="1">المرحلة الابتدائية</option>
        <option value="2">المرحلة الإعدادية</option>
        <option value="3">المرحلة الثانوية</option>
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
        _token: '{{ csrf_token() }}',
        name: name,
        stage: stage
    },
    success: function(res) {
       alert(res);
       $('#formcreate').trigger('reset');
    },
    error: function(e) {
        console.log(e);
    }
});

    });
</script>
@endsection
