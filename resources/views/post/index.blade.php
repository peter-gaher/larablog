@extends('master')

@section('title', isset($title) ? $title : 'All post')

@section('content')

    <section class="box post-list">
        <h1 class="box-heading text-muted">
            {{ $title or 'Blog'}}
        </h1>

        @forelse($posts as $post)
            <article id="post-{{ $post->id }}" class="post">
                <header class="post-header">
                    <h2>
                        <a href="{{ route('post.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                        <time datetime="{{ $post->datetime }}">
                            <small>/ {{ $post->created_at }}</small>
                        </time>
                    </h2>
                    @include('partials.tags')
                </header>
                <div class="post-content">
                    <p>
                        {{ $post->teaser }}
                    </p>
                </div>
                <footer class="post-footer">
                    <a href="{{ route('post.show', $post->slug) }}" class="read-more">
                        read more
                    </a>
                    <p class="written-by small">
                        <small>- written by
                            <a href="{{ url('user', $post->user_id) }}">{{ $post->user->email }}</a>
                        </small>
                    </p>
                </footer>
            </article>
        @empty
            <p>Nemáme príspevky!</p>
        @endforelse
    </section>

@endsection