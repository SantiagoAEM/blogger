<x-layouts.public>

    <ul class="space-y-6 mb-4">           
        
        <li>
            <article class="bg-white rounded shadow-lg">
                <img class="h-72 w-full object-fit object-center" src="{{$post->image}}" alt="Image product">
                <div class="p-4 py-2">
                    <h1 class="text-gray-800 font-bold ">
                        <a href="{{route('posts.show', $post)}}">{{$post->title}}
                        </a>
                    </h1>
                    <h4 class="text-red-500">Category: {{$post->categories}}</h4>
                    <div class="text-gray-500">
                        {{$post->content}}
                    </div>
                </div>
            </article>
        </li>

     
    </ul>

</x-layouts.public>

