@extends('moderator.master')  
@section('page-title')
    <?php txt("Balanace sheet"); ?>
@endsection

@section('title')
    <?php txt("Balanace sheet"); ?>
@endsection

@section('middle-content')

    @php 
    $currentUser = Auth::user();

    //echo $currentUser; 
    @endphp
    
    @include('common.clients.tab.iframeGeneralInfo') 
     


@endsection