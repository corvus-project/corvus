@extends('layouts.app')

@section('content')
<div class="welcome">
    <div class="row justify-content-center align-items-center mt-4">
        <div class="col col-sm-8 align-self-center text-center">
            <img src="{{ 'img/welcome.svg' }}" alt="" width="500px">
            <p>
                <a class="btn btn-lg btn-primary" href="{{ route('login') }}"><strong>Login to backoffice</strong></a>
            </p>
        </div>
    </div>
</div>
@endsection