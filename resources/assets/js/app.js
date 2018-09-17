
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// $(document).ready(function() {
// 	var currentUrl = window.location.pathname;
// 	if(currentUrl == '/employees') {
// 	  $('#v-pills-employee-tab').trigger('click');
// 	}
// });

// $('#v-pills-employee-tab, #v-pills-position-tab, #v-pills-country-tab, #v-pills-department-tab, #v-pills-dailyreport-tab, #v-pills-dailyreportshow-tab').on('click', function(e){
//  	e.preventDefault();
//  	var html = '';
//  	$('#master').html('');
//  	var ajax = $(this).attr('data-ajax');
//  	switch(ajax) {
//     case 'employee':
//         var url = '/employees-all';
// 		var data = '';
// 		var header = '';
// 		var type = 'GET';
// 		var flag = '1';
// 		break;
//     case 'position':
//         var url = '/positions';
// 	var data = '';
// 	var header = '';
// 	var type = 'GET';
// 	var flag = '2';
//         break;
//     case 'country':
// 	    var url = '/countries';
// 	var data = '';
// 	var header = '';
// 	var type = 'GET';
// 	var flag = '2';
// 	    break;
//     case 'department':
// 	    var url = '/departments';
// 	var data = '';
// 	var header = '';
// 	var type = 'GET';
// 	var flag = '2';
// 	    break;
//     case 'dailyreport':
// 	    var url = '/dailyreports';
// 	var data = '';
// 	var header = '';
// 	var type = 'GET';
// 	var flag = '3';
// 	    break;	
//     case 'dailyreportshow':
// 	    var url = '/employees';
// 	var data = '';
// 	var header = '';
// 	var type = 'GET';
// 	var flag = '3';
// 	    break;
//     default:
//     console.log();
// }
	
// 	var resultado = sendData(url, data, header, type, flag);
	
// });

// function sendData(url, data, header, type, flag) {
// 	if(header) {
// 		$.ajaxSetup({
// 			headers: {
// 				'X-CSRF-TOKEN': header
// 			}
// 		});
// 	}
// 	$.ajax({
// 		url: url,
// 		type: type,
// 		data: data,
// 		beforeSend: function() {
// 			console.log('enviando')
// 		}
// 	})
// 	.done(function(dataResponse) {
// 		//console.log(dataResponse);
// 		switch(flag){
// 			case '1':
// 			var link = "{{action('EmployeeController@show', $employee['id'])}}";
// 			var html = '<table>';
//         	html += '<thead>';
//         	html += '<tr>';
//         	html += '<td>Nombre</td>';
//         	html += '<td>Apellido</td>';
//         	html += '<td>Cédula de identidad</td>';
//         	html += '<td>Action</td>';
//         	html += '</tr>';
//         	html += '</thead>';
//         	html += '<tbody>';
//             $.each(dataResponse, function(index, value) {
//             	html += '<tr>';
// 	            html += '<td>'+value.firstname+'</td>';
// 	            html += '<td>'+value.lastname+'</td>';
// 	            html += '<td>'+value.ci+'</td>'; //Para llamar al controlador usar <url: ruta/direccion y $(this).>
// 	            html += '<td><a href="link" id="showemployee" class="btn btn-success btn-sm">Ver</a></td>';
// 	            html += '</tr>';
//         	})
//         	html += '</tbody>';
//     		html += '</table>';
// 				break;
// 			case '2':
// 			var html = '<table>';
//         	html += '<thead>';
//         	html += '<tr>';
//         	html += '<td>ID</td>';
//         	html += '<td>Action</td>';
//         	html += '</tr>';
//         	html += '</thead>';
//         	html += '<tbody>';
//             $.each(dataResponse, function(index, value) {
//             	html += '<tr>';
// 	            html += '<td>'+value.id+'</td>';
// 	            html += '<td><a href="https://www.w3schools.com/jquery/" class="btn btn-warning btn-sm">Edit</a></td>';
// 	            html += '<td><a href="https://www.w3schools.com/jquery/" class="btn btn-danger btn-sm">Delete</a></td>';
// 	            html += '</tr>';
//         	})
//         	html += '</tbody>';
//     		html += '</table>';
// 				break;
// 			case '3':
// 			var html = '<select>';
// 			$.each(dataResponse, function(index, value){
// 			html += '<option>'+value.firstname+' '+value.lastname+'</option>';	
// 			})
// 			html += '</select>';
// 			html += '<input type="date">';
// 			html += '<input type="date">';
// 			html += '<button type="submit">Submit</button>';
// 				break;
// 			default:
//     		var html ='No entro';
// 		}
// 		$('#master').append(html);
// console.log(html);
// 	})
// 	.fail(function() {
// 	})
	
// }