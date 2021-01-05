<!-- The Modal -->
    <div id="id01" class="modal">
    
        <!-- Modal Content -->
        <form class="modal-content animate" method="post" action="<?php echo html_helpers::url(array('ctl'=>'member','act'=>'loginUser')); ?>">
        <div class="imgcontainer">
            <img src="media/image/img_568657.png" alt="Avatar" class="avatar">
        </div>
    
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="data[member][name]" required>
    
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="data[member][password]" required>
    
            <button type="submit" name="login">Login</button>
            <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>
    
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
        </div>
        </form>
    </div>

    <!-- The Modal REGISTER -->
    <div id="id02" class="modal">
    
        <!-- Modal Content -->
        <form method="post" class="modal-content animate"  enctype="multipart/form-data"
        action="<?php echo html_helpers::url(array('ctl'=>'member','act'=>'registerUser')); ?>" >

        <div class="imgcontainer">
            <img src="media/image/img_568657.png" alt="Avatar" class="avatar">
        </div>
    
        <div class="container">
            <label for="uname"><b>Username (*)</b></label>
            <input type="text" placeholder="Enter Username" name="data[member][name]" required>
            
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="data[member][password]" required>
            
            <label for="images"><b>Images</b></label><br>
            <input type="file" name="images" style="margin-bottom: 20px">

            <label for="countries"><b>Countries</b></label>
            <select name="data[member][countries]" id="">
                <option value="0">---Countries---</option>

                <?php while ($row = mysqli_fetch_array($this->countries)) :?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="register">Register</button>
            <label>
          <!--   <input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
        </div>
    
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
            <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
        </div>
        </form>
    </div>