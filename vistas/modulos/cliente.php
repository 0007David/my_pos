    <!-- Main content -->
    <section class="content">

      <section class="content-header">

          <h1>

            Administrar clientes

            <small>Insertar clientes, editar</small>

          </h1>

          <ol class="breadcrumb">

            <li>
              
              <a href="index.php?inicio">
                
                <i class="fa fa-dashboard"></i>

                Inicio

              </a>

            </li>

            <li class="active">
              
              <a href="#">
                
                Ventas

              </a>

            </li>

             <li class="active">
              
              <a href="#">
                
                Administar clientes

              </a>

            </li>

          </ol>

      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->
          <div class="box ">

                <div class="box-header with-border">
                    <!--button disparador del modal-->
                    <button class="btn btn-primary btn-md" type="button" data-toggle="modal" data-target="#modalInsertarCliente">Insertar Cliente</button>
           
                </div>

                <div class="box-body">

                  <?php

                    $valor= null;  

                    $respuesta = ControladorCliente::mostrarClientes($valor);

                     // var_dump($respuesta);


                  ?>
                   
                      <table id="mitable" class="table table-bordered table-striped mitable">
                        
                        <thead>

                            <tr>

                              <th style="width: 10px;">#</th>
                              <th>CI</th>
                              <th>Nombre</th>
                              <th>Correo</th>
                              <th>Telefono</th>
                              <th>Estado</th>
                              <th>Operaciones</th>
                              <th>Ultima Compra</th>
                              <th>Fecha Ingreso</th>

                            </tr>

                        </thead>

                        <tbody>
                            <?php
                            
                            foreach ($respuesta as $key => $value) {
                
                                
                              echo "<tr>

                                        <td style='width: 10px;' >".($key+1)."</td>
                                        <td>".$value['ci']."</td>
                                        <td class='text-capitalize'>".$value['nombre']."</td>
                                        <td>".$value['correo']."</td>
                                        <td>".$value['telefono']."</td>";

                                        if($value['estado'] == 1){

                                          echo"<td> 
                                                 <div class='btn-group'>
                                                    <button idEstadoCliente='".$value['idpersona']."' estado='0' class='btn btn-warning btn-sm btnEstado'>Desactivo</buton>
                                                  </div>

                                              </td>";

                                        }else{

                                          echo"<td>
                                                  <button idEstadoCliente='".$value['idpersona']."' estado='1' class='btn btn-success btn-sm btnEstado'>Activo</buton>
                                                </td>";


                                        }

                                        echo " <td> 
                                                <div class='btn-group'>

                                                  <button ciCliente='".$value['ci']."' class='btn btn-info btn-md btnEditarCliente' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil'></i></buton>

                                                  <button idCliente='".$value['idpersona']."' class='btn btn-danger btn-md btnEliminarCliente'><i class='fa fa-trash'></i></buton>

                                               </div>
                                            </td>";

                                    
                                        $fecha1 = new dateTime($value['ultimaCompra']);
                                        $fecha2 = new dateTime($value['fechaInsertado']);

                                        $fechamostrar1=$fecha1->format("d-m-Y H:i:s");
                                        $fechamostrar2=$fecha2->format("d-m-Y");
                                        echo "<td>".$fechamostrar1."</td>
                                             <td>".$fechamostrar2."</td>

                               </tr>";
                             
                            }//end foreach

                            ?>
                        </tbody>

                        <tfoot>

                            <tr>
                              <th style="width: 10px;">#</th>
                              <th>CI</th>
                              <th>Nombre</th>
                              <th>Correo</th>
                              <th>Telefono</th>
                              <th>Estado</th>
                              <th>Operaciones</th>
                              <th>Ultima Compra</th>
                              <th>Fecha Ingreso</th>
                            </tr>

                        </tfoot>

                      </table>
                                    

                </div>

                

          </div>
          

      </section>

</section>

<!-- ============================================================
=            Modal para Insertar un nuevo Cliente            =
   ============================================================-->

<div id="modalInsertarCliente" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

      <form class="form-horizontal" rol="form" method="post">  
        <!--contenido modal-->
        <div class="modal-content">
          
              <div class="modal-header" style="background-color: #3c8dbc;">

                  <button type="button" class="close" data-dismiss="modal">&times</button>

                  <h4 style="color: #ffff; font-size: 20px;" class="modal-title text-center">Agregar Cliente</h4>

              </div>

              <div class="modal-body">
                  
            

                          <div class="box-body">
                                <!-- campo para el CI -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">CI</label>


                                    <div class="col-sm-10">

                                      <input type="text" class="form-control inputCi" name="insertarCi" id="insertarCi" placeholder="Ingrese su ci" required>

                                    </div>

                                </div>

                                <!-- campo para el nombre -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">Nombre</label>

                                    <div class="col-sm-10">

                                      <input type="text" class="form-control" name ="insertarNombre" id="insertarNombre" placeholder="Ingrese su nombre" required>

                                    </div>

                                </div>

                                <!-- campo para el telefono -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">Telefono</label>

                                    <div class="col-sm-10">

                                      <input type="text" class="form-control" name="insertarTelefono" id="insertarTelefono" placeholder="inserte su telefono" required>

                                    </div>

                                </div>

                                <!-- campo para el CORREO  -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">correo</label>

                                    <div class="col-sm-10">

                                      <input type="email" class="form-control" name="insertarCorreo" id="insertarCorreo" placeholder="Ingrese su correo" required>

                                    </div>

                                </div>

                          </div>

                     

              </div>

              <div class="modal-footer" >

                <button type="submit" class="btn btn-primary btn-md">Guardar</button>
                
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>

              </div>

          </form>
          <?php 

             $insertar = new ControladorCliente();
             $insertar->insertarCliente();


           ?>
          

        </div>

    </div> 

</div>

<!-- ============================================================
=            Modal para Editar un Cliente            =
   ============================================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

      <form class="form-horizontal" rol="form" method="post">  
        <!--contenido modal-->
        <div class="modal-content">
          
              <div class="modal-header" style="background-color: #3c8dbc;">

                  <button type="button" class="close" data-dismiss="modal">&times</button>

                  <h4 style="text-align: center; color: #ffff; font-size: 18px;" class="modal-title">Editar Cliente</h4>

              </div>

              <div class="modal-body">
                  
            

                          <div class="box-body">
                                <!-- campo para el CI -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">CI</label>


                                    <div class="col-sm-10">

                                      
                                      <input type="text" class="form-control" name="editarCi" id="editarCi" placeholder="Ingrese su ci" required>
                                      <!-- <input type="hidden" id="idEditar" name="idEditar" > -->

                                    </div>

                                </div>

                                <!-- campo para el nombre -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">Nombre</label>

                                    <div class="col-sm-10">

                                      <input type="text" class="form-control" name ="editarNombre" id="editarNombre" placeholder="Ingrese su nombre" required>

                                    </div>

                                </div>

                                <!-- campo para el CORREO  -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">correo</label>

                                    <div class="col-sm-10">

                                      <input type="email" class="form-control" name="editarCorreo" id="editarCorreo" placeholder="Ingrese su correo" required>

                                    </div>

                                </div>

                                <!-- campo para el telefono -->
                                <div class="form-group">

                                    <label class="col-sm-2 control-label">Telefono</label>

                                    <div class="col-sm-10">

                                      <input type="text" class="form-control" name="editarTelefono" id="editarTelefono" placeholder="inserte su telefono" required>

                                    </div>

                                </div>

                                

                          </div>

                     

              </div>

              <div class="modal-footer" >

                <button type="submit" class="btn btn-primary btn-md">Editar</button>
                
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>

              </div>

          </form>
           <?php 

             $editar = new ControladorCliente();
             $editar->editarCliente();




           ?>
          

        </div>

    </div> 

</div>

<?php 

      $eliminar = new ControladorCliente();
      $eliminar->eliminarCliente();


?>