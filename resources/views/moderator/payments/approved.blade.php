@extends('moderator.master')  
@section('page-title')
    <?php txt("Approved Payments List"); ?>
@endsection

@section('title')
    <?php txt("Approved Payments List"); ?>
@endsection

@section('middle-content')
    @php 
    $currentUser = Auth::user();
    //echo $currentUser; 
    @endphp
    @include('common.payments.tab.iframeApproved')


@endsection