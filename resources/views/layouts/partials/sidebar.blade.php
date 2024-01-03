<aside class="sidebar">
    <div id="leftside-navigation" class="nano">
        <ul class="nano-content">
{{--            <li class="active"><a href="{{route('dashboard.series.index')}}">Séries</a></li>--}}
            <li class="active"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i><span>Painel</span></a></li>
            <li><a href="{{route('dashboard.documents.index')}}"><i class="fa fa-dashboard"></i><span>Enviar Documentos</span></a></li>
            @can('areaconhecimentos.index')
            <li><a href="{{route('dashboard.areaconhecimentos.index')}}"><i class="fa fa fa-tasks"></i><span>Área de Conhecimento</span></a></li>
            @endcan
            <li class="sub-menu">
                <a href="javascript:void(0);"><i class="fa fa fa-tasks"></i><span>Gerenciar Alunos</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    @can('students.index')
                        <li><a href="{{route('painel.alunos.index')}}">Alunos</a></li>
                    @endcan
                </ul>
            </li>
            @if(auth()->user()->super_admin == 1)
                <li><a href="{{route('administrators')}}"><i class="fa-solid fa-user-tie"></i><span>Administradores</span></a></li>
            @endif

            <li class="sub-menu">
                <a href="javascript:void(0)">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Gerenciar Turmas</span>
                    <i class="arrow fa fa-angle-right pull-right"></i>
                </a>
                <ul>
                    @can('tipo_ensinos.index')
                        <li><a href="{{route('dashboard.tipo_ensinos.index')}}">Tipos de Ensino</a></li>
                    @endcan
                    @can('series.index')
                        <li><a href="{{route('dashboard.series.index')}}">Séries</a></li>
                    @endcan
                    @can('students.index')
                        <li><a href="{{route('dashboard.students.index')}}">Tumas</a></li>
                    @endcan
                    @can('tutors.index')
                        <li><a href="{{route('dashboard.tutors.index')}}">Tutoria</a></li>
                    @endcan
                    @can('presidents.index')
                        <li><a href="{{route('dashboard.presidents.index')}}">Clube</a></li>
                    @endcan
                    @can('professors.index')
                        <li><a href="{{route('dashboard.professors.index')}}">Eletiva</a></li>
                    @endcan
                </ul>
            </li>

            @can('users.index')
                <li><a href="{{route('dashboard.users.index')}}"><i class="fa-solid fa-users"></i><span>Usuários</span></a></li>
            @endcan
            @can('salas.index')
                <li><a href="{{route('dashboard.salas.index')}}"><i class="fa-brands fa-intercom"></i><span>Salas</span></a></li>
            @endcan

            <li class="sub-menu">
                <a href="{{route('dashboard.disciplines.teachers.index')}}">
                    <i class="fa-solid fa-address-card"></i><span>Fechamento</span></a>
            </li>
            <li class="sub-menu">
                <a href="{{route('dashboard.students.conselho.teacher.index')}}">
                    <i class="fa-solid fa-address-card"></i><span>Conselho</span></a>
            </li>
            @can('conselhos.index')
                <li class="sub-menu">
                    <a href="{{route('dashboard.students.conselho.escola.index')}}"><i class="fa-solid fa-address-card"></i><span>Conselho Escolar</span></a>
                </li>
            @endcan
            <li class="sub-menu">
                <a href="javascript:void(0);"><i class="fa fa-bar-chart-o"></i><span>Charts</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="charts-chartjs.html">Chartjs</a>
                    </li>
                    <li><a href="charts-morris.html">Morris</a>
                    </li>
                    <li><a href="charts-c3.html">C3 Charts</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:void(0);"><i class="fa fa-map-marker"></i><span>Maps</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="map-google.html">Google Map</a>
                    </li>
                    <li><a href="map-vector.html">Vector Map</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:void(0);"><i class="fa fa-file"></i><span>Pages</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="pages-blank.html">Blank Page</a>
                    </li>
                    <li><a href="pages-login.html">Login</a>
                    </li>
                    <li><a href="pages-sign-up.html">Sign Up</a>
                    </li>
                    <li><a href="pages-calendar.html">Calendar</a>
                    </li>
                    <li><a href="pages-timeline.html">Timeline</a>
                    </li>
                    <li><a href="pages-404.html">404</a>
                    </li>
                    <li><a href="pages-500.html">500</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>