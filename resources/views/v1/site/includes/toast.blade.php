<script type="text/javascript">
    $(document).ready(function() {
        @if(session()->has('notifications.message'))
        $('#toast-container').remove();
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-full-width",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        var type = "{{ session()->get('notifications.alert_type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ session()->get('notifications.message') }}");
                break;

            case 'warning':
                toastr.warning("{{ session()->get('notifications.message') }}");
                break;

            case 'success':
                toastr.success("{{ session()->get('notifications.message') }}");
                break;

            case 'error':
                toastr.error("{{ session()->get('notifications.message') }}");
                break;
        }
        @endif
        {{session()->forget('notifications')}}
    });
</script>
