<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sprints -') }}
            {{$backlogs->name}}
        </h2>
    </x-slot>

    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 px-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                @can('create')
                <form action="{{ url('sprints') }}" method ="POST">
                @csrf
                <input type="hidden" name="project_id" for="project_id" value="{{ $backlogs->project_id }}">
                <input type="hidden" name="backlog_id" for="backlog_id" value="{{ $backlogs->id }}">
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="name">Nombre</label>
                    <input type="text" name="name"  value="{{old('name')}} " class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>
                @error('name') <span class="text-red-400 tex-sm">{{ $message }}</span> @enderror
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="fechainicio">Fecha de Inicio</label>
                    <input type="date" name="fechainicio" value="{{old('fechainicio',date('Y-m-d'))}}"  class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="fechafin">Fecha de Finalizacion</label>
                    <input min="Y-m-d" type="date" name="fechafin"  value="{{old('fechafin',date('Y-m-d', strtotime(' +  14 days')))}}"  class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
                
                <div class = "form-group py-2">
                    <label  class="tex-sm font-medium py-1" for="estado">Estado</label>
                    <select  type="text" name="estado" value="{{old('estado')}}"  class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">                        
                        <option value="En proceso">En proceso</option>
                    </select>         
                </div>
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="numero">Número</label>
                    <input type="text" name="numero" value="{{old('numero')}}"  class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>
                
                <div class ="py-3 form-group">
                @endcan
                    <a href="{{ url('/backlogs/'.$backlogs->project_id) }}" class="btn btn-primary">Volver</a>
                @can('create')
                    <button class = " btn btn-success">Crear sprint</button>
                </div>
                </form> 
                @endcan

                <div class="text-2xl font-black tracking-tight py-2">Lista de Sprints - {{$backlogs->name}} </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <Th>Descripcion</Th>
                            <Th>Fecha Inicio</Th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>
                            <th>Numero</th>
                            @can('update')
                            <th>Editar</th>
                            @endcan
                            <th>Opciones</th>
                            @can('delete')
                            <th>Eliminar</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($sprints as $sprint)
                        <tr>
                            <td>{{$sprint->name}}</td>
                            <td>{{$sprint->fechainicio}}</td>
                            <td>{{$sprint->fechafin}}</td>
                            <td>{{$sprint->estado}}</td>
                            <td>{{$sprint->numero}}</td>
                            @can('update')
                            <td>
                            @if($sprint->estado === 'En proceso')
                                <a href="{{ url('/sprint/'.$sprint->id) }}" class="btn btn-primary">Editar</a>
                            @endif
                            @if($sprint->estado === 'finalizado')
                                <a>finalizado</a>
                            @endif
                            </td>
                            @endcan

                           
                                <td>
                                @if($sprint->estado === 'En proceso')
                                    <a href="{{ url('/stories/'.$sprint->id) }}" class="btn btn-primary">US</a>
                                    
                                    <a href="{{ url('/boards/'.$sprint->id) }}" class="btn btn-primary">Kanban</a>
                                    
                                @endif
                                @if($sprint->estado === 'finalizado')
                                <a>finalizado</a>
                                @endif
                                </td>
                            @can('delete')
                            <td>
                                <form action="{{ url('/sprint/'.$sprint->id) }}" method="POST" onsubmit="return confirm('Estás Seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No existe sprint</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>


             </div>
        </div>       
    </div>

</x-app-layout>