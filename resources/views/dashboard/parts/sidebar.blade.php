

<ul class="metismenu" id="menu">
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-house-fill"></i>
        </div>
        <div class="menu-title">مدرسة خانيونس  للبنين</div>
      </a>
      <ul>
        <li> <a href="{{route('dash.mean.index')}}"><i class="bi bi-house-fill"></i>الصفحة الرئيسة</a>
        </li>
    
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-grid-fill"></i>
        </div>
        <div class="menu-title">Shcool</div>
      </a>
      <ul>
        <li> <a href="app-emailbox.html"><i class="bi bi-circle"></i>Email</a>
        </li>
        <li> <a href="app-chat-box.html"><i class="bi bi-circle"></i>Chat Box</a>
        </li>
        <li> <a href="app-file-manager.html"><i class="bi bi-circle"></i>File Manager</a>
        </li>
        <li> <a href="app-to-do.html"><i class="bi bi-circle"></i>Todo List</a>
        </li>
        <li> <a href="app-invoice.html"><i class="bi bi-circle"></i>Invoice</a>
        </li>
        <li> <a href="app-fullcalender.html"><i class="bi bi-circle"></i>Calendar</a>
        </li>
      </ul>
    </li>
    <li class="menu-label"> جميع الإدارات </li>
        <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-person-circle"></i>
        </div>
        <div class="menu-title">المعلمين</div>
      </a>
      <ul>
        <li> <a href="{{route('dash.teacher.index')}}"> <i class="bi bi-person-circle"></i>جميع المعلمون</a>
        </li>  
      </ul>
    </li>
            <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-person-circle"></i>
        </div>
        <div class="menu-title">الطلاب</div>
      </a>
      <ul>
        <li> <a href="{{route('dash.student.index')}}"> <i class="bi bi-person-circle"></i>جميع الطلاب</a>
        </li>  
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-building"></i></i>
        </div>
        <div class="menu-title" >  المستويات</div>
      </a>
      <ul>
        <li> <a href="{{route('dash.grade.index')}}"><i class="fadeIn animated bx bx-spreadsheet"></i>إدارة المستويات </a>
        </li>
        {{-- <li> <a href="{{route('dash.grade.create')}}"><i class="bi bi-circle"></i>  عرض الصفوف و الشُعب</a>
        </li> --}}
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-layer"></i>
        </div>
        <div class="menu-title">الشعب</div>
      </a>
<ul>
        <li> <a href="{{route('dash.section.index')}}"><i class="fadeIn animated bx bx-spreadsheet"></i> إدارة الشعب </a>
        </li>
    
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-book-half"></i>
        </div>
        <div class="menu-title">المواد الدراسية</div> 
      </a>
        <ul>
        <li> <a href="{{route('dash.subject.index')}}"><i class="bi bi-book-half"></i>جميع المواد </a>
        </li>
      </ul>
    </li>


       <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-collection-play-fill"></i>
        </div>
          <div class="menu-title">المحاضرات</div>
      </a>
<ul>
        <li> <a href="{{route('dash.lectuers.index')}}"><i class="bi bi-collection-play-fill"></i> جميع المحاضرات  </a>
        </li>
    
      </ul>
    </li>

