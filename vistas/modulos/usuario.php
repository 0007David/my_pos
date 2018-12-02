
<section class="content">  
  <section class="content-header">
    
    <h1>
      
      Administrar usuarios
      <small>insertar, eliminar, editar usuario</small>
    
    </h1>


    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Mantenimiento</li>
      <li class="active">Administrar Usuarios</li>
      

    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          Agregar usuario

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaUsuario">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Perfil</th>
           <th>correo</th>
           <th>Telefono</th>
           <th>Estado</th>
           <th>Acciones</th>
           <th>Último login</th>
           
         </tr> 

        </thead>

        <tbody>

      <?php 

        $respuesta = ControladorUsuario::mostrarUsuarios(null);

        // var_dump($respuesta);

        $indice=0;
        foreach ($respuesta as $key => $value) {
          if($value["estado"] != 2){

            $indice +=1;

            echo '

            <tr>
            <td>'.$indice.'</td>
            <td>'.$value["nombre"].'</td>
            <td>'.$value["nombre_usuario"].'</td>';

            if( is_null($value["foto"])){

              echo '<td><img src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail" width="50px"></td>';


            }else{

              echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="50px"></td>';

            }

            
            echo '<td>'.$value["perfil"].'</td>
            <td>'.$value["correo"].'</td>
            <td>'.$value["telefono"].'</td>';

            if($value["estado"] == 0){

            echo '<td><button class="btn btn-success btn-sm">Activado</button></td>
            <td>';

            }else{

            echo '<td><button class="btn btn-warning btn-xs">Desactivo</button></td>
            <td>';

            }

            echo '
              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>';

            $fecha = new dateTime($value["ultimoLogin"]);

            $mostrarFecha = $fecha->format('d-m-Y H:i:s');

            echo'<td>'.$mostrarFecha.'</td>

          </tr>';

          }
          
        
        }//end of foreach  
            
        ?>
           

         </tbody>

          <tfoot>
         
            <tr>
             
             <th style="width:10px">#</th>
             <th>Nombre</th>
             <th>Usuario</th>
             <th>Foto</th>
             <th>Perfil</th>
             <th>correo</th>
             <th>Telefono</th>
             <th>Estado</th>
             <th>Acciones</th>
             <th>Último login</th>

           </tr> 

        </tfoot>


        

       </table>

      </div>

    </div>

  </section>

</section>


<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" id="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 200 MB</p>

              <img src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

      </form>

    </div>

  </div>

</div>

