<?php require('connection.php'); ?>
<?php
$FnameErr = $emailErr = $LnameErr = $bdayErr = $passwordErr = "";
$Fname = $Lname = $email = $bday = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Fname"])) {
        $FnameErr = "First Name is required";
    } else {
        $Fname = test_input($_POST["Fname"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["Lname"])) {
        $LnameErr = "Last Name is required";
    } else {
        $Lname = test_input($_POST["Lname"]);
    }

    if (empty($_POST["bday"])) {
        $bdayErr = "Birthday is required";
    } else {
        $bday = test_input($_POST["bday"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if(empty($FnameErr) && empty($emailErr) && empty($LnameErr) && empty($bdayErr) && empty($passwordErr))
    {
        $query = "SELECT * FROM tbl_users WHERE email = :email";  
        $statement = $conn->prepare($query); 
        $statement->execute(  
            array(  
                'email' => $_POST["email"],  
                )  
        );
        $row = $statement->rowCount();

        if($row > 0)
        {
            $emailExist =  "This email is already exist.";
        }
        else
        {
            $sql = "INSERT INTO tbl_users (f_name, l_name, b_day, email, pass) VALUES (?,?,?,?,?)";
            $stmt= $conn->prepare($sql);
            $result = $stmt->execute([$Fname, $Lname, $bday, $email, $password]);
            header("Location:index.php");
        }
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<?php require('partials/header.php'); ?>
<div class="container">
        <div class="row" id="login-form">
            <div class="col-md-4 col-md-offset-4">
                <?php if(isset($emailExist)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $emailExist; ?>
                    </div>
                <?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Registration Form</h3>
                    </div>
                    <div class="panel-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <fieldset>
                            <div class="form-group">
                            <label>First Name <small>*</small></label>
                                <input type="text" name="Fname" class="form-control" required>
                                <span class="error"><?php echo $FnameErr;?></span>
                            </div>
                            <div class="form-group">
                            <label>Last Name <small>*</small></label>
                                <input type="text" name="Lname" class="form-control" required />
                                <span class="error"><?php echo $LnameErr;?></span>
                            </div>
                            <div class="form-group">
                            <label>Birthday <small>*</small></label>
                                <input type="text" name="bday" class="form-control" required />
                                <span class="error"><?php echo $bdayErr;?></span>
                            </div>
                            <div class="form-group">
                            <label>Email <small>*</small></label>
                                <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                                <span class="error"><?php echo $emailErr;?></span>
                            </div>
                            <div class="form-group">
                            <label>Password <small>*</small></label>
                                <input type="password" name="password" class="form-control" pattern=".{8,}" required />
                                <span class="error"><?php echo $passwordErr;?></span>
                            </div>
                            <input class="btn btn-success btn-block" type="submit" value="Register">
                        </fieldset>
                        </form>
                        <hr/>
                        <center><h4>OR</h4></center>
                        <a href="index.php" class="btn btn-block btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('partials/footer.php'); ?>