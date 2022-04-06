@extends('adminlte::page')

@section('title', 'Inicio')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    <!-- OpenLayers v6 CSS -->
    <link rel="stylesheet" href="{{ asset('lib/openlayers-v6.4.3-dist/ol.css') }}">
    
    <!-- Animate.css -->
	<link rel="stylesheet" href="new/css/animatev5.css">
	<!-- Icomoon Icon Fonts-->
	<!-- Bootstrap  -->
	<!-- Theme style  -->
	<link rel="stylesheet" href="new/css/style.css">

	<!-- Modernizr JS -->
	<script src="new/js/modernizr-2.6.2.min.js"></script>
    
    
    
@stop


@section('content_header')

@stop

@section('content')


                <h5><b><p style="color: #5E6060;" class="tablero-text">¡Te damos la bienvenida al <FONT COLOR=#17A2B8>panel de navegación</FONT> {{ auth()->user()->name }}!</b></h5>
                        <hr>
               
<!--<img src="{{ asset('img/botones/txt-tablero.svg') }}" alt="" class="tablero-img">-->               


	<div class="fh5co-loader"></div>

	<div id="fh5co-work" class="fh5co-bg-dark">
		<div class="container d-flex align-items-center justify-content-center container-lg">
			<div class="row animate-box">
			</div>
			<div class="row">
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('municipios.index', ['tipo'=>'intendente']) }}" class="work" style="background-image: url(new/images/btn2.png);">
						<div class="desc">
							<h3>Municipios</h3>
							<span>Intendentes</span>
							<span>HCD</span>
							<span>Información General</span>
							<span>Fiestas Populares</span>
							<span>Consulados</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('politico.index', ['tipo'=>'gobernacion']) }}" class="work" style="background-image: url(new/images/btn_institucional.png);">
						<div class="desc">
							<h3>Institucional</h3>
							<span>Ejecutivo</span>
							<span>Legislativo</span>
							<span>Judicial</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('electoral.index', ['tipo'=>'resultados']) }}" class="work" style="background-image: url(new/images/btn_electoral.png);">
						<div class="desc">
							<h3>Electoral</h3>
							<span>Resultados electorales</span>
							<span>Electores e inscriptos</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('economico.index') }}" class="work" style="background-image: url(new/images/btn_economico.png);">
						<div class="desc">
							<h3>Económico</h3>
							<span>Transferencias provinciales <br>acumuladas a municipios</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('productivo.index', ['tipo'=>'agrupamientos-industriales']) }}" class="work" style="background-image: url(new/images/btn_productivo.png);">
						<div class="desc">
							<h3>Productivo</h3>
							<span>Agrupamientos industriales</span>
							<span>Empresas</span>
							<span>Puertos</span>
							<span>Parques eólicos</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('vivienda.index', ['tipo'=>'asentamientos']) }}" class="work" style="background-image: url(new/images/btn_vivienda.png);">
						<div class="desc">
							<h3>Vivienda</h3>
							<span>Asentamientos</span>
							<span>Servicios</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('sanitario.index', ['tipo'=>'regiones']) }}" class="work" style="background-image: url(new/images/btn_sanitario.png);">
						<div class="desc">
							<h3>Sanitario</h3>
							<span>Regiones sanitarias</span>
							<span>Establecimientos</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('educacion.index', ['tipo'=>'escuelas']) }}" class="work" style="background-image: url(new/images/btn_educacion.png);">
						<div class="desc">
							<h3>Educación</h3>
							<span>Escuelas</span>
							<span>Universidades y terciarios</span>
							<span>Consejeros escolares</span>
						</div>
					</a>
				</div>

				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('especial.index', ['tipo'=>'especial-escuelas']) }}" class="work" style="background-image: url(new/images/btn_discapacidad.png);">
						<div class="desc">
							<h3>Discapacidad</h3>
							<span>Establecimientos educativos</span>
							<span>Políticas locales</span>
						</div>
					</a>
				</div>

				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('cultura.index', ['tipo'=>'espacios-culturales']) }}" class="work" style="background-image: url(new/images/btn_cultura.png);">
						<div class="desc">
							<h3>Cultura</h3>
							<span>Espacios culturales</span>
						</div>
					</a>
				</div>
				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('medioambiente.index', ['tipo'=>'politicas-locales']) }}" class="work" style="background-image: url(new/images/btn_medioambiente.png);">
						<div class="desc">
							<h3>Medioambiente</h3>
							<span>Planes OPDS</span>
							<span>Políticas locales</span>
						</div>
					</a>
				</div>

				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2 text-center col-padding animate-box">
					<a href="{{ route('genero.index', ['tipo'=>'comisarias-mujer']) }}" class="work" style="background-image: url(new/images/btn_genero.png);">
						<div class="desc">
							<h3>Género</h3>
							<span>Comisarías de la mujer</span>
							<span>Espacios de contención</span>
							<span>Representatividad política</span>
						</div>
					</a>
				</div>

				<div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2  text-center col-padding animate-box">
					<a href="{{ route('geografia.index', ['tipo'=>'clima']) }}" class="work" style="background-image: url(new/images/btn_geografia.png);">
						<div class="desc">
							<h3>Geografía</h3>
							<span>Climas</span>
							<span>Suelos</span>
							<span>Vientos</span>
							<span>Cuencas hidrográficas</span>
							<span>Zonas hidrográficas</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>


	</body>



<!-- div class="container" id="home-container-main">        
        <div class="row">
            <div class="col-12">
                
                <section class="container-btn">                    
                    <a 
                        href="{{ route('municipios.index', ['tipo'=>'intendente']) }}" 
                        class="btn-home municipios"></a>

                    <a 
                        href="{{ route('politico.index', ['tipo'=>'gobernacion']) }}"
                        class="btn-home institucional" ></a>

                    <a 
                        href="{{ route('electoral.index', ['tipo'=>'resultados']) }}"
                        class="btn-home electoral"
                        ></a>
                    <a 
                        href="{{ route('economico.index') }}"
                        class="btn-home economico"></a>

                    <a 
                        href="{{ route('productivo.index', ['tipo'=>'agrupamientos-industriales']) }}"
                        class="btn-home productivo"></a>
                    
                    <a 
                        href="{{ route('vivienda.index', ['tipo'=>'asentamientos']) }}"
                        class="btn-home vivienda"></a>

                    <a 
                        href="{{ route('sanitario.index', ['tipo'=>'regiones']) }}"
                        class="btn-home sanitario"></a>

                    <a 
                        href="{{ route('educacion.index', ['tipo'=>'escuelas']) }}"
                        class="btn-home educacion"></a>

                    <a 
                        href="{{ route('cultura.index', ['tipo'=>'espacios-culturales']) }}"
                        class="btn-home cultura"></a>

                    <a 
                        href="{{ route('genero.index', ['tipo'=>'comisarias-mujer']) }}"
                        class="btn-home genero"></a>

                    <a 
                        href="{{ route('medioambiente.index', ['tipo'=>'politicas-locales']) }}"
                        class="btn-home ambiente"
                        ></a>

                    <a 
                        href="{{ route('geografia.index', ['tipo'=>'clima']) }}"
                        class="btn-home geografia"></a>
                </section>
            </div>            
        </div>
    </div> -->
@stop


@section('js')


    <script src="{{ asset('js/mapcontrol.js') }}"></script>
    	<!-- jQuery -->
	<script src="new/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="new/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="new/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="new/js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="new/js/jquery.stellar.min.js"></script>
	<!-- Easy PieChart -->
	<script src="new/js/jquery.easypiechart.min.js"></script>
	<!-- Google Map -->
	<script src="new/https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="new/js/google_map.js"></script>
	
	<!-- Main -->
	<script src="new/js/main.js"></script>
@stop
