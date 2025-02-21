@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2 class="fw-bold text-center">🎉 Chào mừng đến Dashboard!</h2>
    <p>Chào mừng {{ $user->name }}!</p>

</div>
@endsection
