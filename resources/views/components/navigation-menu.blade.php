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
                @canany(['ver-partido', 'ver-club', 'ver-campeonato'])
                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('ver-categoria')
                        <a class="nav-link" href="{{route('categorias.index')}}">Categorias</a>
                        @endcan

                        @can('ver-campeonato')
                        <a class="nav-link" href="{{route('campeonatos.index')}}">Campeonatos</a>
                        @endcan
                        @can('ver-fase')
                        <a class="nav-link" href="{{route('fases.index')}}">Fase</a>
                        @endcan

                        @can('ver-dataClub')
                        <a class="nav-link" href="{{route('dataClubs.index')}}">Clubs</a>
                        @endcan
                        @can('ver-equipo')
                        <a class="nav-link" href="{{route('equipos.index')}}">Equipos</a>
                        @endcan
                        @can('ver-partido')
                        <a class="nav-link" href="{{route('calendarios.index')}}">Calendario</a>
                        @endcan
                        @can('ver-contribuyente')
                        <a class="nav-link" href="{{route('contribuyentes.index')}}">Contribuyente</a>
                        @endcan
                        @can('ver-jugador')
                        <a class="nav-link" href="{{route('jugadores.index')}}">Jugadores</a>
                        @endcan
                        @can('ver-periodo')
                        <a class="nav-link" href="{{route('periodos.index')}}">Periodos</a>
                        @endcan
                    </nav>
                </div>
                @endcanany



                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    Consultas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    @can('ver-campeonato')
                    <a class="nav-link" href="{{route('campeonatos.index')}}">Campeonatos</a>
                    @endcan
                    @can('ver-equipo')
                    <a class="nav-link" href="{{route('equipos.index')}}">Equipos</a>
                    @endcan
                    @can('ver-jugador')
                    <a class="nav-link" href="{{route('jugadores.index')}}">Jugadores</a>
                    @endcan
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Clubes
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    @can('ver-club')
                        <a class="nav-link" href="{{route('clubs.create')}}">Club</a>
                        @endcan  
                        @can('ver-ejecutivo')
                        <a class="nav-link" href="{{route('ejecutivos.index')}}">Directivos</a>
                        @endcan  
                        @can('ver-directClub')
                        <a class="nav-link" href="{{route('directClubs.index')}}">Directivos Club</a>
                        @endcan  
                        @can('ver-etapa')
                        <a class="nav-link" href="{{route('etapas.index')}}">Etapas</a>
                        @endcan  
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house-laptop"></i></div>
                    Empresa
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    @can('ver-cargo')
                        <a class="nav-link" href="{{route('cargos.index')}}">Cargos</a>
                        @endcan  
                        @can('ver-departamento')
                        <a class="nav-link" href="{{route('departamentos.index')}}">Departamentos</a>
                        @endcan  
                        @can('ver-empleado')
                        <a class="nav-link" href="{{route('empleados.index')}}">Empleados</a>
                        @endcan  
                        @can('ver-comision')
                        <a class="nav-link" href="{{route('comisiondeligas.index')}}">Comisión Liga</a>
                        @endcan  
                        @can('ver-liga')
                        <a class="nav-link" href="{{route('ligas.index')}}">Ligas</a>
                        @endcan  
                        @can('ver-genTelefono')
                        <a class="nav-link" href="{{route('genTelefonos.index')}}">Telefonos</a>
                        @endcan  
                        @can('ver-telefono')
                        <a class="nav-link" href="{{route('telefonos.index')}}">Operadoras</a>
                        @endcan  
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                    Oficinas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    @can('ver-reporte')
                        <a class="nav-link" href="{{route('reportes.index')}}">Reporte</a>
                        @endcan   
                        @can('ver-cargoOficina')
                        <a class="nav-link" href="{{route('cargooficinas.index')}}">Cargo Oficinas</a>
                        @endcan
                        @can('ver-oficina')
                        <a class="nav-link" href="{{route('genOficinas.index')}}">Oficina</a>
                        @endcan
                        @can('ver-genEstado')
                        <a class="nav-link" href="{{route('genEstados.index')}}">Estado del Directivo</a>
                        @endcan
                        @can('ver-sancion')
                        <a class="nav-link" href="{{route('sancion.index')}}">Sanciones</a>
                        @endcan
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts10" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                    Parametros
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts10" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    @can('ver-typeParameter')
                        <a class="nav-link" href="{{route('tparametros.index')}}">Tipo de Parametro</a>
                        @endcan
                        @can('ver-estado')
                        <a class="nav-link" href="{{route('estados.index')}}">Estado de Parametrp</a>
                        @endcan
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts9" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house-laptop"></i></div>
                    Otros
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts9" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    @can('ver-usuario')
                        <a class="nav-link" href="{{route('users.index')}}">Usuarios</a>
                        @endcan
                        @can('ver-role')
                        <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                        @endcan
                    </nav><
                </div>

            </div>

        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Bienvenido</div>
            {{auth()->user()->name}}
        </div>
    </nav>
</div>