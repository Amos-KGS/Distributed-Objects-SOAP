<?php
include "StudentDB.php";
class server
{
    private $db_handle;
    public function __construct()
    {
        $this->connect();
    }
    private function connect()
    {
        try {
            $this->db_handle = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        } catch (Exception $ex) {
            exit($ex->getMessage());
        }
    }
    public function getAllStudents()
    {
        $query = mysqli_query($this->db_handle, "SELECT * FROM " . TABLE);
        $studentdetails = [];
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            array_push($studentdetails, new studentdetail($row['id'], $row['fname'], $row['lname'], $row['email'], $row['faculty'], $row['course'], $row['year']));
        }
        return $studentdetails;
    }
    public function getStudent($params)
    {
        $query = mysqli_query($this->db_handle, "SELECT * FROM " . TABLE . " WHERE id='{$params['id']}'");
        $row = mysqli_fetch_row($query);
        if($row) {
            return new studentdetail($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
        }
        return "student not found";
    }
}
class studentdetail 
{
    public $id, $fname, $lname, $faculty, $course, $year;
    public function __construct($id, $fname, $lname, $faculty, $course, $year) 
    {
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->faculty = $faculty;
        $this->course = $course;
        $this->year = $year;
    }
}
$params = array('uri' => 'http://localhost/soap/soapserver.php');
$soapServer = new SoapServer(null, $params);
$soapServer->setClass('server');
$soapServer->handle();