@extends('admin.master')  
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
    <?php /*--- @include('common.payments.tab.iframeBalanaceSheet')*/?>
    @include('common.payments.balance.balance-sheet')


@endsection