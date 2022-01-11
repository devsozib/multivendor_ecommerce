
<!-- Javascript -->
<script src="{{ asset('backend/assets/bundles/libscripts.bundle.js') }}"></script>    
<script src="{{ asset('backend/assets/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/chartist.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/knob.bundle.js') }}"></script> <!-- Jquery Knob-->
<script src="{{ asset('backend/assets/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
//Summernote
<script src="{{ asset('backend/assets/summernote-0.8.18-dist/summernote.js') }}"></script>
<script src="{{ asset('backend/assets/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/assets/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script> 
<script src="{{ asset('backend/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery-datatable.js') }}"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>

@yield('scripts')
<script>
    setTimeout(() => {
        $('#alert').slideUp();
    }, 4000);
</script>
