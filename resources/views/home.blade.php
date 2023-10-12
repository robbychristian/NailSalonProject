@extends('layouts.main')

@section('content')
    @if (Auth::user()->user_role == 1)
        @include('modules.dashboard.index')
    @else
        @include('modules.booking.index')
    @endif
@endsection
