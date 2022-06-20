
<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP CRUD</title>
        <!-- CSS Only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body class="bg-dark">
        <?php require_once 'process.php';?>

        <?php 
        if(isset($_SESSION['message'])): ?>
       <div class="alert alert-<?=$_SESSION['msg_type']?>"> 

            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
      </div>
        <?php endif; ?>
        <div class="container">
        <?php
             $mysqli= new mysqli('localhost', 'root', 'uzo123amaka', 'crud') 
             or die(mysqli_error($mysqli));
             $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
             //pre_r($result);
        ?>


        <div class="row justify-content-center">
            <table class="table bg-success">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
            <?php 
                while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-white"><?php echo $row ['name'];?></td>
                        <td class="text-warning"><?php echo $row ['location'];?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id'];?>"
                            class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id'];?>"
                            class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
        function pre_r($array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

        ?>

        <div class="d-flex aligns-items-center justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input class="form-control" type="text" name="location" value="<?php echo $location; ?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                <?php
                if($update==true):
                ?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif;?>
                </div>
            </form>
        </div>

<!--Javascript Only-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>
    