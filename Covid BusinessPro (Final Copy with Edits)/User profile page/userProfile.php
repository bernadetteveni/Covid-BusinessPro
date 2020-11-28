<?php
    session_start();
    if ($_SESSION['type']=='1') 
    {$uid=$_GET['uid'];}
    else if($_SESSION['type']=='0') 
    {$uid = $_SESSION['user_id'];}
    echo "<script>console.log(\"logged in with uid\", '".$uid."')</script>";
    if(!isset($_SESSION['user_id'])){
        header("Location: http://184.169.60.213/Signup.php");
        die();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style3.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="navigationBar">
        <div class="logo">
            Covid BusinessPro
        </div>
        <a href="http://184.169.60.213/Logout.php">Logout</a>  
        <a href="http://184.169.60.213/Questionairre.php">Questionnaire</a> 
    </div>
    <div class="sidebar">
        <ul>
            <form method = "post">
                <p>Weekly Logs:</p>
                <div id="dates"></div>
            </form>
        </ul>
    </div>
    <div id="myDropdown" style="margin-left:200px;padding:1px 16px;">
        <h2 id="username" style="padding: 0; margin: 0;"></h2>
        <img src="avatar.png" alt="avatar.png" style="display: block; width: 80px; margin-left: auto; margin-right: auto;">
        <p id="age" style="text-align: center;"></p>
        <p id="corporation" style="text-align: center;"></p>
        <hr />
        <div id="text"></div>
        <div id="text2"></div>
        <br>
        <?php
           $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
           if ($db->connect_error)
           {
               echo "<script>console.log('Database connection failed')</script>";
               die ("Connection failed: " . $db->connect_error);
           }
     
            $start_date = date('Y-m-d');
            $date = DateTime::createFromFormat('Y-m-d',$start_date);
            $dateMod = DateTime::createFromFormat('Y-m-d',$start_date);
            $date->modify('-7 days');
            $dateformat= date('Y-m-d');
            $todayMaybe = date('Y-m-d', strtotime($today. ' - 0 days'));
            $dateformatMod;
        ?>
        <h3 class="chart">Weekly Trend</h3>
        <div id="bar-chart">
        <div class="graph">
            <ul class="x-axis">
            <?php

            $q1 = "SELECT DISTINCT dateOfSurvey FROM Symptoms WHERE (dateOfSurvey between date_sub(now(),INTERVAL 1 WEEK) and now()) AND (uid='$uid');";
            $r1 = $db->query($q1);
            //echo $r1;
           $noDay=0;
            while ($noDay !=7 ){
                $date->modify('1 days');
                echo"<li><span>".$date->format('Y-m-d')."</span></li>";
                $noDay++;
            };
            $today= date('Y-m-d');
            getsymptomsCount($db);
            function getsymptomsCount($db){
                $sql= "SELECT DISTINCT symptom FROM Symptoms where dateOfSurvey= '".date('Y-m-d', strtotime($today. ' - 0 days'))."' and uid ='$uid'";
                $q= $db->query($sql);
                $row = $q->fetch_assoc();
            }
            
            $dayHeight= array();
            $modDate=$dateMod->modify('-7 days');
            $height=array();                
                $newToday= date('Y-m-d', strtotime($today. ' - 7 days'));
                $today= date('Y-m-d', strtotime($today. ' - 8 days'));
                for($i=0; $i<7;$i++){
                    $sql= "SELECT DISTINCT symptom FROM Symptoms where dateOfSurvey= '".date('Y-m-d', strtotime($today. ' + 1 days'))."' and uid ='$uid'";
                    $q= $db->query($sql);
                    $row = $q->fetch_assoc();
                    $dayCount= $q->num_rows;
                    if($dayCount > 0 ){
                        $d = 7520 * 1.5 * $dayCount /1000;
                            array_push($dayHeight,"$d");
                            array_push($height,"$d");
                    }
                    else{
                        $j=2;
                        while($j!=2 && $dayCount=0){
                            $sql= "SELECT DISTINCT symptom FROM Symptoms where dateOfSurvey= '".date('Y-m-d', strtotime($today. ' + 1 days'))."' and uid ='$uid'";
                            $q= $db->query($sql);
                            $row = $q->fetch_assoc();
                            $dayCount= $q->num_rows;
                        }
                        if($dayCount >0 ){
                            $d = 7520 * 1.5 * $dayCount /1000;
                            array_push($dayHeight,"$d");
                            array_push($height,"$d");
                        }
                        else{
                            $d = 7520 * 1.5 * $dayCount /1000;
                            array_push($dayHeight,"$d");
                            array_push($height,"$d");
                        }        
                    }
                    $newToday = date('Y-m-d', strtotime($newToday. ' + 1 days'));
                    $today= $newToday;                   
                }
            ?>
            </ul>
            <ul class="y-axis">
            <li><span>8</span></li>
            <li><span>6</span></li>
            <li><span>4</span></li>
            <li><span>2</span></li>
            <li><span>0</span></li>
            </ul>
                
                 
            <div class="bars">
            <div class="bar-group">
                <div class="bar bar-1 stat-3" style="height: <?= $dayHeight[0]?>%;">
                    <span>1040</span>
                </div>             
            </div>
            <div class="bar-group">
            <div class="bar bar-2 stat-3" style="height: <?= $dayHeight[1]?>%;">
                <span>1760</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-3 stat-3" style="height:  <?= $dayHeight[2]?>%;">
                <span>2880</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-4 stat-3" style="height: <?= $dayHeight[3]?>%">
                <span>4720</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-5 stat-3" style="height: <?= $dayHeight[4]?>%;">
                <span>7520</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-6 stat-3" style="height: <?=$dayHeight[5]?>%;">
                <span>7520</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-7 stat-3" style="height: <?=$dayHeight[6]?>%;">
                <span>7520</span>
            </div>
        </div>
    </div>
  </div>
</div>
    </div>
    
</body>
</html>

<?php
    $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
    if ($db->connect_error)
    {
        echo "<script>console.log('Database connection failed')</script>";
        die ("Connection failed: " . $db->connect_error);
    }

    if ($_SESSION['type']=='1') 
    {$uid=$_GET['uid'];}
    else if($_SESSION['type']=='0') 
    {$uid = $_SESSION['user_id'];}
    $q0 = "SELECT username FROM userRegister WHERE uid = '$uid'";
    $r0 = $db->query($q0);
    while($rows0 = $r0->fetch_assoc()){
        echo "<script>
        var username = document.createElement('h2');
        username.innerHTML = '<h2>".$rows0['username']."</h2>';
        document.getElementById(\"username\").appendChild(username);
        </script>";
    }


    $q1 = "SELECT DISTINCT dateOfSurvey FROM Symptoms WHERE (dateOfSurvey between date_sub(now(),INTERVAL 1 WEEK) and now()) AND (uid='$uid');";
    $r1 = $db->query($q1);
    $htmlResult = "";
    $i=1;
    $dateArray = array();
    if($r1->num_rows>0){
        while($row = $r1->fetch_assoc()){
            $htmlResult = "<script>
            var txt = document.createElement('div');
            txt.innerHTML = '<li><button type=\"submit\" name=\"button".$i."\" id=\"active".$i."\">".$row["dateOfSurvey"]."</button></li>';
            document.getElementById(\"dates\").appendChild(txt);
            </script>";
            echo $htmlResult;
            $i++;
            $dateArray[] = $row['dateOfSurvey'];
        }
    }

    if(isset($_POST['button1'])) { 
        button1($dateArray); 
    } 
    else if(isset($_POST['button2'])) { 
        button2($dateArray); 
    } 
    else if(isset($_POST['button3'])) { 
        button3($dateArray); 
    } 
    else if(isset($_POST['button4'])) { 
        button4($dateArray); 
    } 
    else if(isset($_POST['button5'])) { 
        button5($dateArray); 
    } 
    else if(isset($_POST['button6'])) { 
        button6($dateArray); 
    } 
    else if(isset($_POST['button7'])) { 
        button7($dateArray); 
    } 

    function button1($dateArray) { 
        $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        echo "<script>console.log(\"inside button1\")</script>";

        if ($_SESSION['type']=='1') 
        {$uid=$_GET['uid'];}
        else if($_SESSION['type']=='0') 
        {$uid = $_SESSION['user_id'];}
        $date=$dateArray[0];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid='$uid');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active1\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."') AND (uid='$uid');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active1\").style.background='black';
        </script>";
        while($row3 = $r3->fetch_assoc()){
            $htmlResult3 = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<p>".$row3["department"]."</p>';
                document.getElementById(\"list2\").appendChild(txt);
                </script>";
            echo $htmlResult3;
         }
    } 

    function button2($dateArray) { 
        $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        echo "<script>console.log(\"inside button1\")</script>";

        if ($_SESSION['type']=='1') 
        {$uid=$_GET['uid'];}
        else if($_SESSION['type']=='0') 
        {$uid = $_SESSION['user_id'];}
        $date=$dateArray[1];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid='$uid');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active2\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."') AND (uid='$uid');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active2\").style.background='black';
        </script>";
        while($row3 = $r3->fetch_assoc()){
            $htmlResult3 = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<p>".$row3["department"]."</p>';
                document.getElementById(\"list2\").appendChild(txt);
                </script>";
            echo $htmlResult3;
         }
    } 

    function button3($dateArray) { 
        $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        echo "<script>console.log(\"inside button1\")</script>";

        if ($_SESSION['type']=='1') 
        {$uid=$_GET['uid'];}
        else if($_SESSION['type']=='0') 
        {$uid = $_SESSION['user_id'];}
        $date=$dateArray[2];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid='$uid');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active3\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."') AND (uid='$uid');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active3\").style.background='black';
        </script>";
        while($row3 = $r3->fetch_assoc()){
            $htmlResult3 = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<p>".$row3["department"]."</p>';
                document.getElementById(\"list2\").appendChild(txt);
                </script>";
            echo $htmlResult3;
         }
    } 

    function button4($dateArray) { 
        $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        echo "<script>console.log(\"inside button1\")</script>";

        if ($_SESSION['type']=='1') 
        {$uid=$_GET['uid'];}
        else if($_SESSION['type']=='0') 
        {$uid = $_SESSION['user_id'];}
        $date=$dateArray[3];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid='$uid');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active4\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."') AND (uid='$uid');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active4\").style.background='black';
        </script>";
        while($row3 = $r3->fetch_assoc()){
            $htmlResult3 = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<p>".$row3["department"]."</p>';
                document.getElementById(\"list2\").appendChild(txt);
                </script>";
            echo $htmlResult3;
         }
    } 

    function button5($dateArray) { 
        $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        echo "<script>console.log(\"inside button1\")</script>";

        if ($_SESSION['type']=='1') 
        {$uid=$_GET['uid'];}
        else if($_SESSION['type']=='0') 
        {$uid = $_SESSION['user_id'];}
        $date=$dateArray[4];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid='$uid');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active5\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."') AND (uid='$uid');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active5\").style.background='black';
        </script>";
        while($row3 = $r3->fetch_assoc()){
            $htmlResult3 = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<p>".$row3["department"]."</p>';
                document.getElementById(\"list2\").appendChild(txt);
                </script>";
            echo $htmlResult3;
         }
    } 

    function button6($dateArray) { 
        $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        echo "<script>console.log(\"inside button1\")</script>";

        if ($_SESSION['type']=='1') 
        {$uid=$_GET['uid'];}
        else if($_SESSION['type']=='0') 
        {$uid = $_SESSION['user_id'];}
        $date=$dateArray[5];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid='$uid');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active6\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."') AND (uid='$uid');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active6\").style.background='black';
        </script>";
        while($row3 = $r3->fetch_assoc()){
            $htmlResult3 = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<p>".$row3["department"]."</p>';
                document.getElementById(\"list2\").appendChild(txt);
                </script>";
            echo $htmlResult3;
         }
    } 

    function button7($dateArray) { 
        $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        echo "<script>console.log(\"inside button1\")</script>";

        if ($_SESSION['type']=='1') 
        {$uid=$_GET['uid'];}
        else if($_SESSION['type']=='0') 
        {$uid = $_SESSION['user_id'];}
        $date=$dateArray[6];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid='$uid');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active7\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."') AND (uid='$uid');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active7\").style.background='black';
        </script>";
        while($row3 = $r3->fetch_assoc()){
            $htmlResult3 = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<p>".$row3["department"]."</p>';
                document.getElementById(\"list2\").appendChild(txt);
                </script>";
            echo $htmlResult3;
         }
    } 

    $q77 = "SELECT birthdate FROM userRegister WHERE (uid = '".$uid."');";
    $r77 = $db->query($q77);
    while($row77 = $r77->fetch_assoc()){
        $birthdate = $row77['birthdate'];
    }
    echo "<script>console.log(".$birthdate.")</script>";

    $birthYear = DateTime::createFromFormat("Y-m-d", "$birthdate");
    $birth = $birthYear->format("Y");

    $date = date('Y-m-d');

    $todayYear = DateTime::createFromFormat("Y-m-d", "$date");
    $today = $todayYear->format("Y");
    
    $age=$today-$birth;

    echo $age;

    echo "<script>
    var age = document.createElement('p');
    age.innerHTML = '<p>Age: ".$age."</p>';
    document.getElementById(\"age\").appendChild(age);
    </script>";

    $q88 = "SELECT department, bid FROM Departments WHERE (uid = '".$uid."');";
    $r88 = $db->query($q88);
    while($row88 = $r88->fetch_assoc()){
        $department1 = $row88['department'];
        $bid = $row88['bid'];
    }

    $q99 = "SELECT corporateName FROM Corporate WHERE (bid = '".$bid."');";
    $r99 = $db->query($q99);
    while($row99 = $r99->fetch_assoc()){
        $Corporation = $row99['corporateName'];
    }

    echo "<script>
    var corp = document.createElement('p');
    corp.innerHTML = '<p>".$department1.", ".$Corporation." </p>';
    document.getElementById(\"corporation\").appendChild(corp);
    </script>";

?> 
