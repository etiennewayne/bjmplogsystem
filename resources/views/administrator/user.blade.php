@extends('layouts.app')

@section('content')

    <navbar-admin firstname="{{auth()->user()->fname}}"></navbar-admin>
    <user-page></user-page>

@endsection

