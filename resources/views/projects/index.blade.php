<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyectos') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            

                <form action="{{ url('projects') }}" method ="POST">
                @csrf
                <div class = "form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                </div>
                <div class = "form-group">
                    <label for="description">Descripcion</label>
                    <input type="text" name="description" class="form-control" value="{{old('description')}}">
                </div>
                <div class = "form-group">
                    <label for="start">Fecha de Inicio</label>
                    <input type="date" name="start" class="form-control" value="{{old('start',date('Y-m-d'))}}">
                </div>
                <div class ="form-group">
                    <button class = " btn btn-primary">Registrar proyecto</button>
                </div>

                </form> 
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <Th>Nombre</Th>
                            <th>Descripcion</th>
                            <th>Responsables</th>
                            <th>Asignar Usuario</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
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
                            <td><a href="{{ url('/project_user/'.$project->id) }}" class="btn btn-primary">Asignar</a></td>
                            <td>
                                <a href="{{ url('/project/'.$project->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ url('/project/'.$project->id) }}" method="POST" onsubmit="return confirm('Estás Seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No existe usuarios</td>
                        </tr>
                        @endforelse
                        
                    </tbody>

                </table>


             </div>
        </div>       
    </div>

</x-app-layout>