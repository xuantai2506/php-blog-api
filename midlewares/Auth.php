<?php
include '../config/JwtHandler.php';
include '../models/member_model.php';
class Auth extends JwtHandler {
	public function __construct($db,$headers){
		parent::__construct();
		$this->db = $db ;
		$this->headers = $headers;
	}

	public function isAuth(){
		if(array_key_exists('Authorization',$this->headers) && !empty(trim($this->headers['Authorization']))){
			$this->token = explode(" ", trim($this->headers['Authorization']));
			if(isset($this->token[0]) && !empty(trim($this->token[0]))) {
				$data = $this->_jwt_decode_data($this->token[0]);
				if(isset($data['data']->id)){
					$user = $this->fetchUser($data['data']->id);
                    return $user;
				}else {
					return null ;
				}
			}else {				
				return null;
			}
		}
	}

    protected function fetchUser($user_id){
        try{
			$user = member_model::getUser($user_id);
            return [
                'success' => 1,
                'status' => 200,
                'user' => $user
            ];
        }
        catch(PDOException $e){
            return null;
        }
    }

}
?>