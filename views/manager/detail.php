<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Detail</title>
    <?php include "views/layout/head.php"; ?>
     <!-- BOOTSTRAP -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include "views/layout/header.php"; ?>

    <section>
        <div class="container">
            <h1 style="text-align: center;margin-bottom: 20px;font-size: 40px;">Detail</h1>
            <div class="list-blog">
                <div class="blog-item">
                    <h3><?php echo $this->details['title']; ?></h3>
                    <div class="date-comment">
                        <p class="date"><?php echo $this->details['created_at']; ?> </p> - <strong class="comment"> 3 Comment</strong>
                    </div>
                    <img width="100%" height="80%" src="<?php echo "media/upload/".$this->controller.'/'.$this->details['images']; ?>" alt="">
                    <p class="content">
                        <?php echo $this->details['content']; ?>
                    </p>
                    <div class="like-blog">
                        <ul>
                            <li class="like">
                                <a href="#" id="<?php echo $this->details['id']; ?>" class="likes-count tsi tsi-heart-o">
                                    <?php 
                                        while($rows = mysqli_fetch_array($this->likes)) :
                                            if($this->details['id'] == $rows['blog_id']) :
                                    ?>
                                                 <span class="number" id="<?php echo "number_like_".$this->details['id']; ?>"><?php echo $rows['likes']; ?></span>
                                    <?php  
                                            endif;
                                        endwhile; 
                                    ?>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="tsi tsi-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="tsi tsi-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="tsi tsi-pinterest-p"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="tsi tsi-envelope-o"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- author -->
            <div class="author">
                <div class="image">
                    <img src="https://cheerup.theme-sphere.com/wp-content/uploads/2016/05/admin-avatar.jpg"
                     class="avatar avatar-82 photo" alt="">
                </div>
                <div class="author-content">
                    <span>Author</span><br>
                    <a style="color: black;" href="Shane Doe">Shane Doe</a>
                    <p class="author-bio">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                         totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.
                    </p>
                </div>
            </div>
            <!-- comment -->
            <div class="comment-box">
                <div class="comment-part">
                    <span class="number-comment"></span>
                    <span class="comment">comment</span>
                </div>

                <div class="comments">
                    <input type="hidden" id="blog_id" value="<?php echo $this->details['id']; ?>" name="">
                	<?php 
                	while($row = mysqli_fetch_array($this->comments)) :
                	 ?>
                    <!-- comment main -->
                    <div class="comment-main main-<?php echo $row['comment_id']?>">
                        <div class="comment comment-avatar">
                            <?php 
                        	if($row['images'] == '') {
                        	 ?>
                            	<img src="https://cheerup.theme-sphere.com/wp-content/uploads/2016/05/bella-doe.jpg" alt="">
	                        <?php }else { ?>
								<img src="<?php echo "media/upload/member/".$row['images'] ?>" alt="">
	                        <?php } ?>
                        </div>
                        <div class="comment comment-content">
                            <div class="comment-meta">
                                <span class="meta-item name">
                                    <strong><?php echo $row['name']; ?></strong><br>
                                </span>
                                <span class="meta-item reply">
                                   <a href="#" data-id="<?php echo $row['comment_id']; ?>">reply</a>
                                </span>
                            </div>
                            <div class="comment-text">
                                <?php echo $row['comment']; ?>
                            </div>
                        </div>
                    </div>
                    <!-- reply -->
                    <!-- <div class="comment-reply">
                        <div class="comment comment-avatar">
                            <img src="https://cheerup.theme-sphere.com/wp-content/uploads/2016/05/bella-doe.jpg" alt="">
                        </div>
                        <div class="comment comment-content">
                            <div class="comment-meta">
                                <span class="meta-item name">
                                    <strong>Bella Doe</strong><br>
                                </span>
                                <span class="meta-item reply">
                                   <a href="#" data-id="1">reply</a>
                                </span>
                            </div>
                            <div class="comment-text">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facilis totam laboriosam beatae, iste illo inventore tenetur possimus, eveniet quos enim aliquam, pariatur excepturi. Totam eum alias, numquam nesciunt architecto suscipit.
                            </div>
                        </div>
                    </div> -->
                    <div class="comment-reply-input" id="reply-<?php echo $row['comment_id']; ?>">
                        <form method="post" action="javascript:void(0)">
                            <input type="text" data-id="<?php echo $row['comment_id']; ?>" class="comment_reply" name="comment" placeholder="Nhập comment reply nào">
                        </form>
                    </div>

                    <?php 
                	endwhile ;
                     ?>
                </div>

                <div class="comment-main-input">
                    <form method="post" action="javascript:void(0)">
                        <input type="text" id="comment_main" name="comment" placeholder="Nhập comment nhận xét bài viết nào">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- The Modal -->
    <?php include "views/layout/modal.php"; ?>
   	<?php include "views/layout/script.php"; ?>
</body>
</html>