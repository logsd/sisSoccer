<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Inicio</div>
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                                Home
                            </a>
                            <a class="nav-link" href="{{ route('panel') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel
                            </a>
                            
                      <!--      <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div-->
                            <div class="sb-sidenav-menu-heading">Modulos</div>
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

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Bienvenido:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
