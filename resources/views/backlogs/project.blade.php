<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignar Proyecto') }}
        </h2>
    </x-slot>

    <div class="py-12 w-full">
        <x-success-status class="mb-4 ml-40" :status="session('message')" />
        <x-danger-status class="mb-4 ml-40" :status="session('error')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                    
                <div class="flex flex-col p-2 bg-slate-100">
               <div>Nombre Backlog: {{ $backlogs->name}}</div>
               <div>Descripcion: {{ $backlogs->description }}</div>
            </div>
            <div class="mt-6 p-2 bg-slate-100">
                <h2 class="text-2xl font-semibold">Proyectos Asignables:</h2>
                <div class="flex space-x-2 mt-4 p-2">
                    @foreach ($backlogs_project as $backlogs_project)
                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" 
                            method="POST" 
                            action="{{ url('/backlogs_project-delete/'.$backlogs_project->id) }}" 
                            onsubmit="return confirm('Revocar Proyecto?');">
                             @csrf
                             @method('DELETE')
                             <button type="submit" style="font-size:15px">{{ $backlogs_project->project->name }}<i class="fa-regular fa-circle-xmark"></i></button>
                         </form>
                    @endforeach
                </div>
                <div class="max-w-xl mt-6">
                    <form method="POST" action="{{ url('/backlogs_project') }}">
                            @csrf
                            <input type="hidden" name="backlog_id" value="{{ $backlogs->id }}">
                                <div class="sm:col-span-6">
                                    <label for="project_id" class="block text-sm font-medium text-gray-700">Proyecto</label>
                                    <select id="project_id" name="project_id" autocomplete="project_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($projects as $projects)  
                                            <option value="{{ $projects->id }}">{{ $projects->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                        
                            </div>
                                <div class="sm:col-span-6 pt-5">
                                <a href="{{ url('backlogs') }}" class="btn btn-primary">Volver</a>
                                    <button type="submit" class="px-4 py-2 bg-green-700 hover:bg-green-500 text-white rounded-md">Asignar</button>
                                </div>
                    </form>
                </div>
            </div> 
        </div>
        </div>
    </div>
</x-app-layout>
