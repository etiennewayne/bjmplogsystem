@extends('layouts.app')

@section('content')
    <welcome-page prop-user="{{ Auth::user() }}"></welcome-page>

@endsection
