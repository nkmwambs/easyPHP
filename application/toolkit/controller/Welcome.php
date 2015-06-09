<?php
class Welcome_Controller extends E_Controller
{
	private $_model;
	public function __construct(){
		parent::construct();
		$this->_model=new Welcome_Model("users");
	}
	
	public function home(){
		$data = "Hello";
		$this->template->view("",$data);
	}
}
?>