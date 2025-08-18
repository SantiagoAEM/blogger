<x-layouts.public>

    <ul class="space-y-6 mb-4">
        @foreach ($posts as $post)
            
        
        <li>
            <article class="bg-white rounded shadow-lg">
                <img class="h-72 w-full object-fit object-center" src="{{$post->image}}" alt="Image product">
                <div class="p-4 py-2">
                    <h1 class="text-gray-800 font-bold ">
                        <a href="{{route('posts.show', $post)}}">{{$post->title}}
                        </a>
                    </h1>
                    <div class="text-gray-500">
                        {{$post->excerpt}}
                    </div>
                </div>
            </article>
        </li>

        @endforeach
    </ul>
    <div class="mt-2 ">
        {{$posts->links()}} {{-- paginacion --}}
    </div>
</x-layouts.public>