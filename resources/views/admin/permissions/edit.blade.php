<x-admin-layout>


    <div class="py-12 w-full">
        <x-success-status class="mb-4 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                    
                <div class="flex flex-col p-2 bg-slate-100">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                        @csrf
                        @method('PUT')
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Nombre de Permiso </label>
                                    <div class="mt-1">
                                        <input type="text" 
                                        id="name" 
                                        name="name" 
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" 
                                        value="{{ $permission->name }}"/>
                                    </div>
                                    @error('name') <span class="text-red-400 tex-sm">{{ $message }}</span> @enderror
                                    <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Permiso </label> 
                                <select id="" name="" autocomplete="" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        
                                        <option value=""> Crear </option>
                                        <option value=""> Leer </option>
                                        <option value=""> Modificar </option>
                                        <option value=""> Eliminar </option>
                                    
                                </select>
                            </div>
                        </div>
                            
                             <div class="sm:col-span-6 pt-5">
                             <a href="{{ route('admin.permissions.index') }}" class="px-4 py-2 bg-blue-700 hover:bg-blue-500 text-white rounded-md">Volver</a>
                    
                                 <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-md">Actualizar</button>
                             </div>
                    </form>
                </div>
            </div>
            
        </div>
        </div>
    </div>
</x-admin-layout>
