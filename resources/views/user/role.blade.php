<x-admin-layout>


    <div class="py-12 w-full">
        <x-success-status class="mb-4 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                    <div class="flex p-2">
                        <a href="{{ url('/users') }}" class="px-4 py-2 bg-green-700 hover:bg-green-500 text-white rounded-md">Listar Usuarios</a>
                    </div>
                <div class="flex flex-col p-2 bg-slate-100">
               <div>Nombre: {{ $user->name }}</div>
               <div>Correo: {{ $user->email }}</div>
            </div>
            <div class="mt-6 p-2 bg-slate-100">
                <h2 class="text-2xl font-semibold">Roles</h2>
                <div class="flex space-x-2 mt-4 p-2">
                    @if($user->roles)
                        @foreach ($user->roles as $user_role)
                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" 
                            method="POST" 
                            action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}" 
                            onsubmit="return confirm('Revocar Rol?');">
                             @csrf
                             @method('DELETE')
                             <button type="submit" style="font-size:15px">{{ $user_role->name }} <i class="fa-regular fa-circle-xmark"></i></button>
                         </form>
                        @endforeach
                    @endif
                </div>
                <div class="max-w-xl mt-6">
                    <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                            @csrf
                                <div class="sm:col-span-6">
                                    <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                                    <select id="role" name="role" autocomplete="role-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                        @error('role') <span class="text-red-400 tex-sm">{{ $message }}</span> @enderror
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
</x-admin-layout>
