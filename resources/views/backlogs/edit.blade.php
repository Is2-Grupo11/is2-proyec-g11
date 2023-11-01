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
                <form action="{{ url('/backlog/'.$backlog->id) }}" method ="POST">
                    @csrf
                    @method('PUT')
                    <div class = "form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $backlog->name) }}">
                    </div>
                    <div class = "form-group">
                        <label for="description">Descripcion</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description', $backlog->description) }}">
                    </div>
                    <div class = "form-group">
                        <label for="start">Fecha de Inicio</label>
                        <input type="date" name="start" class="form-control" value="{{ old('start', $backlog->start) }}">
                    </div>
                    <div class ="form-group py-3">
                    <a href="{{ url('/backlogs/'.$backlog->project_id) }}" class="btn btn-primary">Volver</a> <!-- modificar boton para que vuelva atras -->
                        <button class = " btn btn-success">Guardar backlog</button>
                    </div>
                </form> 
            </div>
        </div>
       
    </div>

</x-app-layout>