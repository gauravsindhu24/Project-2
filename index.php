<?php require('connection.php'); ?>
<?php
if(isset($_POST['login']))
{
    if (isset($_POST['email']) == true && empty($_POST['email']) == false) {
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
            echo 'That\'s a valid email address! ';
        } else {
            echo 'Not a valid email address! ';

        }
    }
    if (empty($_POST['password'])){
        echo 'Please enter a Valid password';
    }
    else {
        echo 'Valid Password';
    }

    $query = "SELECT * FROM tbl_users WHERE email = :email AND pass = :pass";  
    $statement = $conn->prepare($query);  
    $statement->execute(  
            array(  
                'email'     =>     $_POST["email"],  
                'pass'      =>     $_POST["password"]  
                )  
        );  
        $count = $statement->rowCount();  
        if($count > 0)  
            {  
                $query = "SELECT * FROM tbl_users WHERE email = :email";  
                $statement = $conn->prepare($query); 
                $statement->execute(  
                    array(  
                        'email' => $_POST["email"],  
                        )  
                );
                $row = $statement->fetch();
                $_SESSION["user_id"] =  $row['user_id'];
                $_SESSION["f_name"] =  $row['f_name'];
                $_SESSION["l_name"] =  $row['l_name'];
                header("location:view_questions.php");  
            }  
            else  
            {  
                $failed = "Your credetials does not match form our records";  
            }  
}
?>
     <?php require('partials/header.php'); ?>
     <div class="container">
        <div class="row" id="login-form">
            <div class="col-md-4 col-md-offset-4">
            <?php if(isset($failed)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $failed; ?>
                </div>
            <?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Form</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label>Email <small>*</small></label>
                                <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  value="" required>
                            </div>
                            <div class="form-group">
                            <label>Password <small>*</small></label>
                                <input type="password" name="password" class="form-control" value="" pattern=".{8,}" required >
                            </div>
                            <input class="btn btn-success btn-block" name="login" type="submit" value="Login">
                        </fieldset>
                        </form>
                        <hr/>
                        <center><h4>OR</h4></center>
                        <a href="registration.php" class="btn btn-block btn-primary">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('partials/footer.php'); ?>