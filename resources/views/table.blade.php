
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}">
    @yield('layout-header')
@endsection

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            @yield('table-head')
            <a class="btn btn-primary float-right" href="{{\Request::url()}}/create">
                Add
            </a>
            <div class="clearfix"></div>
        </div>

        <table>
            @yield('table-content')
        </table>

        <div class="mt-4">
            {{ $list->links() }}
        </div>
    </div>

    <link rel="stylesheet" href="{{ URL::asset('css/sections.css') }}">
@endsection
