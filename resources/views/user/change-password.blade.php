<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Contraseña') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <x-success-status class="mb-4 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action= "{{ url('update-pass/'.$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')                                          
                    <div class="mt-4">
                        <x-label for="password" :value="__('Contraseña Nueva')" />

                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        autocomplete="new-password" required/>
                    </div>
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                         <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
                    </div>
                     
                     <div>
                     <a href="{{ url('/edit-user/'.$user->id) }}" class="btn btn-info ml-3">Volver</a>                     
                        <x-button class="ml-10 mt-10 bg-blue-500">
                            {{ __('Actualizar Contraseña') }}
                        </x-button>
                     </div>
                </form>
            </div>
        </div>       
    </div>
</x-app-layout>