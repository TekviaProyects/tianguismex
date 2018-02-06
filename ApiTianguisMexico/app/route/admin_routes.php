<?php
use App\Model\AdministradorModel;


$app->group('/administrador/',function(){
  $this->get('test',function($req,$res,$args){
    return $res->getBody()->write("Hola");
  });
  $this->get('existe_usuario/{correo}/{contrasena}',function($req,$res,$args){
    $am = new AdministradorModel();
    $resultado = $am->ComprobarUsuario($args['correo'],$args['contrasena']);
    if($resultado->result == "false"){
      return $res
             ->withHeader('Content-type', 'application/json')
             ->withStatus(400);
    }else{
      return $res
             ->withHeader('Content-type', 'application/json')
             ->getBody()
             ->write(json_encode($resultado));
    }

  });
  $this->get('existe_correo/{correo}',function($req,$res,$args){
    $am = new AdministradorModel();
    return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(json_encode($am->ComprobarCorreo($args['correo'])));
  });
  $this->get('comprobar_cuenta/{id}',function($req,$res,$args){
    $am = new AdministradorModel();
    return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(json_encode($am->ValidarCorreo($args['id'])));
  });





  $this->post('nuevo_administrador', function ($req, $res) {
    $am = new AdministradorModel();
    return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $am->NuevoAdministrador(
                    $req->getParsedBody()
                )
            )
        );
  });

});
