
@extends('table', [ 'list' => $sectionList ])

@section('layout-head')
    <link rel="stylesheet" href="{{ URL::asset('css/sections.css') }}">
@endsection

@section('table-head')
    {{ __("sections.section") }}
@endsection

@section('table-content')
    @foreach ($sectionList as $section)
        <tr>
            <td class="section-list__logo-column">
                <img
                    class="section-logo"
                    @if($section->logo)
                        src="/logo/{{ $section->logo }}"
                    @else
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRm5w5_bWf62YewNLkpaX5Wgk9Y2xxRqkwzeGGILtY81llS-yaE"
                    @endif
                >
            </td>
            <td class="section-list__name-column">
                <div><b>{{ $section->name }}</b></div>
                <div>{{ $section->description }}</div>
            </td>
            <td class="section-list__users-column">
                <div><b>{{ __('sections.users') }}:</b></div>
                @foreach ($section->users as $user)
                    <div>{{ $section->index }}. {{ $user->name }}</div>
                @endforeach
            </td>
            @include('table-buttons', [ 'item' => $section ])
        </tr>
    @endforeach
@endsection


