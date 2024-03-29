<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <x-success-status class="mb-4 ml-40" :status="session('message')" />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action= "{{ url('add-user') }}" method="POST">
                    @csrf

                    <div>
                        <x-label for="name" :value="__('Nombre')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  required autofocus />
                    </div>
                    @error('name') <span class="text-red-400 tex-sm">{{ $message }}</span> @enderror
                    
                    <div class="mt-4">
                        <x-label for="email" :value="__('Correo')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
                    <div class="mt-4">
                        <x-label for="password" :value="__('Contraseña')" />

                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                     </div>
                     <div>
                        <button class="ml-3 mt-10 btn btn-info">
                             <a href="users">Volver</a>
                        </button>
                        <button class="ml-3 mt-10 btn btn-success">
                            {{ __('Guardar Usuario') }}
                        </button>

                     </div>



                </form>
            </div>
        </div>
       
    </div>

</x-app-layout>