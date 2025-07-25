<x-layouts.app>

       <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.categories.index')">Categories</flux:breadcrumbs.item>  
        <flux:breadcrumbs.item >Edit</flux:breadcrumbs.item>           
    </flux:breadcrumbs>

    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="POST" class="space-y-6" action="{{route('admin.categories.update', $category)}}">
            @csrf
            @method('PUT')
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Add a new category</h5>
          

            <flux:field>
                <flux:label>Name</flux:label>
                <flux:input type="text" placeholder="Namecategory" name="name" value="{{old('name', $category->name)}}"/>
                <flux:error name="name" />
            </flux:field>
         
            <div class="flex justify-end w-full">                
                <flux:button type="submit" variant="primary" color="indigo">Save</flux:button>
            </div>
            
          
        </form>
    </div> 

</x-layouts.app>