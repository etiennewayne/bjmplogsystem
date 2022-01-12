@extends('layouts.app')

@section('content')

    <navbar-component firstname="{{ auth()->user()->fname }}"></navbar-component>
    <dashboard-page></dashboard-page>

@endsection

