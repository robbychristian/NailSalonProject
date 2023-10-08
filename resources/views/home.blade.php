@extends('layouts.main')

@section('content')
    @if (Auth::user()->user_role == 1)
    @else
        @include('modules.booking.index')
    @endif
@endsection
