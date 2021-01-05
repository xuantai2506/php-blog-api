<?php 

	class home_controller extends main_controller 
	{
		// Mucj dich : get all blog .
		public function index(){
			$options = [];
			$data = [];
			$list_blog = [];

			$countries = countries_model::getInstance();
			$manager = manager_model::getInstance();
			$likes = like_model::getInstance();

			$fields = 'likes.blog_id as `blog_id`,COUNT(likes.blog_id) as `likes`';
			$options['group_by'] = 'likes.blog_id';

			$likes = $likes->getAllRecords($fields,$options);
			$countries = $countries->getAllRecords()->fetch_all();
			$blog = $manager->getAllRecords("*");
			
			while ($row = $blog->fetch_assoc()) {
				array_push($list_blog,$row);
			}
			$list_key = ['likes','countries','blogs'];
			$list_value = [$likes,$countries,$list_blog];
			$data = array_combine($list_key,$list_value);

			if($data['blogs'] != false){
				header("HTTP/1.1 200 OK");
				$response = $this->generateResponseHTTP(1,200,'Show all blog successfully !',$data);
			}else {
				$response = $this->generateResponseHTTP(0,400,'Fail');
			}
			echo json_encode($response);
		}
	}

 ?>