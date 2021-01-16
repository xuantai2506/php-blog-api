<?php 

	class main_controller 
	{
		protected $layout = "";
		protected $model;
		protected $controller = "home";
		protected $action = "index";
		protected $user = null;
		protected $user_id = null ;

		public function __construct(){
			session_start();
			global $cn,$app;
			// controller
			$this->controller = $cn ;
			$app['ctl'] = $this->controller ;
			// action 
			if(isset($_GET['act']))
				$this->action = $_GET['act'];
			$app['act'] = $this->action ;

			// Phân quyền 
			// if($this->action != 'loginUser' && $this->action != 'registerUser' && $this->action != 'logout'){
			// 	$user = self::checkUser();
			// 	if($user){
			// 		$this->user = $user['user'] ;
			// 	} else {
			// 		echo json_encode([
			// 			'success' => 0,
			// 			'status'  => 401,
			// 			'message' => 'NoAuthenticaion',
			// 		]);die();
			// 	}
			// }
			if(method_exists($this,$this->action)){
				if($this->action == 'edit' ||$this->action == "del" || $this->action == 'detail' || $this->action == 'getBlogEdit'){
					$id = '';
					if(isset($_GET['id']))
						$id = $_GET['id'];
					$this->{$this->action}($id);
				}else {
					$this->{$this->action}();
				}
			}
		}

		public function generateResponseHTTP($success,$status,$message,$extra = []){
		    return array_merge([
		        'success' => $success,
		        'status' => $status,
		        'message' => $message
		    ],$extra);
		}

		public function checkUser(){
			$allHeaders = getallheaders();
			$conn = main_model::getInstance();
			$auth = new Auth($conn,$allHeaders);
			return $auth->isAuth();
		}


		public function display($option = null){
			if(!isset($option['ctl'])) {
				$option['ctl'] = $this->controller;
			}
			if(!isset($option['act'])){
				$option['act'] = $this->action;
			}

			include "views/".$option['ctl']."/".$option['act'].".php";
		}

		public function uploadImg($flies, $newSize=null) {
			$t=time();
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $flies["images"]["name"]);
			$extension = end($temp);
			if ((($flies["images"]["type"] == "image/gif")
				|| ($flies["images"]["type"] == "image/jpeg")
				|| ($flies["images"]["type"] == "image/jpg")
				|| ($flies["images"]["type"] == "image/pjpeg")
				|| ($flies["images"]["type"] == "image/x-png")
				|| ($flies["images"]["type"] == "image/png"))
				&& ($flies["images"]["size"] < 200000000)
				&& in_array($extension, $allowedExts))
			{
				if ($flies["images"]["error"] > 0) {
					//var_dump($flies["images"]["error"]);
					echo 'error';
					return false;
			    }
				$ulfd = RootURI."/media/upload/" .$this->controller.'/';
				$newfn = time().rand(10000,99999).'.'.$extension;
			    if (file_exists($ulfd . $newfn)) {
			      	return true;
			    } else {
			        move_uploaded_file($flies["images"]["tmp_name"], $ulfd.$newfn);
					$SimpleImg = new Simpleimages_Component();
					$SimpleImg->load($ulfd.$newfn);
					if(isset($newSize['height']) && !isset($newSize['width'])) {
						$SimpleImg->resizeToHeight($newW);
					} else {
						$newW = 200;
						if(isset($newSize['width'])) {
							$newW = $newSize['width'];
						}
						$SimpleImg->resizeToWidth($newW);
					}
					$SimpleImg->save($ulfd.$newfn);
					return $newfn;
			    }
			} else {
				echo "Invalid file";
				return false;
			}
		}
	}

 ?>