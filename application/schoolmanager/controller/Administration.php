<?php
class Administration_Controller extends E_Controller{
    public function showAll(){
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer"); 
    }
    
}
?>