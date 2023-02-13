var tabla;

//funcion que se ejecuta al inicio
function init(){

   listar();
   listar_comentarios();

  
}

//funcion listar
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax": {
			"url": "https://gorest.co.in/public/v2/users",
			"dataSrc": ""
		},
	   "columns": [
		   { "data": "id" },
		   { "data": "name" },
		   { "data": "email" },
		   { "data": "gender", },
		   { "data": "status", },
		   {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditarUser'>Editar</button>"}
		
	   ],
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}

//funcion listar
function listar_comentarios(){
	tabla_comentarios=$('#tblistado_coments').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax": {
			"url": "https://gorest.co.in/public/v2/posts",
			"dataSrc": ""
		},
	   "columns": [
		   { "data": "id" },
		   { "data": "user_id" },
		   { "data": "title" },
		   { "data": "body", },
		   {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar'>Editar</button>"}
		
	   ],
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}

$(document).on("click", ".btnEditarUser", function(){		            
	opcion='editar';
	fila = $(this).closest("tr");	        
	id = parseInt(fila.find('td:eq(0)').text());
	name_user = parseInt(fila.find('td:eq(1)').text());
	email = fila.find('td:eq(2)').text();
	gender = fila.find('td:eq(3)').text();
	  
	$("#id1").val(id);
	$("#name_user").val(name_user);
	$("#email").val(email);
	$("#gender").val(gender);            
	$(".modal-header").css("background-color", "#7303c0");
	$(".modal-header").css("color", "white" );
	$(".modal-title").text("Editar Usuarios");		
	$('#modalCRUD1').modal('show');		   
});

$(document).on("click", ".btnEditar", function(){		            
	opcion='editar';
	fila = $(this).closest("tr");	        
	id = parseInt(fila.find('td:eq(0)').text());
	user_id = parseInt(fila.find('td:eq(1)').text());
	title = fila.find('td:eq(2)').text();
	body = fila.find('td:eq(3)').text();
	  
	$("#id").val(id);
	$("#user_id").val(user_id);
	$("#title").val(title);
	$("#body").val(body);            
	$(".modal-header").css("background-color", "#7303c0");
	$(".modal-header").css("color", "white" );
	$(".modal-title").text("Editar Comentarios");		
	$('#modalCRUD').modal('show');		   
});


//submit para el CREAR y EDITAR
$('#formUser').submit(function(e){                                     
	e.preventDefault();
	id_user = $.trim($('#id1').val());    
	name_user = $.trim($('#name_user').val());    
	email = $.trim($('#email').val());
	gender = $.trim($('#gender').val());    
           
	let url = '../ajax/usuario.php?op=editar_user';
	if(opcion=='editar'){
		console.log("EDITAR");

		$.post(url , {id_user : id_user, name_user : name_user, email : email, gender : gender}, function(e){
			bootbox.alert(e);
			tabla.ajax.reload();
		});
	}        		        
	$('#modalCRUD1').modal('hide');											     			
});



  //submit para el CREAR y EDITAR
  $('#formComentarios').submit(function(e){                                     
	e.preventDefault();
	id = $.trim($('#id').val());    
	user_id = $.trim($('#user_id').val());    
	title = $.trim($('#title').val());
	body = $.trim($('#body').val());    
           
	let url = '../ajax/usuario.php?op=editar_comentario';
	if(opcion=='editar'){
		console.log("EDITAR");

		$.post(url , {id : id, title : title, body : body, user_id, user_id}, function(e){
			bootbox.alert(e);
			tabla.ajax.reload();
		});


	/* 	$.ajax({                    
			url: url,
			method: 'POST',                                        
			contentType: 'application/json',  
			data:  JSON.stringify({id:id, body:body,title:title}),                       
			success: function(data) {                       
				tabla_comentarios.ajax.reload(null, false);                        
			}
		}); */	
	}        		        
	$('#modalCRUD').modal('hide');											     			
});
init();