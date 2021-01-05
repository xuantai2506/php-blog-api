
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog</title>

 <!-- CSS -->
 <link rel="stylesheet" href="media/css/index.css">
 <link rel="stylesheet" href="media/css/blog_detail.css">
 <link rel="stylesheet" href="media/css/manager.css">
 <link rel="stylesheet" href="media/css/icons.css">

 <!-- GG FONT -->
 <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

 <?php 
global $enableOB;
if($enableOB) {
    ob_start("html_helpers::_media"); 
    echo "CSSABOVE";
}
echo html_helpers::cssHeader();
?>