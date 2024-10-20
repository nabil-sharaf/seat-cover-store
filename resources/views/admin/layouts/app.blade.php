@include('admin.layouts.head')

@include('admin.layouts.navbar')

@include('admin.layouts.main_sidebar')

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('page-title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">لوحة التحكم</a></li>
              <li class="breadcrumb-item active">@yield('page-title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @yield('content')
        @isset($slot)
        {{$slot}}
        @endisset
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @include('admin.layouts.footer')
