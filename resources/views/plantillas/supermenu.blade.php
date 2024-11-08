<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <a href="{{ route('main') }}" class="nav-link {{ activo('main') }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Principal
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>
      
      @can('acceso_gestionportales')
      @can('gp_menu_portalweb')
      <li class="nav-item has-treeview {{ menuopen(['publicacion','menus','modulopagina','tema','tags','categoria','popup','seccion','slider','enlaceref','convocatoria','fag'])}}">
          <a href="#" class="nav-link {{ tituloactivo(['publicacion','menus','modulopagina','tema','tags','categoria','popup','seccion','slider','enlaceref','convocatoria','fag']) }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Portal web<i class="right fas fa-angle-left"></i></p></a>
        <ul class="nav nav-treeview">
          @can('gp_configuracion_tema')
          <li class="nav-item">
            <a href="{{ url('/portalweb/tema') }}" class="nav-link {{ activo('tema') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Configración tema</p>
            </a>
          </li>
          @endcan
          <li class="nav-item">
            <a href="{{ url('/portalweb/convocatoria') }}" class="nav-link {{ activo('convocatoria') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Convocatoria</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/portalweb/fag') }}" class="nav-link {{ activo('fag') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Fondo apoyo gerencial</p>
            </a>
          </li>
          @can('gp_publicacion_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/publicacion') }}" class="nav-link {{ activo('publicacion') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Publicación</p>
            </a>
          </li>
          @endcan
          @can('gp_menu_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/menus') }}" class="nav-link {{ activo('menus') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Menu página</p>
            </a>
          </li>
          @endcan
          @can('gp_pagina_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/modulopagina') }}" class="nav-link {{ activo('modulopagina') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Módulo Página</p>
            </a>
          </li>
          @endcan
          @can('gp_taspagina_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/tags') }}" class="nav-link {{ activo('tags') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Tags Página</p>
            </a>
          </li>
          @endcan
          @can('gp_categoria_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/categoria') }}" class="nav-link {{ activo('categoria') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Categoria publicación</p>
            </a>
          </li>
          @endcan
          @can('gp_anuncios_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/popup') }}" class="nav-link {{ activo('popup') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Anuncios emergentes</p>
            </a>
          </li>
          @endcan
          @can('gp_seccion_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/seccion') }}" class="nav-link {{ activo('seccion') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Sección principal</p>
            </a>
          </li>
          @endcan
          @can('gp_slider_leer')          
          <li class="nav-item">
            <a href="{{ url('/portalweb/slider') }}" class="nav-link {{ activo('slider') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Slider</p>
            </a>
          </li>
          @endcan
          @can('gp_enlaceref_leer')
          <li class="nav-item">
            <a href="{{ url('/portalweb/enlaceref') }}" class="nav-link {{ activo('enlaceref') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Enlaces referenciales</p>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endcan
      
      @can('pg_menu_ciudadano')
      <li class="nav-item has-treeview {{ menuopen(['reclamaciones'])}}">
        <a href="#" class="nav-link {{ tituloactivo(['reclamaciones']) }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Ciudadanos
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          @can('pg_libroreclamaciones_leer')
          <li class="nav-item">
            <a href="{{ route('reclamaciones') }}" class="nav-link {{ activo('reclamaciones') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Libro reclamaciones</p>
            </a>
          </li>
          @endcan
          @can('pg_sugerencias_leer')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Sugerencias</p>
            </a>
          </li>
          @endcan
          
        </ul>
      </li>
      @endcan
      @can('pg_menu_registrovisitas')
	  {{-- MODIFICADO POR ABEL --}}
		{{--        <li class="nav-item has-treeview {{ menuopen(['regvisitas','reportevisit','reporexterno'])}}">--}}
        <li class="nav-item has-treeview {{ menuopen(['visitas.index','reportevisit','reporexterno'])}}">
        {{-- ------------------- --}}
         {{-- MODIFICADO POR ABEL --}}
		{{--        <a href="#" class="nav-link {{ tituloactivo(['regvisitas','reportevisit','reporexterno']) }}">--}}
            <a href="#" class="nav-link {{ tituloactivo(['visitas.index','reportevisit','reporexterno']) }}">
            {{-- ------------------- --}}
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Registro de visitas
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          @can('pg_registrovisitas_leer')
          <li class="nav-item">
			 {{-- MODIFICADO POR ABEL --}}
{{--                    <a href="{{ route('regvisitas') }}" class="nav-link {{ activo('regvisitas') }}">--}}
                    <a href="{{ route('visitas.index') }}" class="nav-link {{ activo('visitas.index') }}">
			{{-- ------------------- --}}
              <i class="far fa-circle nav-icon"></i>
              <p>Registrar visitas</p>
            </a>
          </li>
          @endcan
          @can('pg_registrovisitas_reporte')
          <li class="nav-item">
            <a href="{{ route('reportevisit') }}" class="nav-link {{ activo('reportevisit') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Reporte</p>
            </a>
          </li>
          @endcan
          @can('pg_registrovisitas_reporte')
          <li class="nav-item">
            <a href="{{ route('reporexterno') }}" class="nav-link {{ activo('reporexterno') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Vista para exterior</p>
            </a>
          </li>
          @endcan
          
        </ul>
       </li>
       @endcan



      {{-- <li class="nav-item has-treeview {{ menuopen(['vermesapartes','informaticos'])}}">
          <a href="#" class="nav-link {{ tituloactivo(['vermesapartes','informaticos']) }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Consenso SGD  <span class="left badge badge-success">Nuevo</span><i class="right fas fa-angle-left"></i></p></a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('/sgd/vermesapartes') }}" class="nav-link {{ activo('vermesapartes') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Ver mesa de partes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/sgd/informaticos') }}" class="nav-link {{ activo('informaticos') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Informaticos del pliego</p>
            </a>
          </li>
          
        </ul>
       </li> --}}
      

      {{-- <li class="nav-header">Sección del usuario</li>

      <li class="nav-item has-treeview {{ menuopen(['roles','permisos','registrousuarios','registropagina'])}}">
          <a href="#" class="nav-link {{ tituloactivo(['roles','permisos','registrousuarios','registropagina']) }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>Administrador<i class="right fas fa-angle-left"></i></p></a>


        <ul class="nav nav-treeview">
         
          
          <li class="nav-item">
            <a href="{{ url('/administrador/registrousuarios') }}" class="nav-link {{ activo('registrousuarios') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/administrador/registropagina') }}" class="nav-link {{ activo('registropagina') }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Registro portal web</p>
            </a>
          </li>
        </ul>
      </li> --}}
      @endcan


      

    </ul>
  </nav>