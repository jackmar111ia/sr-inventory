@extends('admin.master')  
@section('page-title')
    <?php txt("Approved Clients List"); ?>
@endsection

@section('title')
    <?php txt("Approved Clients List"); ?>
@endsection

@section('middle-content')
 
@php 
$currentUser = Auth::user();
//echo $currentUser; 
@endphp
    @include('common.clients.tab.iframeApproved')


@endsection