<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyectos') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 px-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                @can('create')
                <form action="{{ url('projects') }}" method ="POST">
                @csrf
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="name">Nombre</label>
                    <input type="text" name="name" value="{{old('name')}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>
                @error('name') <span class="text-red-400 tex-sm">{{ $message }}</span> @enderror
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="description">Descripcion</label>
                    <input type="text" name="description" value="{{old('description')}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="start">Fecha de Inicio</label>
                    <input type="date" name="start" value="{{old('start',date('Y-m-d'))}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
                <div class ="form-group py-2">
                    <button class = " btn btn-success">Registrar proyecto</button>
                </div>

                </form> 
                @endcan

                <div class="text-2xl font-black tracking-tight py-3">Lista de Proyectos </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <Th>Nombre</Th>
                            <th>Descripcion</th>
                            <th>Responsables</th>
                            <th>Opciones</th>
                            @can('update')
                            <th>Editar</th>
                            @endcan
                            @can('delete')
                            <th>Eliminar</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>{{$project->description}}</td>
                            <td><div class="flex space-x-2">
                                    <!--  FALTA ARREGLAR IF -->
                                    @if($project->project_user)
                                        @foreach ($project->project_user as $projects_user)
                                        <a class="btn btn-outline-primary"> {{ $projects_user->user->name}} </a>
                                        @endforeach
                                    @endif
                                  
                                </div>
                            </td>
                            <td>
                            @can('create')
                            <a href="{{ url('/project_user/'.$project->id) }}" class="btn btn-primary">Asignar</a>
                            @endcan
                            <a href="{{ url('/backlogs/'.$project->id) }}" class="btn btn-primary">Backlogs</a></td>
                            @can('update')
                            <td>
                                <a href="{{ url('/project/'.$project->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                            @endcan
                            @can('delete')
                            <td>
                                <form action="{{ url('/project/'.$project->id) }}" method="POST" onsubmit="return confirm('Estás Seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No existen proyectos</td>
                        </tr>
                        @endforelse
                        
                    </tbody>

                </table>


             </div>
        </div>       
    </div>

</x-app-layout>