<?php
class customException extends Exception {
    private $_model;
   
    public function errorMessage() {
     
       $this->_model=new E_Model($table="error_logs");
       //admin error message
            $mailMsg = 'An error has been reported on line '.$this->getLine().' in '.$this->getFile()."by User ID ".$_SESSION['ID'].".  Error Detail: ".$this->getMessage();
       //error message to administrator via email
            $to = "nkmwambs@gmail.com";
            $subject = "System Error Notification for Application ".$GLOBALS['app'];
            $txt = $mailMsg;
            $headers = "From: easyphp4u@gmail.com" . "\r\n" .
            "CC: londuso@us.ci.org";

            mail($to,$subject,$txt,$headers);
       //error message to database
            $dbMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()." Details: ".$this->getMessage();
            $this->_model->insertRecord(array("details"=>addslashes($dbMsg),"appName"=>$GLOBALS['app'],"userid"=>$_SESSION['ID']),"error_logs");
       //error message for display
            $errorMsg= "Error: <b>".$this->getMessage()."</b> An error has occurred and been mailed to the administrator!";
       return $errorMsg;
   }
 }