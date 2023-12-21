<?php
class DashboardController
{
    private $conectar;
    private $Connection;
    public function __construct()
    {
        require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/machineModel.php";
        $this->conectar = new Conectar();
        $this->Connection = $this->conectar->Connection();
    }
    /**
     * Ejecuta la acción correspondiente.
     *
     */
    public function run($accion)
    {
        switch ($accion) {
            case "index":
                $this->index();
                break;
            case "alta":
                $this->crear();
                break;
            case "detalle":
                $this->detalle();
                break;
            case "actualizar":
                $this->actualizar();
                break;
            default:
                $this->index();
                break;
        }
    }
    /**
     * Loads the employees home page with the list of
     * employees getting from the model.
     *
     */
    public function formatDuration($duration)
    {
        $array = array("month" => "", "day" => "");
        $startDateString = $duration[0];
        $endDateString = $duration[1];

        // Create DateTime objects from the date strings
        $startDate = new DateTime($startDateString);
        $endDate = new DateTime($endDateString);

        // Calculate the difference
        $interval = $startDate->diff($endDate);

        // Access the difference in months and days
        $months = $interval->m;
        $days = $interval->d;

        $array['month'] = $months;
        $array['day'] = $days;

        // echo 'Duration: ' . $months . ' months and ' . $days . ' days';
        return $array;
    }
    public function getCurrentWeekDays()
    {
        $today = new DateTime();
        $startDate = new DateTime($today->format('Y-m-d'));
        $startDate->modify('-' . $today->format('w') . ' days');

        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $currentDate = new DateTime($startDate->format('Y-m-d'));
            $currentDate->modify('+' . $i . ' days');
            $weekDays[] = $currentDate->format('Y-m-d'); // Format as 'YYYY MM DD'
        }

        return $weekDays;
    }
    public function index()
    {
        $modelo = new MachineModel($this->Connection);
        $weekCount = $modelo->getDataWeek($this->getCurrentWeekDays());
        $dateDuration = $modelo->getDuration();
        $this->view("dashboard", array(
            "test" => $this->getCurrentWeekDays(),
            "weekCount" => $weekCount,
            "name" => $_SESSION['name'],
            "dateDuration" => $this->formatDuration($dateDuration),
        ));
    }
    /**
     * Loads the employees home page with the list of
     * employees getting from the model.
     *
     */
    public function detalle()
    {
        //We load the model
        $modelo = new Employee($this->Connection);
        //We recover the employee from the BBDD
        $employee = $modelo->getById($_GET["id"]);
        //We load the detail view and pass values to it
        $this->view("detalle", array(
            "employee" => $employee,
            "titulo" => "Detalle Employee"
        ));
    }
    /**
     * Create a new employee from the POST parameters
     * and reload the index.php.
     *
     */
    public function crear()
    {
    }
    /**
     * Update employee from POST parameters
     * and reload the index.php.
     *
     */
    public function actualizar()
    {
        if (isset($_POST["id"])) {
            //We create a user
            $employee = new Employee($this->Connection);
        }
        header('Location: index.php');
    }
    /**
     * Create the view that we pass to it with the indicated data.
     *
     */
    public function view($vista, $datos)
    {
        $data = $datos;
        require_once  __DIR__ . "/../view/" . $vista . "View.php";
    }
}
