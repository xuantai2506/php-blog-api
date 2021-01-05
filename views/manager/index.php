<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "views/layout/head.php"; ?>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include "views/layout/header.php"; ?>

    <section>
        <div class="container">
            <h1 style="text-align: center;margin-bottom: 20px;font-size: 40px;">Trang Người Dùng</h1>

            <div class="list-blog">
                <div class="row">
                    <div class="col-9">
                        <table>
                            <tr>
                              <th>Id</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Images</th>
                              <th>Action</th>
                            </tr>
                            <?php $stt = 1; 
                            while($row = mysqli_fetch_array($this->list_blog)) : ?>
                            <tr>
                              <td><?php echo $stt++ ?></td>
                              <td>
                                <strong><?php echo $row['title']; ?></strong>
                              </td>
                              <td><?php echo $row['description']; ?></td>
                              <td>
                                  <img src="media/upload/<?php echo $this->controller; ?>/<?php echo $row['images']; ?>" alt="">
                              </td>
                              <td>
                                  <a href="<?php echo html_helpers::
                                  url(
                                  array('ctl'=>'manager',
                                        'act'=>'edit',
                                        'params'=>array(
                                            'id'=>$row['id']))) ?>">
                                        Edit</a> /
                                  <a href="<?php echo html_helpers::
                                  url(
                                  array('ctl'=>'manager',
                                        'act'=>'del',
                                        'params'=>array(
                                            'id'=>$row['id']))) ?>">
                                        Delete</a>
                              </td>
                            </tr>
                            <?php endwhile; ?>
    
                          </table>
                    </div>
                    <div class="col-3">
                        <?php include "views/widget/sidebar.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
        include "views/layout/modal.php";
     ?>
     <?php include "views/layout/script.php"; ?>
</body>
</html>