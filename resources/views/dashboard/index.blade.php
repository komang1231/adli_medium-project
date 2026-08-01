@extends('layouts.app')

@section('content')

@include('dashboard.partials.cards')

@include('dashboard.partials.daily-chart')

@if($role !== 'Staff')
    @include('dashboard.partials.yearly-chart')
@endif

@endsection