<?php
session_start();

include '../models/Connect.php';
include '../../public/library/jdf.php';

$error = "";
$user_id = $_SESSION['user']['id'];

if(isset($_SESSION['user'])){
    if($_SESSION['user']['role'] > 1){
        if(isset($_GET['event']) | isset($_GET['id'])){
          
            $id = $_GET['id'];
            if(isset($_GET['event'])){
                $event = $_GET['event'];
            }
        }else {
            header("location:./index.php?event=articles");
        }
    }else {
        header("location:./index.php");
    }
}else {
    header("location:../../index.php");
}

if(isset($_GET['event'])){
    
if($event == "delete"){
    $result = $connection->query("DELETE FROM articles WHERE ID='$id' AND `creator`='$user_id'");
    $connection->close();
    header("location:./index.php?event=articles");
}

}


if(isset($_POST['btn_submit'])){
    if(isset($_POST['txt_title']) & $_POST['txt_title'] !== "" & isset($_POST['txt_description']) & $_POST['txt_description'] !== "" & isset($_FILES['txt_file'])){
        $id = $_GET['id'];
        $title = $_POST['txt_title'];
        $description = $_POST['txt_description'];
        $file = $_FILES['txt_file'];
        $time = jdate('H:i:s ,Y/n/j');
        $uploaded_dir =time().".png";

move_uploaded_file($file['tmp_name'],"../../public/uploads/".$uploaded_dir);

        $result = $connection->query("UPDATE articles SET `article_title`='$title',`article_description`='$description',`image_src`='$uploaded_dir',`image_alt`='$uploaded_dir' WHERE `ID`='$id' AND `creator`='$user_id'");
        $error  = $id . " " . $user_id;
        header("location:./index.php?event=articles");
    }else {
        $error = "fill out the form";
    }
}




?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <span id="timer"></span>
        <?php if(isset($_GET['event'])){
            if($event == "edit"){
            ?>

         <div class="row justify-content-center">

        <div class="col-6">
            <?php
            $result = $connection->query("SELECT * FROM articles WHERE ID='$id' AND `creator`='$user_id'");
            if($result->num_rows > 0){
                while($posts = $result->fetch_assoc()){
            
            ?>
        <form action="./article_event.php?id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <label for="txt_title">title:</label>
            <input type="text" name="txt_title" value="<?php echo $posts['article_title'];?>" class="form-control">
            <br>
            <label for="txt_description">description:</label>
            <textarea name="txt_description" cols="30" rows="10" class="form-control"><?php echo $posts['article_description'];?></textarea>
            <br>
            <label for="txt_file">upload image</label>
            <input type="file" name="txt_file" value="/blog/public/uploads/<?php echo $posts['image_src'];?>" class="form-control">
            <br>
            <button name="btn_submit" class="btn btn-success" type="submit">submit</button>
        </form>
        <br>
        <?php if(isset($error) && $error !== ""){?>
                <span class="alert alert-danger text-danger p-2 m-2"><?php echo $error;?></span>
                <?php }?>
                <?php }}?>
        </div>

         </div>
            <?php }}?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
var timer = document.getElementById("timer");
        class timerDown{
             time =  240;
            
        print(){
             setInterval(() => {
           timer.innerHTML = "time left is" + " " + this.time;
           this.time=this.time -1;
           if(this.time == 0){
            location.href= "http://localhost:4444/blog/app/panel/index.php?event=users";
           } 
        },1000);
        }
        }

        const timer_down = new timerDown();
        timer_down.print();

    </script>

    </body>
</html>