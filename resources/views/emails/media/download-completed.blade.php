@component('mail::message')

# Hello {{$media->user->first_name}},

**{{$media->title}}** is ready to watch!

<img style="width: 200px" src="http://image.tmdb.org/t/p/w500/{{$media->poster_path}}" />

If there are any problems with the movie, such as bad quality, out-of-sync audio, etc.. please report the movie here.

Thanks,<br>
Marc

@endcomponent
