<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Stories -') }}
            {{$sprints->name}}
        </h2>
    </x-slot>

    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 px-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                @can('create')
                <form action="{{ url('stories') }}" method ="POST">
                @csrf

                <input type="hidden" name="project_id" value="{{ $sprints->project_id }}">
                <input type="hidden" name="backlog_id" value="{{ $sprints->backlog_id }}">
                <input type="hidden" name="sprint_id" value="{{ $sprints->id }}">

                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="board_list_id">Estado</label>
                    <select type="text" name="board_list_id" value="{{old('board_list_id')}}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($board as $boards)
                            <option value="{{ $boards->id }}">{{ $boards->name }}</option>
                        @endforeach
                    </select>

                </div>


                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="title">Nombre</label>
                    <input type="text" name="title" value="{{old('title')}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>
                @error('title') <span class="text-red-400 tex-sm">{{ $message }}</span> @enderror
                <div class = "form-group py-2">
                    <label class="tex-sm font-medium py-1" for="description">Descripcion</label>
                    <input type="text" name="description" value="{{old('description')}}" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                </div>

                
                <div class ="py-3 form-group">
                @endcan
                    <a href="{{ url('/sprints/'.$sprints->backlog_id) }}" class="btn btn-primary">Volver</a>
                @can('create')
                    <button class = " btn btn-success">Crear user stories</button>
                </div>

                </form> 
                @endcan

                <div class="text-2xl font-black tracking-tight py-3">Lista de User Stories - {{$sprints->name}} </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <Th>Nombre</Th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            @can('update')
                            <th>Editar</th>
                            @endcan
                            @can('delete')
                            <th>Eliminar</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($stories as $stories)
                        <tr>
                            <td>{{$stories->title}}</td>
                            <td>{{$stories->description}}</td>
                            @foreach($board as $boards)
                            @if($boards->id === $stories->board_list_id)
                            <td>{{$boards->name}}</td>
                            @endif
                            @endforeach
                            @can('update')
                            <td>
                                <a href="{{ url('/storie_edit/'.$stories->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                            @endcan
                            @can('delete')
                            <td>
                                <form action="{{ url('/storie/'.$stories->id) }}" method="POST" onsubmit="return confirm('Estás Seguro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No existe user stories</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>


             </div>
        </div>       
    </div>

</x-app-layout>