<?php 

	class manager_controller extends main_controller {
		public function index(){
			$options = [];
			$list_blog = [];
			$member = member_model::getInstance();
			$manager = manager_model::getInstance();

			$user_id = $this->user['id'];
			$options['conditions'] = "user_id='".$user_id."'";
			$blog_of_user = $manager->getAllRecords("*",$options) ;
			while($row = $blog_of_user->fetch_assoc()){
				array_push($list_blog, $row);
			};
			$list_blogs = array_combine(['list_blog'], [$list_blog]);
			if($list_blogs != []){
				header("HTTP/1.1 200 OK");
				$response = $this->generateResponseHTTP(1,200,'Show blog successfully !',$list_blogs);
			}else {
				$response = $this->generateResponseHTTP(0,400,'Fail');
			}
			echo json_encode($response);
		}
		
		public function add(){
			$json = file_get_contents('php://input');
			// Converts it into a PHP object
			$data = json_decode($json);

			$user_id 			= $this->user['id'];
			$title 				= $data->title ;
			$name 				= $data->name ;
			$description 		= $data->description ;
			$image 				= $data->image;
			$content 			= $data->Content;
			$date 				= date('Y/m/d H:i:s');

			$blog_data = [
				'user_id' 		=> $this->user['id'],
				'title'   		=> $title,
				'description' 	=> $description,
				'images' 		=> $image,
				'name'			=> $name,
				'Content'		=> $content,
				'updated'		=> $date ,
				'created' 		=> $date,
			];
			
			$manager = manager_model::getInstance();
			if($manager->addRecord($blog_data)){
				header("HTTP/1.1 200 OK");
				$response = $this->generateResponseHTTP(true,200,'Add Blog Successfully !');
			}else {
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(false,400,'ADd Blog Fail !');
			}
			echo json_encode($response);die();
		}
		public function getBlogEdit($id){
			$json = file_get_contents('php://input');
			// Converts it into a PHP object
			$data = json_decode($json);
			$manager = manager_model::getInstance();
			$this->records = $manager->getRecord($id);
			$get_blog_edit['blog_edit'] = $this->records;
			if($this->records){
				header("HTTP/1.1 200 OK");
				$response = $this->generateResponseHTTP(1,200,'Get Blog For Edit Successfully !',$get_blog_edit);
			}else {
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(false,400,'Get Blog For Edit Fail !');
			}
			echo json_encode($response);
		}
		public function edit($id){
			$manager = manager_model::getInstance();

			$json = file_get_contents('php://input');
			// Converts it into a PHP object
			$data = json_decode($json);

			$user_id 			= $this->user['id'];
			$title 				= $data->title ;
			$name 				= $data->name ;
			$description 		= $data->description ;
			$image 				= $data->image;
			$content 			= $data->Content;
			$date 				= date('Y/m/d H:i:s');

			$blog_data = [
				'user_id' 		=> $this->user['id'],
				'title'   		=> $title,
				'description' 	=> $description,
				'images' 		=> "string",
				'name'			=> $name,
				'Content'		=> $content,
				'updated'		=> $date ,
				'created' 		=> $date,
			];
			// if(isset($_FILES) and $_FILES['images']['name']){
			// 	if(file_exists(RootURI.'/media/upload/'.$this->controller.'/'.$this->records['images'])){
			// 		unlink(RootURI.'/media/upload/'.$this->controller.'/'.$this->records['images']);
			// 	}
			// 	$data['images'] = $this->uploadImg($_FILES);
			// }
			if($manager->editRecord($id,$blog_data)){
				header("HTTP/1.1 200 OK");
				$response = $this->generateResponseHTTP(1,200,'Edit Successfully !',$blog_data);
			}else {
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(false,400,'Edit Fail !');
			}
			echo json_encode($response);
		}

		public function del($id){
			$manager = manager_model::getInstance();

			if($manager->delRecord($id)){
				header("HTTP/1.1 200 OK");
				$user_id = $this->user['id'];
				$list_blog = [];
				$options['conditions'] = "user_id='".$user_id."'";
				$blog_of_user = $manager->getAllRecords("*",$options) ;
				while($row = $blog_of_user->fetch_assoc()){
					array_push($list_blog, $row);
				};
				$list_blogs = array_combine(['list_blog'], [$list_blog]);
				$response = $this->generateResponseHTTP(1,200,'Delete Successfully !',$list_blogs);
			}else {
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(false,400,'Delete Fail !');
			}
			echo json_encode($response);
		}

		public function getCommentOfBlog($id){
			$list_comment = [];
			$comment = comment_model::getInstance();
			$options['conditions'] = 'blog_id = ' .$id;
 			$get_comment = $comment->getAllRecordsJoinTable('* ,comments.id as `comment_id`',"`comments` JOIN `users`","comments.user_id = users.id",$options);
 			while($row = $get_comment->fetch_assoc()){
					array_push($list_comment, $row);
			};
 			return $list_comment;
		}

		public function detail($id){
			$options = [];
			$data = [];
			$manager = manager_model::getInstance();
			$likes = like_model::getInstance();

			$fields = 'likes.blog_id as `blog_id`,COUNT(likes.blog_id) as `likes`';
			$options['group_by'] = 'likes.blog_id';
			$data['likes'] = $likes->getAllRecords($fields,$options);

 			$data['comment'] = self::getCommentOfBlog($id);
 			// var_dump($data['comment']);die();
			$data['detail'] = $manager->getRecord($id);
			
			if($data['detail'] != false ){
				header("HTTP/1.1 200 OK");
				$response = $this->generateResponseHTTP(1,200,'show detail successfully !',$data);
				echo json_encode($response);
			}else {
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(0,400,'Show detail fail !');
				echo json_encode($response);
			}
		}

		public function check($user_id,$blog_id){
			$options = [];
			$like_model = like_model::getInstance();
			$options['conditions'] = "user_id = ".$user_id." and blog_id = ".$blog_id;
			$check = $like_model->getAllRecords('*',$options);
			if($check->num_rows > 0){
				return true ;
			}else {
				return false;
			}
		}

		// AJAX
		public function likeBlog(){
			$data = [];
			$like_model = like_model::getInstance();
			$member = member_model::getInstance();

			$user_id = $member->getUserId();
			$blog_id = isset($_POST['id']) ? $_POST['id'] : "";
			$count   = isset($_POST['count']) ? $_POST['count'] : "";
			
			$data = [
				'user_id' => $user_id,
				'blog_id' => $blog_id,
			];

			$check = self::check($user_id,$blog_id);

			if($check){
				$options['conditions'] = "user_id = ".$user_id." and blog_id = ".$blog_id;
				$record = $like_model->getAllRecords('id',$options)->fetch_assoc();
				$id = $record['id'];
				$like_model->delRecord($id);
				--$count;
				echo $count;
			}else {
				$like_model->addRecord($data);
				++$count;
				echo $count;
			}
		}

		public function comment(){

			$json = file_get_contents('php://input');
			// Converts it into a PHP object
			$data = json_decode($json);
			$comment_model = comment_model::getInstance();
			$user = $this->user;
			$date 	 = date('Y/m/d H:i:s');

			$comment_data = [
				'user_id' => $user['id'],
				'blog_id' => $data->blog_id,
				'comment' => $data->comment,
				'parent'  => 0,
				'created' => $date,
				'updated' => $date,
			];

			if($comment_model->addRecord($comment_data) ) {
				header("HTTP/1.1 200 OK");
				$list_comment['list_comment'] = self::getCommentOfBlog($data->blog_id);
				$comment_data['name'] = $user['name'];
				$response = $this->generateResponseHTTP(1,200,'Comment successfully !',$list_comment);
			} else {
				header('Status : 400 not found');
				$response = $this->generateResponseHTTP(0,400,'Comment Fail !');
			};
			echo json_encode($response);
		}

		public function reply(){
			$member = member_model::getInstance();
			$comment_model = comment_model::getInstance();
			$user_id = $member->getUserId();

			if(isset($_POST['blog_id'])){
				$blog_id = $_POST['blog_id'];
			}
			if(isset($_POST['comment_reply'])){
				$comment_reply = $_POST['comment_reply'];
			}
			if(isset($_POST['comment_parent_id'])){
				$parent = $_POST['comment_parent_id'];
			}
			$users = $member->getRecord($user_id);
			$data = array(
				'user_id' => $user_id,
				'blog_id' => $blog_id,
				'comment' => $comment_reply,
				'parent'  => $parent
			);
			// $comment_model->addRecord($data)
			if( true) {
				$data['images'] = $users['images'];
				$data['name'] = $users['name'];
				echo json_encode($data);
			} else {
				echo json_encode('error');
			};
			exit;
		}
		// END AJAX
	}

 ?>