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
                        <?php include "views/manager/_form.php"; ?>
                    </div>
                    <div class="col-3">
                        <?php include "views/widget/sidebar.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "views/layout/modal.php"; ?>

    <?php include "views/layout/script.php"; ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>