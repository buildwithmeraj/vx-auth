@extends('layouts.app')
@section('title', 'Register')
@section('content')
    @include("auth.register.step" . $step)
    @dump($data)
    @dump($step)
@endsection
