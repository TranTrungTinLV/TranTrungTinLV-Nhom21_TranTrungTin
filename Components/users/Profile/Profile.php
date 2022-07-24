<?php
    require 'Connection.php';
    $_SESSION["id"] = 1; // User section
    $sessionId = $_SESSION["id"];
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));
    ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <form class = "form" id = "form" action = "" enctype="multipart/form-data" method = "post">
        <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-12 col-xl-4">

                <div class="card" style="border-radius: 15px;">
                <div class="card-body text-center">
                    <div class="mt-3 mb-4">
                        <?php
                            $id = $user["id"];
                            $name = $user["name"];
                            $image = $user["image"];
                            ?>
                    <img src="img/<?php echo $image;?>" title =  "img/<?php echo $image;?>"
                        class="rounded-circle img-fluid" style="width: 100px;" />
                    </div>
                    <h4 class="mb-2"></h4>
                    <p class="text-muted mb-4"><span class=""></span> 
                        </p>
                    <input type ="file" value = "Choosen" accept = ".jpg .jpeg .png" id = "img" class = "ml-5 mb-4">
                    <button type="button" class="btn btn-primary btn-rounded btn-lg">
                    Message now
                    </button>
                    
                </div>
                </div>

            </div>
            </div>
        </div>
        </section>
  </form>
    <script type ="text/javascript">
        doccument.getElementById("img").onchange = function() {
            doccument.getElementById('form').submit();
        }
    </script>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>