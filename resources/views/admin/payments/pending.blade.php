@extends('admin.master')  
@section('page-title')
    <?php txt("Pending Payments List"); ?>
@endsection

@section('title')
    <?php txt("Pending Payments List"); ?>
@endsection

@section('middle-content')
    @php 
    $currentUser = Auth::user();
    //echo $currentUser;  
  
    @endphp
    
    @include('common.payments.tab.iframePending')


@endsection