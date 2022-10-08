<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12 w-full">
        <x-success-status class="mb-4 ml-40" :status="session('message')" />
        <x-danger-status class="mb-4 ml-40" :status="session('error')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                    <div class="flex p-2">
                        <a href="{{ url('/projects') }}" class="px-4 py-2 bg-green-700 hover:bg-green-500 text-white rounded-md">Listar Proyectos</a>
                    </div>
                <div class="flex flex-col p-2 bg-slate-100">
               <div>Nombre Proyecto: {{ $projects->name}}</div>
               <div>Descripcion: {{ $projects->description }}</div>
            </div>
            <div class="mt-6 p-2 bg-slate-100">
                <h2 class="text-2xl font-semibold">Usuarios Asignados:</h2>
                <div class="flex space-x-2 mt-4 p-2">
                    @foreach ($projects_user as $projects_user)
                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" 
                            method="POST" 
                            action="{{ url('/projects_user-delete/'.$projects_user->id) }}" 
                            onsubmit="return confirm('Revocar Usuario?');">
                             @csrf
                             @method('DELETE')
                             <button type="submit" style="font-size:15px">{{ $projects_user->user->name }}<i class="fa-regular fa-circle-xmark"></i></button>
                         </form>
                    @endforeach
                </div>
                <div class="max-w-xl mt-6">
                    <form method="POST" action="{{ url('/projects_user') }}">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                <div class="sm:col-span-6">
                                    <label for="user_id" class="block text-sm font-medium text-gray-700">Usuarios</label>
                                    <select id="user_id" name="user_id" autocomplete="user_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($users as $users)
                                            <option value="{{ $users->id }}">{{ $users->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                        
                            </div>
                                <div class="sm:col-span-6 pt-5">
                                    <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded-md">Asignar</button>
                                </div>
                    </form>
                </div>
            </div> 
        </div>
        </div>
    </div>
</x-app-layout>
