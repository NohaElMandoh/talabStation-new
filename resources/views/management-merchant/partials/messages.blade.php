@if(session('success'))
<!-- <script>
Swal.fire({
  position: 'top-end',
  type: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
})
</script> -->
<!-- <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>{{ session('success') }}</strong>
</div> -->
@endif

@if($errors->any())
<div class="card text-white bg-secondary bg-secondary-errors">
  <div class="card-body">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul class="list-unstyled">
    	@foreach($errors->all() as $error)
    	<li>{{ $error }}</li>
    	@endforeach
    </ul>
  </div>
</div>
@endif