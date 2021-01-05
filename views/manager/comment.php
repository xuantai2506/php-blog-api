<div class="comment-main">
    <div class="comment comment-avatar">
        <?php 
    	if(!empty($_SESSION['images'])) {
    	?>
            <img src="<?php echo "media/upload/member/".$_SESSION['images']; ?>" alt="">
        <?php 
        }else { 
        ?>
            <img src="https://cheerup.theme-sphere.com/wp-content/uploads/2016/05/bella-doe.jpg" alt="">
        <?php 
        } 
        ?>
    </div>
    <div class="comment comment-content">
        <div class="comment-meta">
            <span class="meta-item name">
                <strong><?php if(!empty($_SESSION['name'])) {
                    echo $_SESSION['name'];
                }?></strong><br>
            </span>
            <span class="meta-item reply">
               <a href="#" data-id="">reply</a>
            </span>
        </div>
        <div class="comment-text">
            <?php echo $this->data['comment']; ?>
        </div>
    </div>
</div>