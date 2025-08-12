<x-layouts.app>

    <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.tags.index')">Tags</flux:breadcrumbs.item>            
        </flux:breadcrumbs>
        <a href="{{route('admin.tags.create')}}"><flux:button variant="primary" color="indigo" class="text-xs">New</flux:button></a>
    </div>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3">
                      
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)                 
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$tag->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$tag->name}}
                        </td>
                        <td class="px-6 py-4 text-right">
                             <div class="flex items-center justify-end space-x-4"> 
                                <a href="{{route('admin.tags.edit', $tag)}}" class="font-medium text-blue-600 dark:text-sky-300 hover:underline px-5"><flux:icon.pencil-square/></a>
                                
                                <form class="delete-form" action="{{ route('admin.tags.destroy', $tag) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500  dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        <flux:icon.x-mark/>
                                    </button>
                                    
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('jss')
        <script>
            forms= document.querySelectorAll('.delete-form');
            forms.forEach(form => {
                form.addEventListener('submit',(e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                        
                        }).then((result) => {

                            if (result.isConfirmed) {
                            form.submit();
                            }
                        });
                })
            });

           
        </script>
    @endpush

</x-layouts.app>