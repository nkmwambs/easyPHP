<?php
include_once("SQL.php");
class E_Model extends SQL {
    
    public function __call($var,$val) {
        print "Ooops";
    }
	
    
	
}
