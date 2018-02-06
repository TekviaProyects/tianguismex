<?php
namespace App\Model;

use App\Lib\Database;
use App\Lib\Response;
use App\Lib\Mail;

class AdministradorModel
{
    private $db;
    private $mail;
    private $table = 'administradores';
    private $response;

    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
        $this->mail = new Mail();
    }
    public function ComprobarUsuario($correo,$contrasena){
      try{
        $stm = $this->db->prepare("SELECT correo_administrador, id_administrador, tipo_administrador, estado_cuenta, estado_informacion FROM $this->table WHERE correo_administrador = ? AND contrasena_administrador = ?");
        $stm->execute(array($correo,$contrasena));
        $this->response->setResponse(true);
        if($stm->rowCount()>0){
          $this->response->result = $stm->fetch();
        }else{
          $this->response->result = "false";
        }
        return $this->response;
      }catch(Exception $e){
        $this->response->setResponse(false, $e->getMessage());
        return $this->response;
      }
    }
    public function ValidarCorreo($id){
      try{
        $stm = $this->db->prepare("UPDATE $this->table SET estado_cuenta = 1 WHERE id_administrador = ?");
        $stm->execute(array($id));
        $this->response->setResponse(true);
        $this->response->result = "true";
        return $this->response;
      }catch(Exception $e){
        $this->response->setResponse(false, $e->getMessage());
        return $this->response;
      }
    }
    public function ComprobarCorreo($correo){
      try{
        $stm = $this->db->prepare("SELECT correo_administrador FROM $this->table WHERE correo_administrador = ?");
			  $stm->execute(array($correo));
        $this->response->setResponse(true);
        if($stm->rowCount()>0){
          $this->response->result = "true";
        }else{
          $this->response->result = "false";
        }
        return $this->response;
      }catch(Exception $e){
        $this->response->setResponse(false, $e->getMessage());
        return $this->response;
      }
    }
    public function NuevoAdministrador($administrador){
      try{
        $sql = "INSERT INTO $this->table (correo_administrador,contrasena_administrador,tipo_administrador,estado_cuenta) VALUES (?,?,?,?)";
        $this->db->prepare($sql)
             ->execute(array(
               $administrador['correo'],
               $administrador['contrasena'],
               $administrador['tipo'],
               $administrador['estado']
             ));

        $this->mail->checkMail($this->db->lastInsertId(),$administrador['correo']);

        $this->response->setResponse(true);
        $this->response->result = "true";
        $this->response->message = "Administrador guardado";
        return $this->response;

      }catch(Exception $e){
        $this->response->setResponse(false, $e->getMessage());
        return $this->response;
      }
    }


}
