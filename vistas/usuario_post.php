<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['acceso']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Usuarios </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tblistado_coments" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
 
      <th>ID</th>
      <th>USER ID</th>
      <th>TITLE</th>
      <th>BODY</th>
      <th>ACCION</th>
   
     
    </thead>
    <tbody>
    </tbody>
   
  </table>
</div>


  <!--Modal para CRUD-->
  <div id="modalCRUD" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>                
                </div>
                <form id="formComentarios">    
                    <div class="modal-body">                
                            <input id="id" hidden>

                 

                            <label for="" class="col-form-label">User ID:</label>
                            <input type="text" class="form-control" id="user_id">


                            <label for="" class="col-form-label">title:</label>
                            <input type="text" class="form-control" id="title">
                        
                            <label for="" class="col-form-label">body</label>
                            <input id="body" type="text"  class="form-control">
                        
                                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>  

 
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php';
 ?>
 <script src="scripts/usuario.js"></script>
 <?php 
}

ob_end_flush();
  ?>
