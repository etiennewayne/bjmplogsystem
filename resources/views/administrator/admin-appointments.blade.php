@extends('layouts.app')

@section('content')

    <navbar-admin firstname="{{ auth()->user()->fname }}"></navbar-admin>
    <admin-appointments></admin-appointments>

@endsection

