<?php
class main_model 
{
	private $con;
    private static $instance = [];  

	protected $table;
	protected function __construct(){
		
		// $this->con =  mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		// if(mysqli_connect_error()) {
		// 	echo "Failed to connect to MySQL". mysqli_connect_error();exit();
		// }
		
		$instanceDB = ConnectDB::getInstance();
		$this->con = $instanceDB->getConnection();
		if(!$this->table)	$this->setTableName();	
	}

	public static function getInstance() {
		$called_class = get_called_class();
        if (!array_key_exists($called_class,self::$instance)) {
			self::$instance[$called_class] = new $called_class();
		}
        return self::$instance[$called_class];
    }

	protected function setTableName($table=null){
		if($table) {
			$this->table=$table;
		} else {
			$cln = get_class($this);
			$clnf = str_split($cln, strrpos($cln, '_'))[0];
			if (strrpos($clnf,"y")) {
				if ((strrpos($clnf,"y") + 1) == strlen($clnf)) {
					$this->table = str_split($clnf, strrpos($clnf, 'y'))[0].'ies'; 
				} 
			} else {
				$this->table = $clnf.'s';
			}
		}
	}
	public function getTableName() {
		return $this->table;
	}

	public function getAllRecordsJoinTable($fields="*",$table,$on,$options=null){
		$conditions = '';
		if(isset($options['conditions'])){
			$conditions .= ' where ' .$options['conditions'];
		}
		$query = "SELECT ".$fields." FROM ".$table." ON ".$on.$conditions ;
		$result = mysqli_query($this->con,$query);
		return $result;
	}

	public function getAllRecords($fields='*', $options=null) {
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' where '.$options['conditions'];
		}
		if(isset($options['group_by'])){
			$conditions .= ' group by ' .$options['group_by'];
		}
		$query = "SELECT ".$fields." FROM ".$this->table. $conditions;
		$result = mysqli_query($this->con,$query);
		return $result;
	}

	public function getRecord($id=null, $fields='*', $options=null) {
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' and '. $options['conditions'];
		}
		if(isset($options['group_by'])){
			$conditions .= ' group by ' .$options['group_by'];
		}
		$query = "SELECT $fields FROM $this->table where id=$id".$conditions;
		$result = mysqli_query($this->con,$query);
		if($result) {
			//$record = mysqli_fetch_array($result);
			//$record = mysqli_fetch_row($result);
			$record = mysqli_fetch_assoc($result);
		} else $record=false;
		return $record;
	}
	
	public function delRecord($id=null, $conditions=null) {
		if($conditions)	$conditions = ' and '.$conditions;
		$query = "DELETE FROM $this->table WHERE id=$id".$conditions;
		return mysqli_query($this->con,$query);
	}
	
	public function addRecord($datas) {
		$fields = $values = '';
		$i=0;
		foreach($datas as $k=>$v) {
			if($i) {
				$fields .=',';
				$values .=',';
			}
			$fields .= $k;
			$values .= "'".$v."'";
			$i++;
		}
		$query = "INSERT INTO $this->table($fields) VALUES ($values)";
		return mysqli_query($this->con,$query);
	}
	
	public function editRecord($id,$datas){
		$setDatas = '';
		$i=0;
		foreach($datas as $k=>$v) {
			if($i) {
				$setDatas .=',';
			}
			$setDatas .= $k."='".$v."'";
			$i++;
		}
        $query = "UPDATE $this->table SET $setDatas WHERE id='$id'";
		return mysqli_query($this->con,$query);
        //$result = mysqli_query($this->con,$query) or die("MySQL error: " . mysqli_error($this->con) . "<hr>\nQuery: $query");
    }

    public static function convertToList($mysqliObject) {
    	$arrReturn = [];
    	while($row = mysqli_fetch_array($mysqliObject)) {
    		$arrReturn[$row['id']] = $row['cat_name'];
    	}
    	return $arrReturn;
    }


}
