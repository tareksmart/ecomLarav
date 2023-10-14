{{-- sidebar menu --}}
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           @foreach ($items as $item)
           <li class="nav-item">
            {{--Route::is لفحص الروت اللى احنا فيه هل هو اللى اتجاب من ملف الكونفيج مثل اللى احنا حاليا فيه--}}
             <a href="{{route($item['route'])}}" class="nav-link {{Route::is($item['active'])?'active':''}}">
               <i class="{{$item['icon']}}"></i>
               <p>
                {{$item['title']}}
                @if (isset($item['badge'])){{--فحص عن وجود مفتاح اسمه badge--}}
                <span class="right badge badge-danger">{{$big}}</span>
                @endif
                
               </p>
             </a>
           </li>
           @endforeach
  
    </ul>
  </nav>
  {{-- end sidebar menu --}}