<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Backlog -') }}
            {{$projects->name}}
        </h2>
    </x-slot>

    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
    <x-danger-status class="mb-4 ml-40" :status="session('error')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 px-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @can('create')
                @if (count($backlogs) < 1)
                <form action="{{ url('backlogs') }}" method ="POST">
                @csrf
                <input type="hidden" name="project_id" value="{{ $projects->id }}">
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="name">Nombre</label>
                    <input  type="text" name="name" value="{{old('name')}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="description">Descripcion</label>
                    <input type="text" name="description"  value="{{old('description')}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="start">Fecha de Inicio</label>
                    <input type="date" name="start"  value="{{old('start',date('Y-m-d'))}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
                
                <div class ="form-group py-3">
                @endif
                @endcan
                <a href="{{ url('projects') }}" class="btn btn-primary">Volver</a>
                @can('create')
                @if (count($backlogs) < 1)
                    <button class = "btn btn-success">Registrar backlog</button>
                </div>
                </form>
                @endif
                @endcan


                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <Th>Nombre</Th>
                            <th>Descripcion</th>
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
                        @forelse($backlogs as $backlog)
                        <tr>
                            <td>{{$backlog->name}}</td>
                            <td>{{$backlog->description}}</td>
                            <td>
                            <a href="{{ url('/sprints/'.$backlog->id) }}" class="btn btn-primary">Sprint</a></td>
                            </td>
                            @can('update')
                            <td>
                                <a href="{{ url('/backlog/'.$backlog->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                            @endcan
                            @can('delete')
                            <td>
                                <form action="{{ url('/backlog/'.$backlog->id) }}" method="POST" onsubmit="return confirm('Estás Seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                            @endcan
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