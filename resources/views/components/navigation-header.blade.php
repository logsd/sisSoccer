<style>

    .sb-topnav{
        background-color: #1A320F;
        z-index: 5;
        position: fixed;
    }

    img{
        width: 80%;
    }

    .date-display{
        color: white;
        margin-left:55%;
        margin-right: 2%
    }
</style>

<nav class="sb-topnav navbar navbar-expand navbar-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('home') }}"><img src="{{ asset('img/logo2.jpeg') }}" alt="Descripción de la imagen"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar HORARIO-->
            <div class="date-display " id="currentDateDisplay"></div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuracion</a></li>
                        <li><a class="dropdown-item" href="#!">Registro Actividad</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const dateDisplay = document.getElementById('currentDateDisplay');
            const today = new Date();

            const days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

            const dayName = days[today.getDay()];
            const day = today.getDate();
            const monthName = months[today.getMonth()];
            const year = today.getFullYear();

            dateDisplay.textContent = `${dayName} ${day} de ${monthName} de ${year}`;
        });
    </script>
