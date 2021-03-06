
<section class="content"> 

  <section class="content-header">
    
    <h1>
      
      Administrar empleados
      <small>insertar, eliminar, editar empleados</small>
    
    </h1>


    <ol class="breadcrumb">
      
      <li><a href="index.php?inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Mantenimiento</li>
         
      <li class="active">Administrar empleados</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalInsertarEmpleado">
          
          Agregar empleado

        </button>

      </div>

      <div class="box-body">
        
       <table id="mitable" class="table table-bordered table-striped mitable">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>CI</th>
           <th>Nombre</th>
           <th>Foto</th>
           <th>Correo</th>
           <th>Dirreccion</th>
           <th>Telefono</th>
           <th>Estado</th>
           <th>Operación</th>
           <th>Fecha Ingreso</th>


         </tr> 

        </thead>

       

        <tbody>

        
          
          
       <?php

          $valor = null;

          $empleados = ControladorEmpleado::mostrarEmpleados($valor);

          // $empleados1 = ControladorEmpleado::actualizarUnaColumna('idpersona',59,'estado','0');
          // echo '<script> console.log("'.$empleados1.'"); </script>';

        
          $indice=0;
          foreach ($empleados as $key => $value) {

            if($value["estado"] != 2){//no muestra los eliminados | estado=2 :esta eliminado

              $indice +=1;

              echo '<tr>
                            <td>'.$indice.'</td>
                            <td>'.$value["ci"].'</td>
                             <td>'.$value["nombre"].'</td>';

                    if(is_null($value["foto"])){ // foto == null

                      echo '<td><img src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                    }else{

                      echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                    }

                    echo '<td>'.$value["correo"].'</td>
                          <td>'.$value["direccion"].'</td>
                          <td>'.$value["telefono"].'</td>';

                    if($value["estado"]==0){//empleado activo

                      echo '<td><button idEmpleado="'.$value["idpersona"].'" attrEstado="1" class="btn btn-success btn-sm btnEstadoEmpleado">Activo</button></td>';

                    }else{//empleado desactivo estado=1

                      echo '<td><button  idEmpleado="'.$value["idpersona"].'" attrEstado="0" class="btn btn-danger btn-sm btnEstadoEmpleado">Desactivo</button></td>';

                    }
                    //botones de operaciones
                    echo '<td>

                            <div class="btn-group">
                                
                              <button ciEmpleado="'.$value["ci"].'" class="btn btn-warning  btnEditarEmpleado" data-toggle="modal" data-target="#modalEditarEmpleado"><i class="fa fa-edit"></i></button>

                              <button idEmpleado="'.$value["idpersona"].'"  class="btn btn-danger btnEliminarEmpleado"><i class="fa fa-trash"></i></button>

                            </div>  

                         </td>';

                    $fechaMostrar = new dateTime($value["fechaInsertado"]);

                    $fechaMostrar = $fechaMostrar->format("d-m-Y");

                    echo '<td>'.$fechaMostrar.'</td>
                </tr>';

            }

        }

     ?> 


        </tbody>

         <tfooter>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>CI</th>
           <th>Nombre</th>
           <th>Foto</th>
           <th>Correo</th>
           <th>Dirreccion</th>
           <th>Telefono</th>
           <th>Estado</th>
           <th>Operación</th>
           <th>Fecha Ingreso</th>


         </tr> 

        </tfooter>

       </table>

      </div>

    </div>

  </section>

</section>


<!--=====================================
MODAL AGREGAR EMPLEADO
======================================-->

<div id="modalInsertarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data"> <!--entype="multipart/form-data" enviar datos tipos archivos-->

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar Empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL Ci -->
            
            <div class="form-group mostar">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-registered"></i></span> 

                <input type="text" class="form-control input-lg" id="insertarCI" name="nuevoCiEmpleado" placeholder="Ingresar ci" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="insertarNombre"  name="nuevoNombreEmpleado" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" id="insertarCorreo" name="nuevoCorreoEmpleado" placeholder="Ingresar correo" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" id="insertarDireccion" name="nuevoDireccionEmpleado" placeholder="Ingresar dirección" required>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="insertarTelefono" name="nuevoTelefonoEmpleado" placeholder="Ingresar telefono" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel"> SUBIR FOTO  <i class="fa fa-image"></i></div>

              <input type="file" id="editarFotoEmpleado" name="nuevaFotoEmpleado">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img id="previsualizar" src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

          

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Guardar</button>

          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Salir</button>

        </div>
    <?php

        $empleado = new ControladorEmpleado();


        $empleado->insertarEmpleado();


    ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data"> <!--entype="multipart/form-data" enviar datos tipos archivos-->

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar Empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL Ci -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-registered"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCiEmpleado"  name="editarCiEmpleado" placeholder="Ingresar ci" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombreEmpleado" name="editarNombreEmpleado" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" id="editarCorreoEmpleado" name="editarCorreoEmpleado" placeholder="Ingresar correo" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDireccionEmpleado" name="editarDireccionEmpleado" placeholder="Ingresar dirección" required>

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTelefonoEmpleado" name="editarTelefonoEmpleado" placeholder="Ingresar telefono" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel"> SUBIR FOTO  <i class="fa fa-image"></i></div>

              <input type="file" id="nuevaFotoEmpleado" name="editarFotoEmpleado">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img id="previsualizar" src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" id="fotoActualEditar" name="fotoActual" >


            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Guardar</button>

          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Salir</button>

        </div>
      

      </form>
        <?php

            $empleado = new ControladorEmpleado();


            $empleado->editarEmpleado();


        ?>

    </div>

  </div>

</div>


<?php

   $empleado =  ControladorEmpleado::eliminarEmpleado();


?>

