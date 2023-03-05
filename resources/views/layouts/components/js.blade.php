    <!-- Dashmix JS -->
    <script src="{{ asset('assets/dashmix/src/assets/js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>

    <!-- Plugin JS -->
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.j') }}s"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/dashmix/src/assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="{{ asset('assets/dashmix/src/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
      Dashmix.helpersOnLoad([
        'jq-select2',
        'jq-magnific-popup',
        'jq-datepicker',
        'js-flatpickr'
      ])
    </script>

    @include('sweetalert::alert')
    @stack('javascript')
    @include('layouts.components.alert')