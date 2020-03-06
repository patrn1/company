
@extends('form', [ 'yAlign' => false ])

@section('form-head')
    <script src="/js/form.js"></script>
@endsection

@section('form-content')
    <div>
        <div class="form-head pl-0">{{ __("section-edit.section") }}</div>

        <form enctype="multipart/form-data" method="post" action="{{$path}}">
            @csrf
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{{ __("section-edit.name") }}</label>
                <input
                    required
                    name="name"
                    class="col-sm-8 form-control"
                    placeholder="Enter name"
                    value="{{$section->name}}"
                >
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{{ __("section-edit.description") }}</label>
                <textarea
                    name="description"
                    class="col-sm-8 form-control"
                    placeholder="Enter description"
                >{{$section->description}}</textarea>
            </div>

            <div class="form-head pl-0">{{ __("section-edit.logo") }}</div>

            <div class="row">
                <div class="col-12">
                    <div class="custom-file form-group">
                        <label class="custom-file-label">
                            {{ __("section-edit.select-file") }}
                        </label>
                        <input
                            type="file"
                            name="logo"
                            class="custom-file-input col-sm-12 form-control"
                            placeholder="Select file"
                        >
                    </div>
                </div>
            </div>

            @foreach ($userList as $user)
                <div class="mt-3 cursor-pointer">
                    <label>
                        <input
                            @if($section->users->contains($user->id))
                                checked
                            @endif
                            name="users[{{ $user->id }}]"
                            class="mr-2"
                            type="checkbox"
                        >
                        {{ $user->name }}
                    </label>
                    <a href="mailto:{{ $user->email }}" target="_top">{{ $user->email }}</a>
                </div>
            @endforeach

            <button class="btn btn-primary mt-3 mb-5" type="submit">{{ __("section-edit.send") }}</button>
        </form>
    </div>
@endsection
