<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <x-success-status class="mb-4 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action= "{{ url('update-user/'.$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-label for="name" :value="__('Nombre')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" autofocus />
                    </div>
                    <div class="mt-4">
                        <x-label for="email" :value="__('Correo')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" autofocus />
                    </div>                       
                    
                     
                     <div>
                     <a href="{{ url('/users') }}" class="btn btn-info ml-3">Volver</a>

                     <a href="{{ url('/edit-pass/'.$user->id) }}" class="btn btn-danger ml-3">Cambiar Contraseña</a>
                     
                        <x-button class="ml-10 mt-10 bg-blue-500">
                            {{ __('Actualizar Usuario') }}
                        </x-button>

                     </div>



                </form>
            </div>
        </div>
       
    </div>

</x-app-layout>