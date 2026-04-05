@extends('layouts.app')
@section('title', 'Register')
@section('content')
    @include("auth.register.step" . $step)
@endsection
