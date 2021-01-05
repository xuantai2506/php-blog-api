<?php 
class member_model extends main_model {
	public $table = "users";

	public function getUserId(){
		$options = [];
		$member = $this->getInstance();
		if(!empty($_SESSION['name'])){
			$options['conditions'] = "name='".$_SESSION['name']."'"; 
			$record_users  = $member->getAllRecords('id',$options)->fetch_assoc();
			$user_id = $record_users['id'];
		}
		return $user_id;
	}

	public function getUser($id){
		$options = [];
		$member = static::getInstance();
		return $member->getRecord($id);
	}
}
?>