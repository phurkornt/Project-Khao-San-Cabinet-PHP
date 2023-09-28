<?php
class LoginModel {
    private $table = "user";
    private $Connection;
    private $id;
    private $Name;
    private $Surname;
    private $email;
    private $phone;
    public function __construct($Connection) {
		$this->Connection = $Connection;
    }


    public function getUsernameBy_Username_Password($username , $password) {
        $sql = "
            SELECT username FROM user WHERE username = '$username' 
            and password = '$password';
        ";
        $consultation = $this->Connection->prepare($sql);
        $consultation->execute();
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $resultados;
    }
    
   
    public function getAll(){
        $consultation = $this->Connection->prepare("SELECT id,Name,Surname,email,phone FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $resultados;
    }
    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT id,Name,Surname,email,phone
                                                FROM " . $this->table . "  WHERE id = :id");
        $consultation->execute(array(
            "id" => $id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $resultado = $consultation->fetchObject();
        $this->Connection = null; //connection closure
        return $resultado;
    }
   
}
?>