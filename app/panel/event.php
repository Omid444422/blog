<?php
session_start();

include '../models/Connect.php';
include '../../public/library/jdf.php';

$error = "";
$success = "";


if(!isset($_SESSION['user'])){
    header("location:../../index.php");
    exit();
}

if($_SESSION['user']['role'] < 10){
    header("location:../../index.php");
    exit();
}

if(isset($_GET['event']) & isset($_GET['id'])){
   $id = $_GET['id'];
}else {
    if(isset($_GET['event']) & isset($_GET['article_id'])){
        $article_id = $_GET['article_id'];
    }else{
    header("location:./index.php");
    }}


    if($_GET['event'] === "delete" & isset($_GET['article_id'])){
        $delete_art = $connection->query("DELETE FROM articles WHERE ID='$article_id'");
        $connection->close();
        header("location:./index.php?event=request_list");
    }

    if($_GET['event'] === "accept" & isset($_GET['article_id'])){
        $delete_art = $connection->query("UPDATE articles SET `status`=1 WHERE ID='$article_id'");
        $connection->close();
        header("location:./index.php?event=request_list");
    }




if(isset($_GET['event']) & isset($_GET['id'])){
    if($_GET['event'] === 'delete'){
        $id = $_GET['id'];
        $select = $connection->query("SELECT * FROM users WHERE ID='$id'");
        if($select->num_rows > 0){
            $delete = $connection->query("DELETE FROM users WHERE ID='$id'");
            header("location:./index.php?event=users");
        }
    }
}

?>

<?php
// submit edit form
    if(isset($_POST['btn_submit'])){
        if(isset($_POST['txt_name']) & $_POST['txt_name'] !== '' & isset($_POST['txt_email']) & $_POST['txt_email'] !== '' & isset($_POST['txt_password']) & $_POST['txt_password'] !== '' & isset($_POST['txt_role']) & $_POST['txt_role'] !== ''){
            global  $user_id;
            $name = $_POST['txt_name'];
            $email = $_POST['txt_email'];
            $role = $_POST['txt_role']; 
            $password = $_POST['txt_password'];

            if($role === "user"){
                $role = 1;
            }elseif($role === "writter"){
                $role = 6;
            }elseif($role === "admin"){
                $role = 10;
            }else {
                $role = 1;
            }

                $result = $connection->query("UPDATE users SET `Name`='$name',`Password`='$password',`Email`='$email',`Role`='$role',`Edited_by`='$user_id' WHERE ID='$id'") or die($error = "this email exist");
                $connection->close();
                header("location:./index.php?event=users");

        }else {
            $error = "لطفا فرم را کاملا پر کنید";
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-beJoAY4VI2Q+5IPXjI207/ntOuaz06QYCdpWfWRv4lSFDyUSqsM0W+wiAMr2I185" crossorigin="anonymous">
</head>
<body>

        <div class="container-fluid">
            <span id="timer" class="ms-3"></span>
        </div>
    
    <div class='row m-4 justify-content-center'>
        <?php
        if(isset($_GET['event']) & isset($_GET['id'])){
            if($_GET['event'] === 'edit'){
                $id = $_GET['id'];
                $edit = $connection->query("SELECT * FROM users WHERE ID='$id'");
                if($edit->num_rows > 0){
                    while($users = $edit->fetch_assoc()){
                        $role = "";
                        if($users['Role'] == 1){
                            $role = "user";
                        }elseif($users['Role'] >1 & $users['Role'] < 10){
                            $role = "writter";
                        }elseif($users['Role'] >=10){
                            $role = "admin";
                        }
        ?>
       <div class="col-6">

       <form action="./event.php?id=<?php echo $id;?>" method="POST">
            <label for="txt_name">نام کاربری</label>
            <input type="text" name="txt_name" value="<?php echo $users['Name']; ?>" class="form-control">
                <br>
            <label for="txt_password">پسورد:</label>
            <input type="password" name="txt_password" value="<?php echo $users['Password']; ?>" class="form-control">
            <br>
                <label for="txt_email">ایمیل:</label>
                <input type="text" name="txt_email" value="<?php echo $users['Email']; ?>" class="form-control">
                <br>
                <label for="txt_role">رول:</label>
                <select name="txt_role" id="txt_role" class="form-control">

                    <?php
                    $roles = $connection->query("SELECT * FROM roles");
                    if($roles->num_rows > 0){
                        while($result = $roles->fetch_assoc()){
                    ?>
                    <option <?php echo  $role == $result['role_name']?"selected":null ?>><?php echo $result['role_name']; ?></option>
                        <?php }}?>
                </select>
                <br>
                <br>

                <button name="btn_submit" class="btn btn-primary" type="submit">submit</button>
        </form>
                <br>
                <?php if(isset($error) && $error !== "" && $success === ""){?>
                <span class="alert alert-danger text-danger p-2 m-2"><?php echo $error;?></span>
                <?php }?>

                <?php if(isset($success) && $success !== "" && $error === ""){?>
                <span class="alert alert-success text-success p-2 m-2"><?php echo $success;?></span>
                <?php }?>
       </div>
       <?php }}}}?>
    </div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
        </script>
    

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