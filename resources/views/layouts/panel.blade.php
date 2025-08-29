<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('images/favicon1.png') }}">
  
  <title>@yield('title', 'Panel')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>

  <!-- Sweetalert2 & Select2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- FilePond -->
  <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />

  <!-- Vite -->
  @vite(['resources/css/panel.css', 'resources/js/panel.js'])

  <!-- Child Styles -->
  @stack('styles')
</head>
<body>
  <!-- Page Loader -->
  <div id="page-loader">
    <div class="spinner"></div>
  </div>

  <!-- Sidebar -->
  @include('partials.sidebar')

  <!-- Main Content -->
  <div class="main-content d-flex flex-column" id="mainContent">
    <!-- Topbar -->
    @include('partials.topbar')

    <!-- Page Content -->
    <div class="container-fluid px-4 flex-grow-1">
      @yield('content')
    </div>

    <!-- Footer -->
    <footer class="mt-auto">
      &copy; {{ date('Y') }} Laravel. All rights reserved.
    </footer>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
  <script>
    window.logoLight = "{{ asset('images/logo1.png') }}";
    window.logoDark = "{{ asset('images/logo2.png') }}";

    function getLoader(submitBtnText = 'Saving...') {
      return `<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>
        <span role="status">${submitBtnText}</span>`;
    }

    function confirmAction(formId, title = "Are you sure?", confirmText = "Yes, proceed!") {
      const form = document.getElementById(formId);
      if (!form) return;

      Swal.fire({
        title: title,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmText,
        customClass: {
          popup: 'swal-popup-size'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    }

    const deleteItem = (id) => confirmAction(`delete-${id}`, "Are you sure?", "Yes, delete it!");
    const approveItem = (id) => confirmAction(`approve-${id}`, "Are you sure?", "Yes, approve it!");

    $(document).ready(function() {
        $('.select2').select2({
          theme: 'default',
          width: 'resolve',
          minimumResultsForSearch: Infinity,
        });
    });

    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.create(document.querySelector('.filepond'), {
      allowImagePreview: true,
      imagePreviewHeight: 150,
      labelIdle: 'Drag & Drop your image or <span class="filepond--label-action">Browse</span>',
    });

    @if(session('success') || session('error') || session('warning'))
    window.addEventListener('DOMContentLoaded', function () {
      const toastType = @json(session()->has('success') ? 'success' : (session()->has('error') ? 'error' : 'warning'));
      const toastMessage = @json(session('success') ?? session('error') ?? session('warning'));

      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: toastType,
        title: toastMessage,
        showConfirmButton: false,
        timer: 5000,
        customClass: {
          popup: 'toast-popup-size'
        }
      });
    });
    @endif
  </script>

  <!-- Child Scripts -->
  @stack('scripts')
</body>
</html>
