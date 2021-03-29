@extends('layouts.app', ['page_title' => $page_title ?? null])

@section('body')
{{$slot}}
@endsection
