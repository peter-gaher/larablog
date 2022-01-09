<nav class="navigation">
    <div class="btn-group btn-group-sm pull-left">
        <a href="{{ url('/') }}" class="btn btn-default">all posts</a>
        @if (Auth::check())
            <a href="{{ url('user/'. Auth::id()) }}" class="btn btn-default">my posts</a>
            <a href="{{ url('post/create') }}" class="btn btn-default">add new post</a>
        @endif
        @can('is-admin')
            <a href="{{ url('admin/user_list') }}" class="btn btn-default">user list</a>
            <a href="{{ url('admin/tag_list') }}" class="btn btn-default">tag list</a>
        @endcan
    </div>
    <div class="btn-group btn-group-sm pull-right">
        @if (Auth::check())
            <span class="username small">{{ Auth::user()->email }}</span>
            <a href="{{ route('logout') }}" class="btn btn-default logout">logout</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-default logout">login</a>
            <a href="{{ route('register') }}" class="btn btn-default logout">register</a>
        @endif
    </div>
</nav>