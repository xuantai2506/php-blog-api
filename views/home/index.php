<!DOCTYPE html>
<html lang="en">
<head>
<?php include "views/layout/head.php"; ?>
</head>
<body>
    
    <?php include "views/layout/header.php"; ?>
    <section>
        <div class="container">
            <h1 style="text-align: center;margin-bottom: 20px;font-size: 40px;">Trang chủ</h1>

            <!-- <div class="bot-status">
                <form action="">
                    <input type="text" id="editor">
                    <br>
                    <button>Save</button>
                </form>
            </div> -->

            <div class="list-blog">
                <?php while($row = mysqli_fetch_array($this->blog)) : ?>
                <div class="blog-item">
                    <h3><?php echo $row['title']; ?></h3>
                    <div class="date-comment">
                        <p class="date"><?php echo $row['created_at'] ?> </p> - <strong class="comment"> 3 Comment</strong>
                    </div>
                    <img width="100%" height="80%" src="media/upload/manager/<?php echo $row['images']; ?>" alt="">
                    <p class="content">
                        <?php echo $row['description']; ?>
                    </p>
                    <p class="continue">
                        <a href="<?php echo html_helpers::url(array('ctl'=>'manager','act'=>'detail','params'=>array('id'=>$row['id']))) ?>" >CONTINUE READING</a>
                    </p>
                    <div class="like-blog">
                        <ul>
                            <li class="like">
                                <a href="#" id="<?php echo $row['id']; ?>" class="likes-count tsi tsi-heart-o">
                                    <?php 
                                        while($rows = mysqli_fetch_array($this->likes)) :
                                            if($row['id'] == $rows['blog_id']) :
                                    ?>
                                                 <span class="number" id="<?php echo "number_like_".$row['id']; ?>"><?php echo $rows['likes']; ?></span>
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
            <?php endwhile; ?>
                
            </div>
        </div>
    </section>

    <?php 
    	include "views/layout/modal.php";
     ?>
     <?php include "views/layout/script.php"; ?>
</body>
</html>