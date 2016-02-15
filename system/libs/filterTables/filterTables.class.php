<?php
class filterTables{
	private $_fields;
	private $_fieldset;
	private $_callback;
	private $_editcallback;
	private $_content;
	public function __construct($fieldset,$fields,$callbackjsfunc,$callbackforedit,$contentdiv){
		$this->_fields = $fields;
		$this->_fieldset = $fieldset;
		$this->_callback = $callbackjsfunc;
		$this->_content = $contentdiv;
		$this->_editcallback = $callbackforedit;
	}
	
	public function countfields(){
		return count($this->_fields);
	}
	
	public function filter(){
		
		$operators = array("=",">","<",">=","<=","!=","Contains");
		
		$elem = "<INPUT TYPE='hidden' id='editcallback' VALUE='".$this->_editcallback."'/>";
		
		$elem .= "<button  id='btnExport'>Export</button><br><br>";
		
		$elem .= "<form id='filterform'>";
		$elem .= "<fieldset id='fldset'>";
		$elem .= "<legend>".$this->_fieldset."</legend>";
		
		//Delete Image
		$elem .= Resources::img("uncheck3.png",array("style"=>"cursor:pointer;","class"=>"row0","onclick"=>"deletefilter(\"row0\")"));
		
		//Filter Fields Select
		$elem .= "<SELECT class='row0' name='fields[]'>";
		$elem .= "<OPTION VALUE=''>Select Filter Field ...</OPTION>";
			foreach ($this->_fields as $key => $value) {
				$elem .= "<OPTION VALUE='".$key."'>".$value."</OPTION>";
			}
		$elem .= "</SELECT>";

		//Operator Select
		$elem .= "<SELECT class='row0' name='operators[]'>";
		$elem .= "<OPTION VALUE=''>Select Operator ...</OPTION>";
			foreach ($operators as $value) {
				$elem .= "<OPTION VALUE='".$value."'>".$value."</OPTION>";
			}
		$elem .= "</SELECT>";
		
		//Criteria Value
		$elem .= "<INPUT TYPE='text' class='row0' name='criteriaval[]' placeholder='Criteria Value'/>";
		
		//Add Fields Plus
		$obj_keys = implode(",",array_keys($this->_fields));
		$obj_values = implode(",",array_values($this->_fields));
		$elem .= Resources::img("plus.png",array("style"=>"cursor:pointer;","class"=>"row0","onclick"=>"addfilters(\"".$obj_keys."\",\"".$obj_values."\")"))."<br class='row0'>";
		
		$elem .= "</fieldset>";
		
		$elem .= Resources::img("go.png",array("style"=>"cursor:pointer;","onclick"=>"getfiltercontroller(\"".$this->_callback."\",\"".$this->_content."\")"));
		
		$elem .= "</form>";
		return $elem;
	}
}
?>