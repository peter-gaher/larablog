@extends('master')

@section('title', 'User list')

@section('content')

    <section class="box post-list">
        <h1 class="box-heading text-muted">Tag list</h1>

        <ul class="user-list">
            @forelse($tags as $tag)
                <li>
                    {{ $tag->tag }}
                    <a href="{{ route('tag.delete', $tag->id) }}" class="btn btn-xs edit-link">&times;</a>
                </li>
            @empty
                <li>Nemáme tagy!</li>
            @endforelse
        </ul>
        <a href="{{ route('tag.create') }}" class="btn btn-primary">Add new tag</a>
    </section>

@endsection