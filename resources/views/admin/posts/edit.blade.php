<x-layouts.app>

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.posts.index')">Post</flux:breadcrumbs.item>  
        <flux:breadcrumbs.item >Edit</flux:breadcrumbs.item>           
    </flux:breadcrumbs>

    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="POST" class="space-y-6" action="{{route('admin.posts.update',$post)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Edit post</h5>

      
               <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">

                        @if ($post->image_path)
                            <img id="imgPreview" class="w-auto h-80 mt-13" src="{{ Storage::url($post->image_path) }}" alt="post image">
                        @else
                            <img id="imgPreview" class="w-auto h-80 mt-13 mb-4 hidden " src="#" alt="Preview">
                            <div id="svgImage" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                    />
                                </svg>
                       

                                <p class="mb-2 mt-3 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload image</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                        @endif
                    </div>
                    <input id="dropzone-file" type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event, '#imgPreview')""/>
                </label>
            </div>  

            <flux:field class="mt-18">
                <flux:label>Title</flux:label>
                <flux:input type="text" placeholder="PostTitle" id="title" name="title" value="{{old('title',$post->title)}}" />
                <flux:error name="title" />

                 <flux:label>Slug</flux:label>
                <flux:input type="text" id="slug" name="slug" value="{{old('slug',$post->slug)}}"/>
                <flux:error name="slug" />

                <flux:label>Category</flux:label>
                <flux:select size="sm" placeholder="Choose category..." name="category_id">
                    @foreach ($categories as $category)
                       <flux:select.option value="{{$category->id}}" :selected="$category->id==old('category_id',$post->category_id)">{{$category->name}}</flux:select.option> 
                    @endforeach   
                </flux:select>

                <flux:textarea label="Resume" name="excerpt">
                    {{old('excerpt',$post->excerpt)}}
                </flux:textarea>

                {{-- <flux:textarea label="Content" name="content" rows="12">
                    
                </flux:textarea> --}}
                </flux:field>

                <!-- Create the editor container -->
                <div>
                    <p class="font-medium mb-1">
                        Content
                    </p>
                    <div id="editor">{!! old('content',$post->content)!!}</div>
                    <textarea  class="hidden" name="content" id="content" >{{old('content',$post->content)}}</textarea>
                        
                </div>
               

            

            <flux:label>Tags</flux:label>

                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                                    @checked(in_array($tag->id, old('tags',$post->tags->pluck('id')->toArray())))
                                >
                                 {{-- <input type="checkbox" name="tags[]" value="{{$tag->id}}" @checked($post->tags->contains($tag->id))> Manera mas facil--}}
                                     <span>{{$tag->name}}</span>
                            </label>
                        </li>
                        
                    @endforeach
                </ul>

            <flux:field>

                <label for="is_published" class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" class="sr-only peer" @checked(old('is_published',$post->is_published) == 1) value="1")>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Published</span>
                </label>      
            </flux:field> 

         
            <div class="flex justify-end w-full">                
                <flux:button type="submit" variant="primary" color="indigo">Save</flux:button>
            </div>
            
          
        </form>
    </div>

      @push('cs')

        <!-- Include stylesheet -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        
    @endpush
    @push('jss')
  
        <script>
            function previewImage(event, querySelector){
                let input = event.target;
                let imgPreview = document.querySelector(querySelector);
                let svgImage = document.querySelector("#svgImage");

                if (!input.files.length) return;

                let file = input.files[0];
                let objectURL = URL.createObjectURL(file);

                imgPreview.src = objectURL;
                imgPreview.classList.remove("hidden"); // <-- Mostrar si estaba oculto
                svgImage.classList.add("hidden");
            }
        </script>
    @endpush

    @push('jss')
        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        quill.on('text-change', function(){
            document.querySelector('#content').value = quill.root.innerHTML;
        });
        </script>

    @endpush

</x-layouts.app>