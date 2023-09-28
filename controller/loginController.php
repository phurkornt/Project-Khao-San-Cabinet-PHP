<?php
class LoginController{
    private $conectar;
    private $Connection;
    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/loginModel.php";
        $this->conectar=new Conectar();
        $this->Connection=$this->conectar->Connection();
    }
   /**
    * Ejecuta la acción correspondiente.
    *
    */
    public function run($accion){
        switch($accion)
        {
            case "index" :
                $this->index();
                break;
            case "authen" :
                $this->authen();
                break;
            case "logout" :
                $this->logout();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(){
        //We create the employee object
        // $employee=new Employee($this->Connection);
        //We get all the employees
        // $employees=$employee->getAll();
        //We load the index view and pass values to it
        $this->view("login",array(
            "titulo" => "PHP MVC"
        ));
    }

    public function authen(){
        $login_status = false;
        $modelo = new LoginModel($this->Connection);
        $data = $modelo->getUsernameBy_Username_Password($_POST["username"],hash("sha256",$_POST["password"]));
        if(count($data) > 0){
            session_start();
            $_SESSION["name"] = $data[0]["username"];
            $_SESSION["ID"] = session_id();
            header("Location: index.php");
        }
        $this->view("login",array(
            "login_status" => $login_status
        ));
    }
    public function logout(){
        session_start();
        session_destroy();
        header("Location: index.php");
    }
    /**
    * Loads the employees home page with the list of
     * employees getting from the model.
    *
    */
    
   /**
    * Create the view that we pass to it with the indicated data.
    *
    */
    public function view($vista,$datos){
        $data = $datos;
        require_once  __DIR__ . "/../view/" . $vista . "View.php";
    }
}
?>