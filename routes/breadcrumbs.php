<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

//---EMPLOYEES BREADCRUMBS---
// Home > Employees
Breadcrumbs::for('employees', function ($trail) {
    $trail->parent('home');
    $trail->push('/Empleados', route('employees.index'));
});

// Home > Employees > [Employee]
Breadcrumbs::for('employee', function ($trail, $employee) {
    $trail->parent('employees');
    $trail->push('/'.$employee->firstname.' '.$employee->lastname, route('employees.show', $employee));
});

// Home > Employee > Add
Breadcrumbs::for('employees.create', function ($trail) {
    $trail->parent('employees');
    $trail->push('/Agregar', route('employees.create'));
});

// Home > Employees > [Employee] > [Edit]
Breadcrumbs::for('edit', function ($trail, $employee) {
    $trail->parent('employee', $employee);
    $trail->push('/Editar', route('employees.edit', $employee));
});

// Home > Employees > [Employee] > [Positions]
Breadcrumbs::for('positions', function ($trail, $employee) {
    $trail->parent('employee', $employee);
    $trail->push('/Cargos', route('positions.show', $employee));
});

// Home > Employees > [Employee] > [Salaries]
Breadcrumbs::for('salaries', function ($trail, $employee) {
    $trail->parent('employee', $employee);
    $trail->push('/Salarios', route('salaries.show', $employee));
});

//---POSITIONS BREADCRUMBS---
// Home > Positions
Breadcrumbs::for('positions.index', function ($trail) {
    $trail->parent('home');
    $trail->push('/Cargos', route('positions.index'));
});

// Home > Positions > [Edit]
Breadcrumbs::for('positions.edit', function ($trail, $position) {
    $trail->parent('positions.index', $position);
    $trail->push('/'.$position->position_name, route('positions.edit', $position));
});

// Home > Positions > Add
Breadcrumbs::for('positions.create', function ($trail) {
    $trail->parent('positions.index');
    $trail->push('/Agregar', route('positions.create'));
});

//---BRANDS BREADCRUMBS---
// Home > Brands
Breadcrumbs::for('brands.index', function ($trail) {
    $trail->parent('home');
    $trail->push('/Marcas', route('brands.index'));
});

// Home > Brand > [Edit]
Breadcrumbs::for('brands.edit', function ($trail, $brand) {
    $trail->parent('brands.index', $brand);
    $trail->push('/'.$brand->name,   route('brands.edit', $brand));
});

// Home > Brands > Add
Breadcrumbs::for('brands.create', function ($trail) {
    $trail->parent('brands.index');
    $trail->push('/Agregar', route('brands.create'));
});

//---CUSTOMERS BREADCRUMBS---
// Home > Customers
Breadcrumbs::for('customers.index', function ($trail) {
    $trail->parent('home');
    $trail->push('/Clientes', route('customers.index'));
});

// Home > Customer > [Edit]
Breadcrumbs::for('customers.edit', function ($trail, $customer) {
    $trail->parent('customers.index', $customer);
    $trail->push('/'.$customer->name, route('customers.edit', $customer));
});

// Home > Customers > Add
Breadcrumbs::for('customers.create', function ($trail) {
    $trail->parent('customers.index');
    $trail->push('/Agregar', route('customers.create'));
});

//---COUNTRIES BREADCRUMBS---
// Home > Countries
Breadcrumbs::for('countries.index', function ($trail) {
    $trail->parent('home');
    $trail->push('/Paises', route('countries.index'));
});

// Home > Country > [Edit]
Breadcrumbs::for('countries.edit', function ($trail, $country) {
    $trail->parent('countries.index', $country);
    $trail->push('/'.$country->name, route('countries.edit', $country));
});

// Home > Countries > Add
Breadcrumbs::for('countries.create', function ($trail) {
    $trail->parent('countries.index');
    $trail->push('/Agregar', route('countries.create'));
});

//---DEPARTMENTS BREADCRUMBS---
// Home > Departments
Breadcrumbs::for('departments.index', function ($trail) {
    $trail->parent('home');
    $trail->push('/Departamentos', route('departments.index'));
});

// Home > Department > [Edit]
Breadcrumbs::for('departments.edit', function ($trail, $department) {
    $trail->parent('departments.index', $department);
    $trail->push('/'.$department->department_name, route('departments.edit', $department));
});

// Home > Departments > Add
Breadcrumbs::for('departments.create', function ($trail) {
    $trail->parent('departments.index');
    $trail->push('/Agregar', route('departments.create'));
});

//---PROJECT BREADCRUMBS---
// Home > Projects
Breadcrumbs::for('projects.index', function ($trail) {
    $trail->parent('home');
    $trail->push('/Proyectos', route('projects.index'));
});

// Home > Project > [Edit]
Breadcrumbs::for('projects.edit', function ($trail, $project) {
    $trail->parent('projects.index', $project);
    $trail->push('/'.$project->title, route('projects.edit', $project));
});

// Home > Projects > Add
Breadcrumbs::for('projects.create', function ($trail) {
    $trail->parent('projects.index');
    $trail->push('/Agregar', route('projects.create'));
});

//---DAILYREPORT BREADCRUMBS---
// Home > DailyReport
Breadcrumbs::for('dailyreports.index', function ($trail) {
    $trail->parent('home');
    $trail->push('/Reportes Diarios', route('dailyreports.index')); 
});

// Home > DailyReport > Import
Breadcrumbs::for('dailyreports.addfile', function ($trail) {
    $trail->parent('dailyreports.index');
    $trail->push('/Importar', route('dailyreports.addfile'));
});

//---REGISTER BREADCRUMBS---
// Home > Register

