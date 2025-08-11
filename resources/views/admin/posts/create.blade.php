<x-layouts.app>

    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.posts.index')">Post</flux:breadcrumbs.item>  
        <flux:breadcrumbs.item >New</flux:breadcrumbs.item>           
    </flux:breadcrumbs>

    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="POST" class="space-y-6" action="{{route('admin.posts.store')}}">
            @csrf
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Add a new post</h5>
          

            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input type="text" placeholder="PostTitle" id="title" name="title" value="{{old('title')}}" oninput="string_to_slug(this.value,'#slug')" />
                <flux:error name="title" />

                 <flux:label>Slug</flux:label>
                <flux:input type="text" id="slug" name="slug" value="{{old('slug')}}"/>
                <flux:error name="slug" />

                <flux:label>Category</flux:label>
                <flux:select size="sm" placeholder="Choose category..." name="category_id">
                    @foreach ($categories as $category)
                       <flux:select.option value="{{$category->id}}">{{$category->name}}</flux:select.option> 
                    @endforeach   
                </flux:select>
              
            </flux:field>
            
         
            <div class="flex justify-end w-full">                
                <flux:button type="submit" variant="primary" color="indigo">Add</flux:button>
            </div>
            
          
        </form>
    </div>

</x-layouts.app>