# Laravel - Sistema de Gestión de Proyectos

Este sistema proporciona funcionalidades clave para una administración efectiva de proyectos, brindando a los usuarios la capacidad de optimizar su flujo de trabajo y alcanzar objetivos con éxito.
Este Proyecto fue creado en la asignatura "Ingeniería de Software 2"


## Características

- **Gestión de usuarios:** permite la creación y administración de usuarios con asignación de roles.

- **Creación de proyectos:** posibilita la creación y organización de proyectos.

- **Backlogs:** ofrece la funcionalidad de gestionar y organizar los elementos del backlog del proyecto.

- **Sprint y User Stories:** facilita la planificación de sprints y la creación de user stories asociadas a las tareas.

- **Tablero Kanban:** proporciona un tablero Kanban para visualizar y gestionar las user stories de manera ágil.

- **Gráficos:** incluye la funcionalidad de generar gráficos visuales por proyecto que muestran el estado de las tareas, diferenciando entre las pendientes, las que se encuentran en proceso y las finalizadas.


##  Tecnologías y Librerías  Utilizadas 

- **Laravel:** Framework de desarrollo web en PHP.
- **MySQL:** Sistema de gestión de base de datos relacional.
- **Vue:** Framework progresivo de JavaScript para la construcción de interfaces de usuario en el lado del cliente.
- **InertiaJS:** Biblioteca que permite a Vue.js trabajar sin problemas con aplicaciones de servidor renderizadas. Facilita la comunicación entre el frontend Vue.js y el backend Laravel.
- **Laravel Spatie:** Empleado para el control de roles de usuarios dentro del sistema.

## Instalación

Para ejecutar este proyecto localmente, sigue estos pasos:

1. **Clona este repositorio:**
    ```bash
    git clone https://github.com/Is2-Grupo11/is2-proyec-g11.git
    ```

2. **Instala las dependencias del proyecto:**
    ```bash
    composer install
    ```

3. **Instala las dependencias del lado del cliente:**
    ```bash
    npm install
    ```

4. **Genera la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

5. **Configura el archivo `.env`:**

   Configura los datos de tu base de datos **MySQL** en el archivo `.env`.

6. **Ejecuta las migraciones para crear la estructura de la base de datos:**
    ```bash
    php artisan migrate
    ```

7. **Inicia el servidor local:**
    ```bash
    php artisan serve
    ```

## Información del Proyecto

Este proyecto fue desarrollado como parte de la materia "Ingeniería de Software 2" en la Facultad Politécnica de la Universidad Nacional de Asunción.

### Detalles del Equipo de Desarrollo

- Aarón Ocampo
- Andrés Testa
- Alexis Martinez
- Gerardo Ortiz

## Capturas de Pantalla

![1](https://github.com/Is2-Grupo11/is2-proyec-g11/assets/111013326/b9fcf672-3024-4c0f-b6c4-ae946ef90fed)

![2](https://github.com/Is2-Grupo11/is2-proyec-g11/assets/111013326/453c5778-9ad3-4399-8887-4289ffffa92d)

![6](https://github.com/Is2-Grupo11/is2-proyec-g11/assets/111013326/2f787cba-701b-4389-aed6-75396e68fc17)

![graficco](https://github.com/Is2-Grupo11/is2-proyec-g11/assets/111013326/208a3b27-c8c7-4db0-b881-8fadfa0b6586)