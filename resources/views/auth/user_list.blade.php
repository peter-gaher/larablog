@extends('master')

@section('title', 'User list')

@section('content')

    <section class="box post-list">
        <h1 class="box-heading text-muted">User list</h1>

        <ul class="user-list">
            @forelse($users as $user)
                <li>
                    {{ $user->email }}
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-xs edit-link">edit</a>
                    <a href="{{ route('user.delete', $user->id) }}" class="btn btn-xs edit-link">&times;</a>
                </li>
            @empty
                <li>Nemáme užívateľov!</li>
            @endforelse
        </ul>
        <a href="{{ route('user.create') }}" class="btn btn-primary">Add new user</a>
    </section>

@endsection