<?php

$db = new mysqli("localhost", "veninatb", "Quincy7", "veninatb");
if ($db->connect_error)
{
    die ("Connection failed: " . $db->connect_error);
}

session_start();

$check=$_SESSION['bid'];
 if ($_SESSION['type']=='1')  
 {   
        $uid=$_SESSION['user_id'];
        $q1="SELECT bid From userRegister WHERE (uid='$uid');";
        $r1 = $db->query($q1);
        if($r1->num_rows>0){
            while($row = $r1->fetch_assoc()){
                $bid = $row['bid'];
            }
        }
        echo "<script>console.log(\"uid\", '".$uid."')</script>";
        echo "<script>console.log(\"bid\", '".$bid."')</script>";
        $q11="SELECT corporateName From Corporate WHERE (bid='$bid');";
        $r11=$db->query($q11);
        $get_company_name=$r11->fetch_assoc();
        //get company name


        if(isset($_POST["submitted"]) && $_POST["submitted"])
        {
          $uid=$_POST["submitted"];
          $q4="UPDATE Alert SET alertLevel=0 WHERE uid=$uid;"; //change alert status in this section
          
          $update_alert=$db->query($q4);
        }
}
else
{
  header("Location: http://www2.cs.uregina.ca/~veninatb/Signup.php");
  die();
} 

?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style2.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>


<body>  
    <div class="navigationBar">
        <div class="logo">
            Covid BusinessPro
        </div>
        <a class="logout" href="http://www2.cs.uregina.ca/~veninatb/Logout.php">Logout</a>
        <div  class="position"> <button id="alert_button">Search Departments</button></div>
    </div>
    

    <nav id="sidebar">
      <ul class="dots">
        <li>
          <a href="#">
            <span class="glyphicon glyphicon-envelope"><mark id="newAlerts" class="big swing"></mark> <img style="width: 30px;" src="bell.png" alt="bell.png"></span>
          </a>
        </li>
      </ul>
    </nav>

    <div class="container3">
      <div id="name" class="bubble">
      </div>
    </div>

      <div class="container2">
        <div id="employee_alert" class="alert hidden">
          <div id="change">
          </div>
          <div id="departments1">
            <h3 class="center">Departments</h3>
              <hr />
                <form name="departmentClick" method="post" id="department_list_form">
                    <div class="departmentButtons">
                        <input type="hidden" name="department_list" class="myInput">
                        <ul style="list-style-type:none;">
                            <?php
                            $q2="SELECT DISTINCT department From Departments WHERE (bid='$bid');";
                            $get_department_list = $db->query($q2);
                            $i=0;
                            while($department = $get_department_list->fetch_assoc()){ 
                            ?>
                                <li><button class="regular" type="submit" name="<?=$i?>" value=""><?= $department["department"]?></button></li>
                            <?php
                                $i++;
                            }
                            ?>
                        </ul>
                      </div>
                </form>
          </div>
        </div>
      </div>

    <h2 id="<?= $bid?>" class="hide find_id"><?= $get_company_name["corporateName"]?></h2>
    <div class="container center">
        <div id="department_list" class="department">
        <h3 class="center">Alerts</h3>
          <hr />
          <div class="center">
            <input type="text" id="myInput_alert" class="myInput" onkeyup="myFunction()" placeholder="Search for names" title="Type in a name">
            <div class="max_height">
              <ul id="myUL" >
                  <form id="add_alert_list" action="Main.php" method="POST">
                <!-- add_alert list here ajax -->
                  </form>
              </ul>
            </div>
          </div>
        </div>
      </div>
              

       <script type="text/javascript" src="Main.js"></script>  
       <script type = "text/javascript"  src = "ajaxMain.js"></script> 
</body>
</html>

<?php
  $sid=$_SESSION["username"];
  $q2="SELECT DISTINCT department From Departments WHERE (bid='$bid');";
  $r2 = $db->query($q2);
  $departmentArray = array();
  $count = 0;
  while($row2 = $r2->fetch_assoc()){ 
    $departmentArray[] = $row2['department'];
    $count++;
  }
  
  for ($x = 0; $x < $count; $x++) {
    if(isset($_POST[$x])) { 
      $dep =  $departmentArray[$x];
      echo "<script>
      document.getElementById(\"departments1\").style.display = \"none\";
      var employees = document.createElement('div');
      employees.innerHTML = '<div id=\"employee_list\"><form method=\"post\"><button class=\"backButton\" type=\"submit\" id=\"back\" name=\"back\">Back</button></form><h3 class=\"center backTitle\">".$dep."</h3><br/><hr /><div class=\"center\"><input type=\"text\" id=\"myInput_employee\" class=\"myInput\" onkeyup=\"find_employee()\" placeholder=\"Search for names\" title=\"Type in a name\"><div class=\"max_height\"><ul id=\"myUL_employee\"></ul></div></div></form></div>';
      document.getElementById(\"change\").appendChild(employees);
      var element = document.getElementById(\"employee_alert\");
      element.classList.remove(\"hidden\");
      </script>";
      
      $q4="SELECT uid From Departments WHERE (department='$dep');";
      $r4 = $db->query($q4);
      $employeeArray = array();
      while($row4 = $r4->fetch_assoc()){ 
        $employeeArray[] = $row4['uid'];
      }
      for ($i = 0; $i < count($employeeArray); $i++) {
        $q5="SELECT username,uid From userRegister WHERE (uid='$employeeArray[$i]');";
        $r5 = $db->query($q5);
        $usernameArray = array();
        while($row5 = $r5->fetch_assoc()){ 
          echo "<script>
            var txt = document.createElement('li');
            txt.innerHTML = '<a href=userProfile.php?uid=".$row5[uid].">".$row5['username']."</a>';
            document.getElementById(\"myUL_employee\").appendChild(txt);
          </script>";
          }
        }
    }
    
  }

  if(isset($_POST['back'])) { 
    echo "<script>
      document.getElementById(\"departments1\").style.display = \"block\";
      document.getElementById(\"change\").style.display = \"none\";
      var element = document.getElementById(\"employee_alert\");
      element.classList.remove(\"hidden\");
    </script>";
  }

?>
