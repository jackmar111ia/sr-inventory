@extends('admin.master')

@section('page-title')
 No Permission 
@endsection

@section('title')
No Permission 
@endsection
@section('middle-content')
  
 
<div class="alert label-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 </button>
	You are not permitted for this action!
</div>

@endsection