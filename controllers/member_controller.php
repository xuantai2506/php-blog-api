<?php 
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	class member_controller extends main_controller 
	{

		public function registerUser(){
			$json = file_get_contents('php://input');
			// Converts it into a PHP object
			$data = json_decode($json);

			$users = member_model::getInstance();
			$nameData = $data->name;
			$emailData = $data->email;
			$passwordData = md5($data->password);
			$confirmData = md5($data->confirm);
			
			if($passwordData !== $confirmData){
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(false,400,'Password confirm fail');
				echo json_encode($response);
				die();
			}

			$userData = [
				'email' => $emailData,
				'name' => $nameData,
				'password' => $passwordData,
			];
			
			if($users->addRecord($userData)){
				header("HTTP/1.1 200 OK");
				$response = $this->generateResponseHTTP(true,200,'Register successfully !');
				echo json_encode($response);
			}else {
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(false,400,'Register Fail !');
				echo json_encode($response);
			}
		}

		public function loginUser(){
			$data = json_decode(file_get_contents("php://input"));
			$users = member_model::getInstance();
			$email = $data->email;
			$password = $data->password;
			$condition['conditions'] = "email='".$email."' and password = '".md5($password)."'";
			$result = $users->getAllRecords("*",$condition)->fetch_assoc();
			$user = $users->getRecord($result['id']);
			if(count($result) > 0){
				header("HTTP/1.1 200 OK");
				$jwt = new JwtHandler();
				$token = $jwt->_jwt_encode_data(
					'http://localhost:8081/php_auth_api/',
                        array("id"=> $result['id'])
				);
				echo json_encode(['message' => 'Login Successfully !', 'success' => true ,"fetch" => ['token' => $token,'user'=>$user]]);
			}else {
				header('Status : 400 not found');
				echo json_encode(['message' => 'Login fail !','success' => false]);
			}
		}

		public function logout(){
			session_start();
			if(!empty($_SESSION['login'])){
				unset($_SESSION['login']);
				unset($_SESSION['name']);
				header( "Location: ".html_helpers::url('/'));
			}
		}
	}

 ?>