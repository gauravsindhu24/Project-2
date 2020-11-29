<?php require('connection.php'); ?>
<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>
<?php
    $quesErr = $quesBodyError = $quesSkillsErr = "";
    $ques_name = $ques_body = $ques_skills = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $logged_in = $_POST["user_id"];
        if (empty($_POST["ques_name"])) {
            $quesErr = "Question name is required";
        } else {
            $ques_name = test_input($_POST["ques_name"]);
        }
    
        if (empty($_POST["ques_body"])) {
            $quesBodyError = "Question body is required";
        } else {
            $ques_body = test_input($_POST["ques_body"]);
        }
    
        if (empty($_POST["ques_skills"])) {
            $quesSkillsErr = "Question skills is required";
        } else {
            $ques_skills = test_input($_POST["ques_skills"]);
        }
    
    if(empty($quesErr) && empty($quesBodyError) && empty($quesSkillsErr))
    {
        $sql = "INSERT INTO tbl_questions (ques_name, ques_body, ques_skills, get_user_id) VALUES (?,?,?,?)";
        $stmt= $conn->prepare($sql);
        $result = $stmt->execute([$ques_name, $ques_body, $ques_skills, $logged_in]);
        if($result)
        {
            header("Location:view_questions.php");
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
    <div class="container">
        <div class="row">
            <h3>Welcome: <?= $_SESSION["f_name"] . " " . $_SESSION["l_name"]; ?></h3>
        </div>
        <div class="row" id="login-form">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Questions</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"]; ?>">
                        <fieldset>
                            <div class="form-group">
                            <label>Questions Name <small>*</small></label>
                                <input class="form-control" type="text" name="ques_name" pattern=".{3,}" required>
                                <span class="error"><?php echo $quesErr;?></span>
                            </div>
                            <div class="form-group">
                            <label>Questions Body <small>*</small></label>
                                <input class="form-control" type="text" name="ques_body" pattern=".{,500}" required>
                                <span class="error"><?php echo $quesBodyError;?></span>
                            </div>
                            <div class="form-group">
                            <label>Questions Skills <small>*</small></label>
                                <input class="form-control" type="text" name="ques_skills" required>
                                <span class="error"><?php echo $quesSkillsErr;?></span>
                            </div>
                            <input class="btn btn-success btn-block" type="submit" value="Add Questions">
                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('partials/footer.php'); ?>