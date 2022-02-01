@extends('layouts.app')

@section('content')

    <navbar-admin firstname="{{ auth()->user()->fname }}"></navbar-admin>
    <dashboard-page></dashboard-page>

@endsection

