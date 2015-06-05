<?php
class E_Menu
{
    public $Con;
    public $template;

    public function __construct(){
        $this->Con = $GLOBALS['Controller'];
        $this->Met = $GLOBALS['Method'];
        $this->template=new Template($this->Con,  $this->Met); 
    }

    public function menu($menu){
        /**
         * $menu - A multi-dimensional array with all rows of the menus table
         * This part of the function makes an array of the string found in the exception field of each row of the menu table using the explode function
         * with delimiter comma(,). Each element of this array represents a user excepted.
         * Each of the array above is then exploded into an array delimited by Equals(=). The first element of this array is the username and the second
         * is the menus field the whose rules the user is excepted from
         */
        foreach($menu as $exc){ 
            $exc_key_arr = explode(",",$exc->exception);
            foreach($exc_key_arr as $exc_key_split){
                $key_splitter  = explode("=",$exc_key_split);
                if($key_splitter[0]===$_SESSION['username']){
                    $ex_key =  $key_splitter[1];
                }  else {
                    $ex_key=null;
                }
            }
        }
        
        //Check Visibility by Userlevel
        $final_userlevel=  array();
        foreach($menu as $value_usr){
            $vis = explode(",",$value_usr->userlevel);
            //print_r($vis);
            foreach($vis as $vis_value){
                if($vis_value===$_SESSION['userlevel']){
                    $final_userlevel[]=$value_usr;
                }
            }
        }
        
        //Allow visibility for items by todate field
        $final_dates=  array();
        foreach ($final_userlevel as $value_dates_null){
            if($value_dates_null->todate==='0=0000-00-00'){
                $final_dates[]=$value_dates_null;
            }  else {
                $vis_date_null_outer = explode(",",$value_dates_null->todate);
                    foreach($vis_date_null_outer as $vis_date_null_outer_value){
                        $vis_date_null_inner = explode("=",$vis_date_null_outer_value);
                            if($vis_date_null_inner[0]===$_SESSION['userlevel'] && (strtotime(date('Y-m-d'))<=strtotime($vis_date_null_inner[1]) || $vis_date_null_inner[1]==='0000-00-00')){
                                $final_dates[]=$value_dates_null;
                            }
                    }
                
            }
            
        }
        
        //Allow visibility for items by reoccur
        $reoccur = array();
        foreach($final_dates as $reoccur_day){
            if($reoccur_day->reoccur==="0=0-0"){
                $reoccur[] = $reoccur_day;
                
            }else{
                 $reoccur_day_outer = explode(",",$reoccur_day->reoccur);
                 
                 foreach($reoccur_day_outer as $reoccur_day_value){
                     $reoccur_day_inner = explode("=",$reoccur_day_value);
                        if($reoccur_day_inner[0]===$_SESSION['userlevel']){
                            $reoccur_day_inner_two = explode("-",$reoccur_day_inner[1]);
                            if($reoccur_day_inner_two[0]>$reoccur_day_inner_two[1]){
                                $current_reoccur_start_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[0]));
                                $current_reoccur_end_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[1],'+ 1 month'));
                            }else{
                                $current_reoccur_start_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[0]));
                                $current_reoccur_end_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[1]));
                            }
                            //echo date('Y-m-'.$reoccur_day_inner_two[0]);
                            if((strtotime(date('Y-m-d'))>=$current_reoccur_start_date && strtotime(date('Y-m-d'))<=$current_reoccur_end_date) || $reoccur_day_inner_two[0]==='0'){
                                $reoccur[] = $reoccur_day;
                            }
                            
                            
                        }
                 }
            }
            
        }
        
        //$admin = array();
        for($i=0;$i<count($reoccur);$i++){
            if($reoccur[$i]->admin==='1'&&$_SESSION['admin']!=='1'){
                array_splice($reoccur,$i,1);
            }
        }
        
        
        $menu_data=  array();
        $side_menu_data=  array();
        foreach ($reoccur as $value) {
            if(strpos($value->selfID,"_")==false){
                $inner['name']=  ucfirst($value->selfTitle);
                $inner['url']=  ucfirst($value->url);
                $inner['img']=$value->link_img;
                array_push($menu_data,$inner);
                
            }  else {
                $chk_parent_array = explode("_",$value->selfID);
                if(ucfirst($chk_parent_array[1])===ucfirst($this->Con)){
                $inner_side['name']=  ucfirst($value->selfTitle);
                $inner_side['url']=  ucfirst($value->url);
                $inner_side['img']=$value->link_img;
                array_push($side_menu_data,$inner_side);
                }
               
            }
        }
        
       $this->template->view("welcome/header",$menu_data);
       $this->template->view("welcome/side_bar",$side_menu_data);
    }
    
}