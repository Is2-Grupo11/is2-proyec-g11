<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Backlogs') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            

                <form action="{{ url('backlogs') }}" method ="POST">
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
                    <button class = " btn btn-primary">Registrar backlog</button>
                </div>

                </form> 
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <Th>Nombre</Th>
                            <th>Descripcion</th>
                            <th>Proyecto Asociado</th>
                            <th>Asignar Proyecto</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backlogs as $backlog)
                        <tr>
                            <td>{{$backlog->name}}</td>
                            <td>{{$backlog->description}}</td>
                            <td><div class="flex space-x-2">
                                    <!--  FALTA ARREGLAR IF -->
                                    @if($backlog->backlog_project)
                                        @foreach ($backlog->backlog_project as $backlogs_project)
                                        <a class="btn btn-outline-primary"> {{ $backlogs_project->project->name}} </a>
                                        @endforeach
                                    @endif
                                  
                                </div>
                            </td>
                            <td><a href="{{ url('/backlog_project/'.$backlog->id) }}" class="btn btn-primary">Asignar</a></td>
                            <td>
                                <a href="{{ url('/backlog/'.$backlog->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ url('/backlog/'.$backlog->id) }}" method="POST" onsubmit="return confirm('Estás Seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No existen backlogs</td>
                        </tr>
                        @endforelse
                        
                    </tbody>

                </table>


             </div>
        </div>       
    </div>

</x-app-layout>