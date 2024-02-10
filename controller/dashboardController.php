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
            case "test":
                $this->index();
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

        $startDate = new DateTime($startDateString);
        $endDate = new DateTime($endDateString);

        // Calculate the difference
        $interval = $startDate->diff($endDate);

        // Access the difference in months and days
        $months = $interval->m;
        $days = $interval->d;

        $array['month'] = $months;
        $array['day'] = $days;

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

        $filter = "week";
        $counter = array();
        $dateDuration = array();
        $machineAll = $modelo->getAll();
        $machine = array();
        $machineDuration = array();

        for ($i = 1; $i <= 5; $i++) {
            $duration = $this->formatDuration($modelo->getDuration("machine_log_$i"));
            array_push($machineDuration, $duration);
        }
        // print_r();

        if (isset($_GET["filter"])) {
            $filter =  $_GET["filter"];
        }

        if ($filter == "year") {
            for ($i = 1; $i <= 5; $i++) {
                $data = $modelo->getYear("machine_log_$i");
                array_push($machine, $data);
            }
        } else if ($filter == "month") {
            for ($i = 1; $i <= 5; $i++) {
                $data = $modelo->getMonth("machine_log_$i");
                array_push($machine, $data);
            }
        } else {
            $filter = "week";
            for ($i = 1; $i <= 5; $i++) {
                $data = $modelo->getWeek("machine_log_$i");
                array_push($machine, $data);
            }
        }

        $this->view("dashboard", array(
            "test" => $this->getCurrentWeekDays(),
            "name" => $_SESSION['name'],
            "counter" => $counter,
            "dateDuration" => $dateDuration,
            "machineAll" => $machineAll,
            "machine" => json_encode($machine),
            "machineDuration" => $machineDuration,
            "filter" => $filter,
        ));
    }


    public function crear()
    {
    }

    public function actualizar()
    {
        if (isset($_POST["id"])) {
            //We create a user
            $employee = new Employee($this->Connection);
        }
        header('Location: index.php');
    }

    public function view($vista, $datos)
    {
        $data = $datos;
        require_once  __DIR__ . "/../view/" . $vista . "View.php";
    }
}