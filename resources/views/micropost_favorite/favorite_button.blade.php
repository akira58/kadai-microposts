@if (Auth::id() != $user->id)
    @if (Auth::user()->is_favoring($user->id))
        {!! Form::open(['route' => ['micropost.unfavorite', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-xs"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['micropost.favorite', $user->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-xs"]) !!}
        {!! Form::close() !!}
    @endif
@endif

<!--microposts.destroy', $micropost->id], 'method' => 'delete