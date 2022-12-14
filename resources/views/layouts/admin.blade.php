<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            
                <!-- Page Heading -->
                <!--ROLES Y PERMISOS BOTONES-->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                       
                        <x-admin-link href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.index')" class="btn btn-outline-primary">Roles</x-admin-link>
                        <x-admin-link href="{{ route('admin.permissions.index') }}" :active="request()->routeIs('admin.permissions.index')" class="btn btn-outline-secondary">Permisos</x-admin-link>
                        <!-- AGREGAR BOTON DE OTRAS DIRECCIONES -->
                       <!-- <a href="{{ url('/users') }}" class="btn btn-danger ml-3">agregar usuario</a> -->
                        
                    </div>
                </header>
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>