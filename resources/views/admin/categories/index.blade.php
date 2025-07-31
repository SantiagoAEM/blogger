<x-layouts.app>
    <div class="mb-4 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.categories.index')">Categories</flux:breadcrumbs.item>            
        </flux:breadcrumbs>
        <a href="{{route('admin.categories.create')}}"><flux:button variant="primary" color="indigo" class="text-xs">New</flux:button></a>
    </div>

@if (session('success'))
    <div x-data="{ show: true }" 
        x-show="show" 
        x-transition:leave.duration.500ms
        x-init="setTimeout(() => show = false, 3000)"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" 
        role="alert"
    >
        <strong class="font-bold">¡Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"> {{-- Añade @click --}}
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
@endif

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
                @foreach ($categories as $category)                 
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$category->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$category->name}}
                        </td>
                        <td class="px-6 py-4 text-right">
                             <div class="flex items-center justify-end space-x-4"> 
                                <a href="{{route('admin.categories.edit', $category)}}" class="font-medium text-blue-600 dark:text-sky-300 hover:underline px-5"><flux:icon.pencil-square/></a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta categoría?');">
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
</x-layouts.app>