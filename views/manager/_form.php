<?php $id = isset($_GET['id']) ? $_GET['id'] : ""; ?>

<form method="post" enctype="multipart/form-data" action="<?php echo html_helpers::url(array('ctl'=>'manager','act'=>$this->action,'params'=>array('id'=>$id))) ?>">
  <div class="form-group">
    <label for="">Title</label>
    <input type="text" class="form-control" value="<?php echo isset($this->records) ? $this->records['title'] : ''?>" id="title" required name="data[<?php echo $this->controller; ?>][title]" placeholder="Enter Title">
  </div>
  <div class="form-group">
      <label for="exampleFormControlFile1">Upload Images</label>
      <input type="file" class="form-control-file" name="images" id="exampleFormControlFile1">
      <?php if (isset($this->records)): ?>
      <img src="<?php echo "media/upload/" .$this->controller.'/'.$this->records['images']; ?>" alt="<?php echo $this->records['title']; ?>" class="img-thumbnail">
      <?php endif; ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" required value="<?php echo isset($this->records) ? $this->records['description'] : ''?>" id="status" name="data[<?php echo $this->controller; ?>][description]" placeholder="Enter description">
  </div>
  <div class="form-group">
      <label for="">Content</label>
      <textarea type="text" id="editor" name="data[<?php echo $this->controller; ?>][content]">
        <?php echo isset($this->records) ? $this->records['content'] : ''?>
      </textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="submit_form">Submit</button>
</form>