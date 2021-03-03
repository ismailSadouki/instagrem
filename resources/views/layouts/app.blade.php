<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('layouts.header')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
              <h1 class="jumbotron-heading"></h1>
              <p class="lead text-muted">قم بمشاركة جميع صورك وفيديوهاتك أنت وأصدقائك من خلال شبكة انستغرام حسوب</p>
              <p style="direction: rtl;">
                <a href="{{url('home')}}" class="btn btn-{{ isset($active_home) ? $active_home : 'secondary' }} my-2">الرئيسية</a>
                <a href="{{url('user/followers')}}" class="btn btn-{{ isset($active_follow) ? $active_follow : 'secondary' }} my-2">المتابعين</a>
                <a href="{{url('users')}}" class="btn btn-{{ isset($active_user) ? $active_user : 'secondary' }} my-2">المستخدمين</a>
                <a href="{{url('user/Posts')}}" class="btn btn-{{ isset($active_profile) ? $active_profile : 'secondary' }} my-2">الملف الشخصي</a>
              </p>
            </div>
        </section>    
        @yield('content')
    </main>
    @include('layouts.footer')

  <!-- toastr -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
      @if(Session::has('messege'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                 toastr.info("{{ Session::get('messege') }}");
                 break;
            case 'success':
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning':
               toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('messege') }}");
                break;
        }
      @endif
    </script>  
</html>