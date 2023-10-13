<div>
    {{-- {{$titulo}} --}}
    {{-- <h1>{{$slot}}</h1> --}}
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg-grid-cols-3 xl:grid-cols-6 gap-6">
        @foreach ($posts as $post)
            <div>
                <a href="{{route('posts.show',['post' => $post,'user'=> $post->user])}}">
                    <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                </a>
            </div>
        @endforeach
    </div>
    <div class="my-10">
        {{$posts->links("pagination::simple-tailwind")}}
    </div>
@else
    <p class="text-center">NO hay posts, sigue a alguin para poder mostar sus posts</p>
@endif


{{-- @forelse ($posts as $post)
    <h1>{{$post->titulo}}</h1>
@empty
    <p>NO hay posts</p>
@endforelseeste codigo se simplifica con la directiva forelse
--}}
</div>
