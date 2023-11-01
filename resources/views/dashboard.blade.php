<x-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <x-success-status class="mb-3 ml-40" :status="session('message')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-2 px-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                <div class="text-2xl font-black tracking-tight py-3">Gráficos por Proyecto </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <Th>Nombre</Th>
                            <th>Gráfico</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>
                            <a href="{{ url('/grafico/'.$project->id) }}" class="btn btn-primary">Grafico</a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No existen proyectos</td>
                        </tr>
                        @endforelse
                        
                    </tbody>

                </table>


             </div>
        </div>       
    </div>

</x-app-layout>