<?php 
/**
* Base Model
*/
class MY_Model extends CI_Model
{
	var $gallery_path;
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval'; 
	protected $_order_by = '';
	protected $ar_orderby = '';
	public $rules = array();
	protected $_timestamps = FALSE;
	protected static $db_fields;

	function __construct() 	{
		parent::__construct();
		//error_reporting(1);
		$this->currentAddDate = date('Y-m-d');
		$this->currentAddDate_time = date('Y-m-d H:i:s');
		$this->currentAdd_time = date('H:i:s');
		$this->load->helper('url');
		$this->load->database();
		$this->currentAddDate = date('Y-m-d');
		$this->currentAddDate_time = date('Y-m-d H:i:s');
		$this->currentAdd_time = date('H:i:s');
	}

	public function array_from_post($fields) {
		$data = array();
		foreach ($fields as $field) {
			if($this->input->post($field))
				$data[$field] = $this->input->post($field);
		}

		return $data;
	}
	public function array_from_all_post($fields) {
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}

		return $data;
	}

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';	
		}
		else if($single == TRUE)
		{
			$method = 'row';
		}
		else
		{
			$method = 'result';
		}
		return $this->db->get($this->_table_name)->$method();
	}


	public function get_by($where, $single = FALSE ){
		$this->db->where($where);
		return $this->get(Null, $single);
	}

	public function get_data($table="false") {
		if($table!="false")
			$_table_name = $table;		
		$query = $this->db->get($_table_name);
		return $query;
	}

	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		//If not ID is passed skip delete
		if(!$id){
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		//Checking for Current User		
		$this->db->limit(1);
		$result = $this->db->delete($this->_table_name);
		return $result;
	}

	public function get_rand_sn($length,$zero = false) {
			if ($length > 0) { 
				$rand_id = "";
				for($i=1; $i<=$length; $i++) {
					//mt_srand((double)microtime() * 5000000);
					if($zero)
						$num = mt_rand(0,9);
					else
						$num = mt_rand(1,9);					
					$rand_id .= $num; //assign_rand_value($num);
				}
			}
			return $rand_id;
	}
		
	public function assign_rand_value($num) {
		// accepts 1 - 36
		switch($num){
			case "1":
			 $rand_value = "a";
			break;
			case "2":
			 $rand_value = "b";
			break;
			case "3":
			 $rand_value = "c";
			break;
			case "4":
			 $rand_value = "d";
			break;
			case "5":
			 $rand_value = "e";
			break;
			case "6":
			 $rand_value = "f";
			break;
			case "7":
			 $rand_value = "g";
			break;
			case "8":
			 $rand_value = "h";
			break;
			case "9":
			 $rand_value = "i";
			break;
			case "10":
			 $rand_value = "j";
			break;
			case "11":
			 $rand_value = "k";
			break;
			case "12":
			 $rand_value = "l";
			break;
			case "13":
			 $rand_value = "m";
			break;
			case "14":
			 $rand_value = "n";
			break;
			case "15":
			 $rand_value = "o";
			break;
			case "16":
			 $rand_value = "p";
			break;
			case "17":
			 $rand_value = "q";
			break;
			case "18":
			 $rand_value = "r";
			break;
			case "19":
			 $rand_value = "s";
			break;
			case "20":
			 $rand_value = "t";
			break;
			case "21":
			 $rand_value = "u";
			break;
			case "22":
			 $rand_value = "v";
			break;
			case "23":
			 $rand_value = "w";
			break;
			case "24":
			 $rand_value = "x";
			break;
			case "25":
			 $rand_value = "y";
			break;
			case "26":
			 $rand_value = "z";
			break;
			case "27":
			 $rand_value = "0";
			break;
			case "28":
			 $rand_value = "1";
			break;
			case "29":
			 $rand_value = "2";
			break;
			case "30":
			 $rand_value = "3";
			break;
			case "31":
			 $rand_value = "4";
			break;
			case "32":
			 $rand_value = "5";
			break;
			case "33":
			 $rand_value = "6";
			break;
			case "34":
			 $rand_value = "7";
			break;
			case "35":
			 $rand_value = "8";
			break;
			case "36":
			 $rand_value = "9";
			break;
			default:
				$rand_value = null;
		}
		return $rand_value;
	}

	private function instantiate($record) {
		// Could check that $record exists and is an array
		$class_name = get_called_class();
	   	$object = new $class_name;
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(static::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	public function get_limit($limit,$start){	
		$this->db->limit($limit,$start);
		$query =  $this->db->get($this->_table_name);
		if ($query->num_rows() > 0){
			foreach ($query->result() as $row) 	{
			     $object_array[] = static::instantiate($row);
			}
			
		 return $object_array;

		} else false;	
   
	}
	private function instantiate_new($record) {
		// Could check that $record exists and is an array
		$class_name = get_called_class();
	   	$object = new $class_name;
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
			$object->$attribute = $value;
		}
		return $object;
	}
	public function get_join($limit=null,$start=null){	
		if(($limit>0)||($start>0))
			$this->db->limit($limit,$start);
		$query =  $this->db->get($this->_table_name);
		if ($query->num_rows() > 0){
			foreach ($query->result() as $row) 	{
			     $object_array[] = static::instantiate_new($row);
			}
			
		 return $object_array;

		} else false;	
   
	}
	public function get_all($id = NULL, $single = FALSE){
		
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);

		}		
		//echo $this->db->_order_by;die('--test');
		/*if(!count($this->db->ar_orderby))
		{
			$this->db->order_by($this->_order_by);
		}*/
		$query =  $this->db->get($this->_table_name);
		if ($query->num_rows() > 0){
			foreach ($query->result() as $row) 	{
			     $object_array[] = static::instantiate($row);
			}
		
		if($id)	
			return $object_array[0];
		else
			return $object_array;

		} else false;	
   
	}

	

	public function hash($string){
		return hash('sha512', $string . config_item('encryption_key'));
	}

	public function create_unique_slug($string)
	{
	    $slug = url_title($string);
	    $slug = strtolower($slug);
	    $i = 0;
	    $params = array ();
	    $params['slug'] = $slug;
	    if ($this->input->post('id')) {
	        $params['id !='] = $this->input->post('id');
	    }
	    
	    while ($this->db->where($params)->get($this->_table_name)->num_rows()) {
	        if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
	            $slug .= '-' . ++$i;
	        } else {
	            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
	        }
	        $params ['slug'] = $slug;
	        }
	    return $slug;
	} 

	public function _table()
	{
		$fields = $this->db->list_fields($this->_table_name);
		echo "<br/>/**CSV **/ <br/><br/>";
		foreach ($fields as $field)
			echo "'".$field."', ";

		echo "<br/>/**variables **/ <br/><br/>";
		foreach ($fields as $field)
			echo "public $".$field.";<br/>";
	}


	public function _query()
	{
		$query = $this->db->get($this->_table_name);
		return $query;
	}
	
	public function printStatus()
	{ 	switch($this->status)
		{
			case 1: 
				return "<span class='btn btn-primary glyphicon glyphicon-ok' title='Activate'> </span>";
			default:
				return "<span class='btn btn-danger glyphicon glyphicon-remove' title='InActive'> </span>";
		}
	}
	/****** return member id ********/
	function loginMemberId(){
		$sess 	= 	$this->session->userdata('member_login');
		$ar 	= 	unserialize($sess);
		return $ar['member_id'];
	}

}
?>