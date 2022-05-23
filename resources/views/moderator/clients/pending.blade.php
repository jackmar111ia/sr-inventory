@extends('moderator.master')  
@section('page-title')
    <?php txt("Pending Clients List"); ?>
@endsection

@section('title')
    <?php txt("Pending Clients List"); ?>
@endsection

@section('middle-content')
    @php 
    $currentUser = Auth::user();
    //echo $currentUser; 
    @endphp
    
    @include('common.clients.tab.iframePending')


@endsection