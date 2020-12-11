<?php
require_once('./soapclient.php');
if(!isset($_REQUEST['wsdl'])) {
    die("operation name required");
}
if(!method_exists($client, $_REQUEST['wsdl']) or !in_array($_REQUEST['wsdl'], ['getAll', 'getById'])) {
    die("invalid operation name");
}
switch ($_REQUEST['wsdl']) {
    case 'getAll':
        $studentdetails = $client->getAll();
        echo "<pre>";
        print_r($studentdetails);
        echo "</pre>";
        break;
    case 'getById': 
        if(!isset($_REQUEST['id'])) {
            die("id parameter required");
        }
        $studentdetail = $client->getById(['id' => $_REQUEST['id']]);
        echo "<pre>";
        print_r($studentdetail);
        echo "</pre>";
        break;
    
    default:
        
        break;
}