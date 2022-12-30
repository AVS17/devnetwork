<div>
    @if ($posts->count())
    <div class="grid gap-6 mt-10 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($posts as $post)
            <div>
                <a href="{{route('posts.show', ['user' => $post->user, 'post' => $post])}}">
                    <img src="{{asset('uploads') . '/' . $post->image}}" 
                    alt="Imagen del post {{$post->title}}">
                </a>
            </div>
        @endforeach
    </div>
    <div class="my-10">
        {{$posts->links('pagination::tailwind')}}
    </div>
    @else
        <p class="text-center">No hay posts, empieza a seguir a alguien</p>
    @endif
</div>