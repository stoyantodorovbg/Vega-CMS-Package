@extends('vegacms::admin.layouts.app')

@section('content')
    <model-index :model_name="'\\Vegacms\\Cms\\Models\\Group'"
                 :actions="{
                        'show': 1,
                        'edit': 0,
                        'delete': 1
                    }"
    ></model-index>
@endsection

