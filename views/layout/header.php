<header>
    <div class="container">
        <div class="task-bar">
            <div class="logo">
                <a href="index.php">Blog</a>
            </div>
            <div class="sign">
                <?php if(!empty($_SESSION['login'])){ ?>
                    <?php if($_SESSION['login'] == true){ ?>
                    <div class="sign-in">
                        <a href="<?php echo html_helpers::url(array('ctl'=>'manager')) ?>"><?php if(!empty($_SESSION['name'])) {echo $_SESSION['name'];} ?></a>
                    </div>
                    <div class="sign-up">
                        <a href="<?php echo html_helpers::url(array('ctl'=>'member','act'=>'logout')) ?>">/Logout</a>
                    </div>
                    <?php }
                    }else {?>

                    <div class="sign-in">
                        <a href="#" onclick="document.getElementById('id01').style.display='block'">Login</a>
                    </div>
                    <div class="sign-up">
                        <a href="#" onclick="document.getElementById('id02').style.display='block'">Register</a>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</header>