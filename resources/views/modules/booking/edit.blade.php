@extends('layouts.main')
@section('title', '| Edit Booking')
@section('content')
    <div id="edit-booking" data-auth="{{ Auth::user() }}" 
    data-booking="{{ $booking }}"
    data-serviceType1="{{ $serviceIdArr[0] }}"
    data-serviceType2="{{ $serviceIdArr[1] ?? '' }}"
    data-serviceType3="{{ $serviceIdArr[2] ?? '' }}"
    >
    </div>
@endsection
