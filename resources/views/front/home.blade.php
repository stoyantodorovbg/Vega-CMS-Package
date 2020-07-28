@extends('vegacms::front.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="d-inline-block">Home Page</h1>
                    <div class="float-right">
                        <change-locale></change-locale>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to Vega CMS. You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
