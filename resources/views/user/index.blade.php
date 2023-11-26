<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Usuarios') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')"/>
    <x-danger-status class="mb-4 ml-40" :status="session('error')"/>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="py-4 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <table class="table table-bordered">
          @can('create')
            <div class="flex justify-end space-x-3 mb-2">
              <div>
                <button class="btn btn-success ">
                  <a href="add-user">Agregar usuario</a>
                </button>
              </div>
              @endcan
              @role('admin')
              <div>
                <button class="btn btn-primary">
                  <a href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.index')">Roles</a>
                </button>
              </div>
            </div>
            @endrole
            <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <Th>Correo</Th>
              <th>Rol</th>
              @role('admin')
              <th>Asignar Rol</th>
              @endrole
              @can('update')
                <th>Editar</th>
              @endcan
              @can('delete')
                <th>Eliminar</th>
              @endcan
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
                @role('admin')
                <td>
                  <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary">Asignar/Quitar</a>
                </td>
                @endrole
                @can('update')
                  <td>
                    <a href="{{ url('/edit-user/'.$user->id) }}" class="btn btn-primary">Editar</a>
                  </td>
                @endcan
                @can('delete')
                  <td>
                    <form action="{{ url('/delete-user/'.$user->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger">Eliminar</button>
                    </form>

                  </td>
                @endcan
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
