<?php
class MachineModel
{
    private $table = "employees";
    private $Connection;
    private $id;
    private $Name;
    private $Surname;
    private $email;
    private $phone;
    public function __construct($Connection)
    {
        $this->Connection = $Connection;
    }
    public function getDataWeek($table, $week)
    {
        $array = array();
        foreach ($week as $key) {
            $sql = "
                    SELECT COUNT(*) as count FROM $table WHERE DATE(datetime)  = '$key';
                ";
            $consultation = $this->Connection->prepare($sql);
            $consultation->execute();
            $resultados = $consultation->fetch(PDO::FETCH_OBJ);
            array_push($array, $resultados->count);
        }

        // $this->Connection = null;
        return $array;
    }
    public function getDuration($table)
    {
        $array = array();
        $sql = "
        SELECT 
        id,
        MIN(date(datetime)) AS start_time,
        MAX(date(datetime)) AS end_time
        FROM $table
        ";
        $consultation = $this->Connection->prepare($sql);
        $consultation->execute();
        $resultados = $consultation->fetch(PDO::FETCH_OBJ);
        array_push($array, $resultados->start_time);
        array_push($array, $resultados->end_time);
        // $this->Connection = null; //cierre de conexión
        return $array;
    }

    public function getAll()
    {
        $sql = "
            SELECT 'M1' AS machine_log_1, COUNT(*) AS count FROM machine_log_1
            UNION ALL
            SELECT 'M2' AS machine_log_2, COUNT(*) AS count FROM machine_log_2
            UNION ALL
            SELECT 'M3' AS machine_log_3, COUNT(*) AS count FROM machine_log_3
            UNION ALL
            SELECT 'M4' AS machine_log_4, COUNT(*) AS count FROM machine_log_4
            UNION ALL
            SELECT 'M5' AS machine_log_5, COUNT(*) AS count FROM machine_log_5;
        ";
        $consultation = $this->Connection->prepare($sql);
        $consultation->execute();
        $result = $consultation->fetchAll();

        $name = array();
        $value = array();
        $data = array();

        foreach ($result as $i) {
            array_push($name, $i[0]);
            array_push($value, $i[1]);
        }
        array_push($data, $name);
        array_push($data, $value);

        /**
         * result =>
         * [[name,value],[name,value],[name,value],[name,value],[name,value]]
         */
        return $data;
    }
    public function getWeek($table)
    {
        $sql = "
            SELECT DAY(datetime) AS date, COUNT(*) AS count
            FROM $table 
            WHERE DATE(datetime) >= DATE_SUB(CURDATE(), INTERVAL DAYOFWEEK(CURDATE()) - 1 DAY)
            AND DATE(datetime) <= DATE_ADD(CURDATE(), INTERVAL 6 - DAYOFWEEK(CURDATE()) DAY)
            GROUP BY DATE(datetime);
        ";
        $consultation = $this->Connection->prepare($sql);
        $consultation->execute();
        $result = $consultation->fetchAll();

        // print_r($result);
        $day = array();
        $value = array();
        $data = array();

        foreach ($result as $i) {
            array_push($day, $i[0]);
            array_push($value, $i[1]);
        }
        array_push($data, $day);
        array_push($data, $value);

        /**
         * result =>
         * [[name,value],[name,value],[name,value],[name,value],[name,value]]
         */
        return $data;
    }
    public function getMonth($table)
    {
        $sql = "
            SELECT DAY(datetime) AS date, COUNT(*) AS count
            FROM $table 
            WHERE DATE(datetime) >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
            AND DATE(datetime) <= LAST_DAY(CURDATE())
            GROUP BY DATE(datetime);
        ";
        $consultation = $this->Connection->prepare($sql);
        $consultation->execute();
        $result = $consultation->fetchAll();

        // print_r($result);
        $day = array();
        $value = array();
        $data = array();

        foreach ($result as $i) {
            array_push($day, $i[0]);
            array_push($value, $i[1]);
        }
        array_push($data, $day);
        array_push($data, $value);

        /**
         * result =>
         * [[name,value],[name,value],[name,value],[name,value],[name,value]]
         */
        return $data;
    }
    public function getYear($table)
    {
        $sql = "
            SELECT EXTRACT(MONTH FROM datetime) AS month, COUNT(*) AS count
            FROM $table 
            WHERE YEAR(datetime) = YEAR(CURDATE())
            GROUP BY EXTRACT(MONTH FROM datetime);
        ";
        $consultation = $this->Connection->prepare($sql);
        $consultation->execute();
        $result = $consultation->fetchAll();

        // print_r($result);
        $month = array();
        $value = array();
        $data = array();

        foreach ($result as $i) {
            array_push($month, $i[0]);
            array_push($value, $i[1]);
        }
        array_push($data, $month);
        array_push($data, $value);

        /**
         * result =>
         * [[name,value],[name,value],[name,value],[name,value],[name,value]]
         */
        return $data;
    }
}