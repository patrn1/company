
@extends('table', [ 'list' => $userList ])

@section('table-head')
    {{ __('users.user') }}
@endsection

@section('table-content')
    @foreach ($userList as $user)
        <tr>
            <td class="user-list__name-col">
                {{ $user->name }}
            </td>
            <td class="user-list__email-col">
                {{ $user->email }}
            </td>
            <td class="user-list__date-col">
                {{ $user->created_at }}
            </td>
            @include('table-buttons', [ 'item' => $user ])
        </tr>
    @endforeach
@endsection
