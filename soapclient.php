<?php
class client
{
    private $soap_instance;
    public function __construct()
    {
        $params = array('location' => 'http://localhost/soap/soapserver.php', 'uri' => 'urn://localhost/soap/soapserver.php', 'trace' => 1);
        $this->soap_instance = new SoapClient(null, $params);
    }
    public function getAll()
    {
        try {
            
            return $this->soap_instance->getAllStudents();
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }
    }
    public function getById($params)
    {
        try {
            return $this->soap_instance->getStudent($params);
        } catch (Exception $ex) {
            exit("soap error: " . $ex->getMessage());
        }
    }
}
$client = new client();