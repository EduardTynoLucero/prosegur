<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Usuario{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos){
	$sql="INSERT INTO usuario (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,login,clave,imagen,condicion) VALUES ('$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$login','$clave','$imagen','1')";
	//return ejecutarConsulta($sql);
	 $idusuarionew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos){
	$sql="UPDATE usuario SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' 
	WHERE idusuario='$idusuario'";
	 ejecutarConsulta($sql);

	 //eliminar permisos asignados
	 $sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
	 ejecutarConsulta($sqldel);

	 	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES('$idusuario','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}


///////////////////////////////////

public function busca_id_existente_user($idusuario){


	$sql = "SELECT * FROM usuario_api WHERE id = '$idusuario' ";
	//echo $idusuario;
	return  ejecutarConsultaSimpleFila($sql);
}



public function busca_id_existente($idusuario,$title, $body){


	$sql = "SELECT * FROM usuario_comentario_api WHERE id_coment = '$idusuario' ";
	//echo $idusuario;
	return  ejecutarConsultaSimpleFila($sql);
}

public function editar_comentario($idusuario,$title, $body){

		
	$sql=" UPDATE usuario_comentario_api SET  title='$title',body='$body' 
	WHERE id_coment='$idusuario'";
	ejecutarConsulta($sql);
}

public function editar_user($iduser,$name_user, $email, $gender){

		
	$sql=" UPDATE usuario_api SET  name ='$name_user', email ='$email', gender ='$gender' 
	WHERE id='$iduser'";
	ejecutarConsulta($sql);
}


public function crear_comentario($idusuario,$user_id, $title, $body){

		
	$sql=" INSERT INTO usuario_comentario_api (id_coment, user_id,title, body) VALUES($idusuario, $user_id,'$title', '$body'); "; 
	ejecutarConsulta($sql);
}

public function crear_user_apis($iduser,$name_user, $email, $gender){

		
	$sql=" INSERT INTO usuario_api (id, name,email, gender) VALUES($iduser, '$name_user','$email', '$gender'); "; 
	ejecutarConsulta($sql);
}



////////////////////////////////////////////////
public function desactivar($idusuario){
	$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}
public function activar($idusuario){
	$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idusuario){
	$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM usuario";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($idusuario){
	$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//funcion que verifica el acceso al sistema

public function verificar($login,$clave){

	$sql="SELECT idusuario,nombre,tipo_documento,num_documento,telefono,email,cargo,imagen,login FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";
	 return ejecutarConsulta($sql);

}
}

 ?>
