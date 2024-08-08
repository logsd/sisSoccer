<style>
    #layoutSidenav_nav {
        background-color: #4EA93B;
        color: #1A320F;
    }

    .nav-link {
        color: white
    }

    .nav-link:hover {
        color: #1A320F;
    }

    .logo img {
        width: 100%;
    }

    a.active {
        background-color: #1A320F;
        color: white;
    }
</style>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion " id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Inicio</div>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Home
                </a>


                <div class="sb-sidenav-menu-heading">Modulos</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                    Campeonatos
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('categorias.index')}}">Categorias</a>
                        <a class="nav-link" href="{{route('campeonatos.index')}}">Campeonatos</a>
                        <a class="nav-link" href="{{route('fases.index')}}">Fase</a>
                        <a class="nav-link" href="{{route('dataClubs.index')}}">Clubs</a>
                        <a class="nav-link" href="{{route('equipos.index')}}">Equipos</a>
                        <a class="nav-link" href="{{route('calendarios.index')}}">Calendario</a>
                        <a class="nav-link" href="{{route('contribuyentes.index')}}">Contribuyente</a>
                        <a class="nav-link" href="{{route('jugadores.index')}}">Jugadores</a>
                        <a class="nav-link" href="{{route('periodos.index')}}">Periodos</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    Consultas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('campeonatos.index')}}">Campeonatos</a>
                    <a class="nav-link" href="{{route('equipos.index')}}">Equipos</a>
                    <a class="nav-link" href="{{route('jugadores.index')}}">Jugadores</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Clubes
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('clubs.create')}}">Club</a>
                        <a class="nav-link" href="{{route('ejecutivos.index')}}">Directivos</a>
                        <a class="nav-link" href="{{route('directClubs.index')}}">Directivos Club</a>
                        <a class="nav-link" href="{{route('etapas.index')}}">Etapas</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house-laptop"></i></div>
                    Empresa
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('cargos.index')}}">Cargos</a>
                        <a class="nav-link" href="{{route('departamentos.index')}}">Departamentos</a>
                        <a class="nav-link" href="{{route('empleados.index')}}">Empleados</a>
                        <a class="nav-link" href="{{route('comisiondeligas.index')}}">Comisión Liga</a>
                        <a class="nav-link" href="{{route('ligas.index')}}">Ligas</a>
                        <a class="nav-link" href="{{route('genTelefonos.index')}}">Telefonos</a>
                        <a class="nav-link" href="{{route('telefonos.index')}}">Operadoras</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                    Oficinas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('reportes.index')}}">Reporte</a>
                        <a class="nav-link" href="{{route('cargooficinas.index')}}">Cargo Oficinas</a>
                        <a class="nav-link" href="{{route('genOficinas.index')}}">Oficina</a>
                        <a class="nav-link" href="{{route('genEstados.index')}}">Estado del Directivo</a>
                        <a class="nav-link" href="{{route('sancion.index')}}">Sanciones</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts10" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                    Parametros
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts10" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('tparametros.index')}}">Tipo de Parametro</a>
                        <a class="nav-link" href="{{route('estados.index')}}">Estado de Parametrp</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts9" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house-laptop"></i></div>
                    Otros
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts9" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('users.index')}}">Usuarios</a>
                        <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                    </nav>
                </div>

            </div>

        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Bienvenido</div>
            {{auth()->user()->name}}
        </div>
    </nav>
</div>
