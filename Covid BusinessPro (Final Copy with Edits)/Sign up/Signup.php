<?php
  session_start();
  require_once('./connection.php');
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SignUp</title>
        <link rel="stylesheet" type="text/css" href="style4.css">
        <script type="text/javascript" src="Signup.js"></script>  
    </head>
<body>  
    <div class="navigationBar">
        <div class="logo">
            Covid BusinessPro
        </div>
    </div>

    <div class="signup_container center">
        <div class="signup_card" id="box">
            <div class="accordion" id="accordionExample">
                
                <div class="card-header" id="headingOne">
                    <a onClick="changeWidthBack();" class="btn btn-link btn-block text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Log in 
                    </a>
                </div>
            
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <form class="form-signin" action="Signup.php" method="POST">
                        <h1 class="h3 mb-3 font-weight-normal">Log in</h1>
                        <input type="email" class="signup_input form-control" placeholder="Email address" name="loginEmail" required autofocus>
                        <input type="password" class="signup_input form-control" placeholder="Password" name="loginPassword" required>
                        <input class="btn btn-lg btn-primary btn-block signup_button"  type="submit" value="Log in" name="login_submit">
                    </form>
                </div>

              <div class="card-header" id="headingTwo">
                  <a onClick="changeWidth();" class="btn btn-link btn-block text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Sign up
                  </a>
              </div>
<!-- Add sign up sections for: employee's full name, age, and list of corporations to 
    choose from (pulled from databasee) so that they can select where they work -->
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                <form class="form-signin" action="Signup.php" method="POST">
                    <div id="reg">
                      <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
                      <input id="email" type="email" class="signup_input form-control" placeholder="Email address" name="email" required autofocus>
                      <input id="pass" type="password" class="signup_input form-control" placeholder="Password" name="password"required>
                      <input id="uname" type="text" class="signup_input form-control" placeholder="User name" name="username" required autofocus>
                      <label for="birthDate" style="text-align: left;">Birth Date:
                      <input type="date" min='1899-01-01' id="birthDate" name="birthDate" class="signup_input form-control" onclick="getdate();" required/></label>  
                      <div id="employee_auth" style="visibility: hidden"> </div>
                      <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Employee Type:</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" onchange="HRcheck(this); empCheck(this);" name="checkInput" required>
                                <option value="none" selected>none</option>
                                <option value="0">Employee</option>
                                <option value="1">Human Resources</option>
                            </select>
                            
                        </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect02">Departments</label>
                                </div> 
                                <select class="custom-select" id="inputGroupSelect02" name="inputDepartment" onclick="pullDepartment();">
                                    <option selected>N/A</option>
                                </select>
                            </div>
                            <div id="error"></div> 
                        </div>
                        <div id="departments" style="visibility: hidden">
                            <h1 class="h3 mb-3 font-weight-normal">Departments</h1>
                            <input id="HrAuth" name="HrAuth" type="number" class="signup_input form-control" placeholder="Set Authentication" >
                            <input type="text" class="signup_input form-control" placeholder="Corporate name" id="Corp" name="corpName">
                            <p> Please list your corporation's departments:</p>
                            <input type="text" id="dep1" class="signup_input form-control" name="dep1[]">
                            <div id="dynamicCheck">
                                <div id="newDepartment"></div>
                                <input type="button" value="New department" class="signup_button" onclick="createNewElement();"/>
                            </div>
                        </div>
                        
                      <input type="submit" class="btn btn-lg btn-primary btn-block signup_button"  onchange="checkEmpType()" value="Sign up" name="SignUp"/>
                </form>
                   </div>
              </div>
          </div>
        </div>
       
    </div>
    <?php
        
        if(isset($_POST['SignUp'])){
            $corp =$_POST['corpName'];
            $hrauth=$_POST['HrAuth'];
            $email=$_POST['email'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $birthdate=$_POST['birthDate'];
            $emp=$_POST['checkInput'];
            $dep =$_POST['dep1']; 
            $empDep =$_POST['inputDepartment'];
            if($emp=='1'){
                $sql = "INSERT INTO Corporate (corporateName,accountAuthorization) VALUES ('$corp','$hrauth')";
                echo( mysqli_query($conn,$sql));
                    print_r("SUCCESS");

                $select_stmt_bid = "SELECT bid FROM Corporate WHERE accountAuthorization= '$_POST[HrAuth]' " ; //sql select query
                $bidquery= mysqli_query($conn,$select_stmt_bid);
                $row = mysqli_fetch_assoc($bidquery);
                $bid= $row['bid'];
                print_r($row['bid']);

                $sql2 = "INSERT INTO userRegister (bid,username, email, password, birthdate, accountType) VALUES ('$bid','$username','$email','$password','$birthdate', '$emp')";
                $userInserted=mysqli_query($conn, $sql2);
                print_r($userInserted);

                $select_stmt = "SELECT * FROM userRegister WHERE email= '$email' "; //sql select query
                $result= mysqli_query($conn,$select_stmt);
                $user = mysqli_fetch_assoc($result);
                print_r($user);
                print_r($dep);
                foreach($_POST['dep1'] as $i => $value){
                    $sql1= "INSERT INTO Departments (uid, bid, department) VALUES ('$user[uid]','$user[bid]', '$value')";
                    $depRegistered= mysqli_query($conn, $sql1);
                }
                $_SESSION["username"] = $user["username"];
                $_SESSION["user_id"] = $user['uid'];
                $_SESSION["type"]= $user['accountType'];
                echo "<script type='text/javascript'> document.location = 'userAgreement.php'; </script>";
                exit(0);
            }
            else if ($emp=='0' && ($empDep!='' || !empty($empDep) || $empDep!='N/A') ){
                $select_stmt_bid = "SELECT bid FROM Corporate WHERE accountAuthorization= '$_POST[empAuth]' " ; //sql select query
                $bidquery= mysqli_query($conn,$select_stmt_bid);
                $bidData = mysqli_fetch_assoc($bidquery);
                $bid= $bidData['bid'];
                $sql2 = "INSERT INTO userRegister (bid,username, email, password, birthdate, accountType) VALUES ('$bid','$username','$email','$password','$birthdate', '$emp')";
                $userInserted=mysqli_query($conn, $sql2);
                
                $select_stmt = "SELECT * FROM userRegister WHERE email= '$email' "; //sql select query
                $result= mysqli_query($conn,$select_stmt);
                $row = mysqli_fetch_assoc($result);
                $sql1= "INSERT INTO Departments (uid, bid, department) VALUES ('$row[uid]','$row[bid]', '$empDep')";
                $depRegistered= mysqli_query($conn, $sql1);
                $_SESSION["username"] = $row["username"];
                $_SESSION["user_id"] = $row['uid'];
                $_SESSION["type"]= $row['accountType'];
                echo "<script type='text/javascript'> document.location = 'userAgreement.php'; </script>";
                exit(0);
            }          
        }

        if(isset($_POST['login_submit'])){
            $email = $_POST["loginEmail"];
            $password =$_POST["loginPassword"];
            if (isset($_POST["loginEmail"])) {
                // header("Location:/userAgreement.html?Welcome_user='$email'&message=login_successfully");
                $select_stmt = "SELECT * FROM userRegister WHERE email= '$email' AND password= '$password' " ; //sql select query
                $result= mysqli_query($conn,$select_stmt); //execute query with bind parameter
               $row = mysqli_fetch_assoc($result);
               print_r($row);
               print_r($result->num_rows);
               if ($result->num_rows > 0) {
                
            		if (($email == $row["email"]) && ($password == $row["password"])) {
                        //print_r("worked in if");
            			$_SESSION["username"] = $row["username"];
                        $_SESSION["user_id"] = $row['uid'];
                        $_SESSION["type"]= $row['accountType'];
                        //header('Location: userAgreement.php');
                        echo "<script type='text/javascript'> document.location = 'userAgreement.php'; </script>";
                        //header("Location: Questionairre.php", true, 307);
                        //echo ("cant redirect");
            			exit(0);	//to redirect and stop current execution
            		}
            	} else {
                    print_r("didnt work");
            		header("Location: ./Signup.php?message=Invalid_Username_or_Pasword");
            		exit();	//to redirect and stop current execution
            	}
            }
        }
    ?>
    <script>
        function getdate(){
        document.getElementById('birthDate').max = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];
        }

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>  
</body>
</html>
<?php mysqli_close($conn); ?>