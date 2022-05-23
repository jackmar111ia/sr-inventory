	<script type="text/javascript">
	   $(document).ready( function () {
	      $('.table').DataTable();
	   } );
	</script>


	 <script type="text/javascript">
	   $(document).ready(function() {
	     $('.summernote').summernote();
	   });
	</script>

	<script>
	   //redirect to specific tab
	   $(document).ready(function () {
	      $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
	   });
	</script>


