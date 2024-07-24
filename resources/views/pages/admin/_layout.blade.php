<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }} - {{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/blue/pace-theme-flash.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-select/css/select.bootstrap4.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  @vite([])
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css"> --}}
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
  @if (!empty($form_action))
    <form action="{{ $form_action }}" method="POST">
      @csrf
  @endif
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- @if (!empty($back_button_link))
          <li class="nav-item">
            <a class="nav-link" href="{{ $back_button_link }}" class="btn"><i class="fas fa-arrow-left"></i></a>
          </li>
        @endif --}}
        <li class="nav-link">
          <h5 style="cursor:default;">
            @if (!empty($title))
              <span class="mr-2">
                {{ $title }}
              </span>
            @endif
          </h5>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        @yield('right-menu')
      </ul>
    </nav>
    @include('pages.admin._sidebar')
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          @yield('content')
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">{{ env('APP_NAME') . ' v' . env('APP_VERSION_STR') }}</div>&copy;
      Shiftech 2024 - <a href="https://shiftech.my.id" title="Shiftech">www.shiftech.my.id</a>
    </footer>
  </div>
  @if (!empty($form_action))
    </form>
  @endif
  @yield('modal')
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/pace-progress/pace.min.js') }}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  {{-- <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-select/js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-select/js/select.bootstrap4.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table-locale-all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/extensions/export/bootstrap-table-export.min.js"> --}}
  <script src="{{ asset('assets/js/helper.js') }}"></script>
  @yield('footscripts')
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <script>
    INPUTMASK_OPTIONS = {
      groupSeparator: '.',
      radixPoint: ',',
      allowMinus: true,
      inputtype: "text"
    };

    DATE_FORMAT = 'DD-MM-YYYY';
    DATETIME_FORMAT = 'DD-MM-YYYY HH:mm:ss';
    // DATATABLES_OPTIONS = {
    //   responsive: {
    //     details: {
    //       type: 'none'
    //     }
    //   },
    //   language: {
    //     url: '{{ asset('plugins/datatables/id.json') }}'
    //   },
    //   paging: true,
    //   length: 10,
    //   "ordering": true,
    //   "info": true,
    //   "responsive": true,
    // };

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    @if ($info = Session::get('info'))
      toastr["info"]('{!! $info !!}');
    @endif
    @if ($warning = Session::get('warning'))
      toastr["warning"]('{!! $warning !!}');
    @endif
    @if ($error = Session::get('error'))
      toastr["error"]('{!! $error !!}');
    @endif
  </script>
  @yield('footscript')
  <script type="text/javascript">
    setInterval(function() {
      $.get('{{ url('admin/refresh-csrf') }}').done(function(data) {
        $('[name="csrf-token"]').attr('content', data)
      });
    }, 60 * 60 * 1000);

    $(document).on('select2:open', () => {
      document.querySelector('.select2-search__field').focus();
    });
  </script>
</body>

</html>
