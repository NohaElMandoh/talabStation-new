<!-- jQuery first, then Tether, then other JS. -->
<script type="text/javascript" src="{{asset('Dashboard-UI/main.07a59de7b920cd76b874.js.download')}}"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Select Plugin -->
<script src="{{ asset('Dashboard-UI/vendor/select/js/select2.full.min.js') }}"></script>
<!-- sweet alert -->
<script src="{{ asset('Dashboard-UI/vendor/sweetalert/js/sweetalert2.min.js') }}"></script>


<!-- Custom Javascript -->
<script src="{{ asset('custom/js/main.js') }}"></script>
<script src="{{ asset('merchant-js/custom/js/printPage.js') }}"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<!-- <script src="https://www.position-absolute.com/creation/print/jquery.printPage.js" type="text/javascript"></script> -->

<!-- <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script> -->
<script>
//    ----add editor to ticket form-----
    var content;

	ClassicEditor
		.create(document.querySelector('#content'), {
			language: 'ar',
        })
        .then( editor => {
            console.log( 'Editor was initialized', editor );
            content = editor;
        } )
		.catch(error => {
			console.error(error);
		});
</script>
<script type="text/javascript">
    //token for ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

    });
    // var base_url = "{!! json_encode(url('/')) !!}";
    var base_url = '{{url("/")}}';
    $(function() {
        $('select').select2();

        $('.close').click(function() {
            $('.bg-secondary-errors').fadeOut();
        });
    });
</script>
@if(session('success'))
<style type="text/css">
    .swal2-popup .swal2-content {
        display: none;
    }
</style>
<script>
    Swal.fire({
        position: 'top-middle',
        type: 'success',
        title: "{{session('success')}}",
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif