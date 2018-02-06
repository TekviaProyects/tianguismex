<?php
              $fechahoy = date("Y-m-d");
			        $insertar9 = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE estado_pago='1'";
              $consulta=mysqli_query($conexion,$insertar9);
              while ($row=mysqli_fetch_array($consulta)) {
              $id_local=$row['nombre_local'];
              $nombre_cliente=$row['nombre_cliente'];
              $celular_cliente=$row['celular_cliente'];
              $correo_cliente=$row['correo_cliente'];
              $domicilio_cliente=$row['domicilio_cliente'];
              $ife=$row['identificacion_cliente'];
                  echo "<tr><td>LOCAL $id_local</td>";
                  echo "<td>$nombre_cliente</td>";
                  echo "<td>$celular_cliente</td>";
                  echo "<td class='centroSU'>
                  <button type='submit' class='ui button' id='btn$id_local'><i class='fa fa-user naranja' aria-hidden='true'></i>
                  </button>
                  <script>
                  $(document).ready(function() {
                  $('#btn$id_local').click(function(){
                  $('#localito').html('LOCAL $id_local');
                  $('#nombrecito').html('$nombre_cliente');
                  $('#celularcito').html('$celular_cliente');
                  $('#correoito').html('$correo_cliente');
                  $('#direccioncita').html('$domicilio_cliente');
                  $('#imagencita').html('$cadena1$ife$cadena2');
                  $('#modalito')
                  .modal('show');
                  });
                  });
                  </script>
                  </td></tr>";
            }
                  ?>