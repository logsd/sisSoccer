<style>
    #layoutSidenav_nav{
        background-color: #4EA93B;
        color: #1A320F;
    }

    .nav-link{
        color: white
    }

    .nav-link:hover{
        color:#1A320F;
    }

    .logo img{
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
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
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
                                    <a class="nav-link" href="{{route('equipos.index')}}">Calendario</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Campeonatos</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Categorias</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Equipos - Campeonatos</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Jugadores - Campeonatos</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Partidos</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Vocales - Campeonatos</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                                Consultas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('equipos.index')}}">Campeonatos</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">
                                        Equipos en Campeonatos
                                    </a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Jugadores en Campeonatos</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Tabla Goleadores</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Clubes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('equipos.index')}}">Club</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Directivos</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Directivos Club</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Equipos</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Jugadores</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house-laptop"></i></div>
                                Empresa
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('equipos.index')}}">Cargos</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Comisiones</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Directivos Liga</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Empresas y Oficinas</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Listado Reportes</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Periodos</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">Vocales</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                                Equipos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('equipos.index')}}">Ver</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">
                                        Crear
                                    </a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                                Jugadores y Pestamos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('equipos.index')}}">Cobrar Multas</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Levantar Sancciones</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Multas Generales</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Sanciones Generales</a>
                                </nav>
                            </div>

                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                                Capital Humano
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('equipos.index')}}">Empleado</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Cargos Empleados</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Multas Generales</a>
                                    <a class="nav-link" href="{{route('equipos.index')}}">Sanciones Generales</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="{{route('ligas.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-trophy"></i></div>
                                Ligas
                            </a>
                            <a class="nav-link" href="{{route('departamentos.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-building-user"></i></div>
                                Departamentos
                            </a>
                            <a class="nav-link" href="{{route('cargos.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-ranking-star"></i></div>
                                Cargos
                            </a>
                            <a class="nav-link" href="{{route('dataClubs.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-shield"></i></div>
                                Clubs
                            </a>
                            <a class="nav-link" href="{{route('categorias.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                Categorias
                            </a>
                            <a class="nav-link" href="{{route('estados.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-bar"></i></div>
                                Estados de Parametros
                            </a>
                            <a class="nav-link" href="{{route('telefonos.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-square-phone"></i></div>
                                Operadoras
                            </a>
                            <a class="nav-link" href="{{route('contribuyentes.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                                Contribuyentes
                            </a>
                            <a class="nav-link" href="{{route('ejecutivos.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                Ejecutivos
                            </a>
                            <a class="nav-link" href="{{route('reportes.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-flag"></i></div>
                                Reportes
                            </a>
                            <a class="nav-link" href="{{route('periodos.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                                Periodos
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                                Campeonatos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('campeonatos.index')}}">Ver</a>
                                    <a class="nav-link" href="{{route('campeonatos.create')}}">
                                        Crear
                                    </a>
                                    <a class="nav-link" href="{{route('fases.index')}}">
                                        Crear Fase
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-futbol"></i></div>
                                Equipos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('equipos.index')}}">Ver</a>
                                    <a class="nav-link" href="{{route('equipos.create')}}">
                                        Crear
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link" href="{{route('etapas.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-diagram-project"></i></div>
                                Etapas
                            </a>
                            <a class="nav-link" href="{{route('calendarios.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar"></i></div>
                                Calendario
                            </a>
                            <a class="nav-link" href="{{route('empleados.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Empleados
                            </a>
                            <a class="nav-link" href="{{route('genTelefonos.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-phone"></i></div>
                                Telefonos
                            </a>

                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>

                            <a class="nav-link" href="{{route('comisiondeligas.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Comision de Ligas
                            </a>
                            <a class="nav-link"  href="{{route('cargooficinas.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Cargos Empleados
                            </a>
                            <a class="nav-link" href="{{route('tparametros.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                               Tipo de Parametros
                            </a>
                            <a class="nav-link" href="{{route('sancion.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-ban"></i></div>
                                Sanciones
                            </a>
                            <a class="nav-link" href="{{route('carnets.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card"></i></div>
                                Carnets
                            </a>

                            <a class="nav-link" href="{{route('gparametros.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                                Parametros Generales
                            </a>

                            <a class="nav-link" href="{{route('genEstados.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-diagram-project"></i></div>
                               Estados Generales
                            </a>

                            <a class="nav-link" href="{{route('genOficinas.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-building"></i></div>
                               Oficinas Generales
                            </a>

                        </div>
                    </div>

                </nav>
            </div>
