<?php
class Paginator extends SQL{
    private $_offset;
    private $_page;
    private $_rec_limit;
    private $_rec_count;
    private $_left_rec;
    private $_num_of_pages;
    private $_all_pages;
    private $_grouped_pages;
    private $_navigator;


    public function __construct($table,$rec_limit){   
        parent::__construct($table);
        $this->_rec_limit = $rec_limit;
    }
            
    public function get_num_records(){   
    $sql = "SELECT * FROM $this->table";
    $retval = mysql_query($sql);
    if(!$retval)
    {
      die('Could not get data: ' . mysql_error());
    }

    $this->_rec_count = mysql_num_rows($retval);
    return $this->_rec_count;
    }

    public function set_page(){
    if($GLOBALS['args']!=="" && isset($GLOBALS['args'][1]))
    {
        $this->_page = $GLOBALS['args'][1]+1;
    }
    else
    {
        $this->_page = 0;
    }
    return $this->_page;
    }

    public function set_offset(){
        $this->get_num_records();
        $this->set_page();
       if($this->_page)
        {
            $this->_offset = $this->_rec_limit * $this->_page ;// Set the current offset
        }
        else
        {
            $this->_offset = 0;
        } 
    return $this->_offset;
    }

    public function paginate(){
        $this->_left_rec = $this->_rec_count - ($this->_page * $this->_rec_limit);// if _rec_count = 80 and We are in Page 3 of each page 10 records then: _left_rec = 80-(3*10)
        $this->_num_of_pages = ceil($this->_rec_count/  $this->_rec_limit);
        $this->_all_pages = range($this->_page+1,  $this->_num_of_pages);
        $this->_grouped_pages = array_chunk($this->_all_pages,10);

    $bar ="<div class='nav-bar'>";
    
    if($this->_page > 0 )
            {
            $last = $this->_page - 1;

            $bar .= "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/0\">First Page</a> ";
            $bar .= "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/$last\">Previous Page</a> ";
            if(count($this->_grouped_pages)===1){
                foreach ($this->_all_pages as $item):
                    $cur_page = $item-1;
                    $bar .=  "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/$cur_page\">{$item}</a>";
                endforeach;                
            }else{
                foreach ($this->_grouped_pages[0] as $item):
                    $cur_page = $item-1;
                    $bar .=  "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/$cur_page\">{$item}</a>";
                endforeach;                 
            }

            $bar .=  "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/$this->_num_of_pages\">Last Page</a>";
    }
    else if($this->_page === 0 )
    {
            if(count($this->_grouped_pages)===1){
                foreach ($this->_all_pages as $item):
                    $cur_page = $item-1;
                    $bar .=  "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/$cur_page\">{$item}</a>";
                endforeach;                
            }else{
                foreach ($this->_grouped_pages[0] as $item):
                    $cur_page = $item-1;
                    $bar .=  "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/$cur_page\">{$item}</a>";
                endforeach;                 
            }
            $bar .=  "<a class='nav_button'  href=\"".url_tag($GLOBALS['Controller'].DS.$GLOBALS['Method'])."/page/$this->_num_of_pages\">Last Page</a>";
    }
   
        $bar .="</div>";

    return $this->_navigator=$bar;

        }

}
