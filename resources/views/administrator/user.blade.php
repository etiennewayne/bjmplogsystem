@extends('layouts.app')

@section('content')

    <navbar-component firstname="{{auth()->user()->fname}}"></navbar-component>
    <user-page></user-page>

@endsection

