<!DOCTYPE html>
<html>
  <head>

    @include('admin.layouts.css')

  </head>
  <body>

    @include('admin.layouts.header')

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
     @include('admin.layouts.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Dashboard</h2>
              </div>
            </div>

              @yield('content')


              @include('admin.layouts.footer')

        </div>
      </div>

      @include('admin.layouts.script')

  </body>
</html>
