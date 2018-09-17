<div class="row">
	<div class="col-3">
		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"><br>
			<a class="nav-link active" data-ajax="home" id="v-pills-home-tab" href="{{action('HomeController@index')}}">
				Home
			</a><br>
			<a class="nav-link" data-ajax="employee" id="v-pills-employee-tab" href="{{action('EmployeeController@index')}}">
				Empleados
			</a><br>
			@if(auth()->user()->isAdmin == 1)
			<a class="nav-link" data-ajax="position" id="v-pills-position-tab" href="{{action('PositionController@index')}}">
				Cargos
			</a><br>
			@endif
			<a class="nav-link" data-ajax="brand" id="v-pills-brand-tab" href="{{action('BrandController@index')}}">
				Marcas
			</a><br>
			<a class="nav-link" data-ajax="customer" id="v-pills-customer-tab" href="{{action('CustomerController@index')}}">
				Clientes
			</a><br>
			@if(auth()->user()->isAdmin == 1)
			<a class="nav-link" data-ajax="country" id="v-pills-country-tab" href="{{action('CountryController@index')}}">
				Paises
			</a><br>
			<a class="nav-link" data-ajax="department" id="v-pills-department-tab" href="{{action('DepartmentController@index')}}">
				Departamentos
			</a><br>
			@endif
			<a class="nav-link" data-ajax="project" id="v-pills-project-tab" href="{{action('ProjectController@index')}}">
				Proyectos
			</a><br>			
			<a class="nav-link" data-ajax="dailyreport" id="v-pills-dailyreport-tab" href="{{action('DailyreportController@index')}}">
				Reportes
			</a><br>
			@if(auth()->user()->isAdmin == 1)
			<a class="nav-link" data-ajax="dailyreportshow" id="v-pills-dailyreportshow-tab" href="{{action('DailyreportController@showimport')}}">
				Importar Reportes
			</a>
			@endif
		</div>
	</div>
