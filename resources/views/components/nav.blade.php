{{-- sidebar menu --}}
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           @foreach ($items as $item)
           <li class="nav-item">
             <a href="{{route($item['route'])}}" class="nav-link">
               <i class="{{$item[icon]}}"></i>
               <p>
                {{$item['title']}}
                 <span class="right badge badge-danger">New</span>
               </p>
             </a>
           </li>
           @endforeach
  
    </ul>
  </nav>
  {{-- end sidebar menu --}}