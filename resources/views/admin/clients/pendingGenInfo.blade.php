@extends('admin.master')  
@section('page-title')
    <?php txt("Clients Update List"); ?>
@endsection

@section('title')
    <?php txt("Clients Update List"); ?>
@endsection

@section('middle-content')

    @php 
    $currentUser = Auth::user();

    //echo $currentUser; 
    @endphp
    
    @include('common.clients.tab.iframeGeneralInfo') 
     


@endsection