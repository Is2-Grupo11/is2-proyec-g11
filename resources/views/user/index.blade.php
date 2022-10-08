<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-bordered">
                    <button class=" ml-10 mt-1 md-3 btn btn-success float-right">
                        <a href="add-user" >Agregar usuario</a>
                    </button>
                    <button class=" ml-auto mt-1 btn btn-primary float-right">
                        <a href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.index')" >Roles</a>
                    </button>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <Th>Correo</Th>
                            <th>Rol</th>
                            <th>Asignar Rol</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <div class="flex space-x-2">
                                    @if($user->roles)
                                        @foreach ($user->roles as $user_role)
                                        <a class="btn btn-outline-primary"> {{ $user_role->name }} </a>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            <td> 
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary">Asignar</a>
                            </td>
                            <td>
                                <a href="{{ url('/edit-user/'.$user->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ url('/delete-user/'.$user->id)}}" method="POST">
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