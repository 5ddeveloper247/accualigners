
<script>

    $(document).ready(function() {

        @if(session()->has('infoMessage'))
            toastr.info("{{session('infoMessage')}}", "Info!", {
                positionClass: "toast-bottom-left",
                containerId: "toast-bottom-left"
            });
            @php(session()->remove('infoMessage'))
        @endif

        @if(isset($errors) && !empty($errors) && !empty($errors->first()))
            toastr.error("{{$errors->first()}}", "Error!", {
                positionClass: "toast-bottom-left",
                containerId: "toast-bottom-left"
            });
        @endif

        @if(session()->has('errorMessage'))
            toastr.error("{{session('errorMessage')}}", "Error!", {
                positionClass: "toast-bottom-left",
                containerId: "toast-bottom-left"
            });
            @php(session()->remove('errorMessage'))
        @endif

        @if(session()->has('warningMessage'))
            toastr.warning("{{session('warningMessage')}}", "Warning!", {
                positionClass: "toast-bottom-left",
                containerId: "toast-bottom-left"
            });
            @php(session()->remove('warningMessage'))
        @endif

        @if(session()->has('successMessage'))
            toastr.success("{{session('successMessage')}}", "Success!", {
                positionClass: "toast-bottom-left",
                containerId: "toast-bottom-left"
            });
            @php(session()->remove('successMessage'))
        @endif

    });

</script>
