@extends('vegacms::admin.layouts.app')

@section('content')
    <div class="row pr-4 pt-2">
        <div class="col-12 pr-3">
            @include('vegacms::admin.partials.errors')
            @include('vegacms::admin.menu_items._form')
        </div>
    </div>
@endsection

