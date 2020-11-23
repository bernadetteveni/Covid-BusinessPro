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
        <a href="http://www2.cs.uregina.ca/~veninatb/ENSEProject/Signup.html">Logout</a>  
        <a href="http://www2.cs.uregina.ca/~veninatb/ENSEProject/Questionairre.php">Questionnaire</a> 
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
        <h2>User Profile</h2>
        <hr />
        <div id="text"></div>
        <div id="text2"></div>
        <br>
        <h3 class="chart">Weekly Trend</h3>
        <div id="bar-chart">
        <div class="graph">
            <ul class="x-axis">
            <li><span>2010</span></li>
            <li><span>2012</span></li>
            <li><span>2013</span></li>
            <li><span>2014</span></li>
            <li><span>2015</span></li>
            </ul>
            <ul class="y-axis">
            <li><span>20</span></li>
            <li><span>15</span></li>
            <li><span>10</span></li>
            <li><span>5</span></li>
            <li><span>0</span></li>
            </ul>
                <div class="bars">
                    <div class="bar-group">
                         <div class="bar bar-1 stat-1" style="height: 51%;">      
                            <span>4080</span>
                         </div>
                    <div class="bar bar-2 stat-2" style="height: 71%;">
                        <span>5680</span>
                    </div>
                    <div class="bar bar-3 stat-3" style="height: 13%;">
                        <span>1040</span>
                    </div>
                </div>
            <div class="bar-group">
                <div class="bar bar-4 stat-1" style="height: 76%;">
                    <span>6080</span>
                </div>
            <div class="bar bar-5 stat-2" style="height: 86%;">
                <span>6880</span>
            </div>
            <div class="bar bar-6 stat-3" style="height: 22%;">
                <span>1760</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-7 stat-1" style="height: 78%;">
                <span>6240</span>
            </div>
            <div class="bar bar-8 stat-2" style="height: 72%;">
                <span>5760</span>
            </div>
            <div class="bar bar-9 stat-3" style="height: 36%;">
                <span>2880</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-10 stat-1" style="height: 44%;">
                <span>3520</span>
            </div>
            <div class="bar bar-11 stat-2" style="height: 64%;">
                <span>5120</span>
            </div>
            <div class="bar bar-12 stat-3" style="height: 59%">
                <span>4720</span>
            </div>
        </div>
        <div class="bar-group">
            <div class="bar bar-13 stat-1" style="height: 28%;">
                <span>2240</span>
            </div>
            <div class="bar bar-14 stat-2" style="height: 33%;">
                <span>2640</span>
            </div>
            <div class="bar bar-15 stat-3" style="height: 94%;">
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

    $q1 = "SELECT DISTINCT dateOfSurvey FROM Symptoms WHERE dateOfSurvey between date_sub(now(),INTERVAL 1 WEEK) and now()";
    $r1 = $db->query($q1);
    $htmlResult = "";
    $i=1;
    $dateArray = array();
    if($r1->num_rows>0){
        while($row = $r1->fetch_assoc()){
            $htmlResult = "<script>
            var txt = document.createElement('div');
            txt.innerHTML = '<li><button type=\"submit\" name=\"button".$i."\" id=\"active\">".$row["dateOfSurvey"]."</button></li>';
            document.getElementById(\"dates\").appendChild(txt);
            </script>";
            echo $htmlResult;
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

        $date=$dateArray[0];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
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

        $date=$dateArray[1];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
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

        $date=$dateArray[2];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
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

        $date=$dateArray[3];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
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

        $date=$dateArray[4];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
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

        $date=$dateArray[5];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
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

        $date=$dateArray[6];
        echo "<script>console.log('".$date."')</script>";
        $q2 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r2 = $db->query($q2);
        $htmlResult2 = "";
        
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Symptoms Log</h3><div id=\"list1\"></div>';
        document.getElementById(\"text\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
        </script>";
        while($row2 = $r2->fetch_assoc()){
                $htmlResult2 = "<script>
                    var txt = document.createElement('div');
                    txt.innerHTML = '<p>".$row2["symptom"]."</p>';
                    document.getElementById(\"list1\").appendChild(txt);
                    </script>";
                echo $htmlResult2;
        }

        $q3 = "SELECT DISTINCT department FROM logLocation WHERE (dateOfLog = '".$date."');";
        $r3 = $db->query($q3);
        $htmlResult3 = "";
        echo  "<script>
        var txt = document.createElement('div');
        txt.innerHTML = '<h3>Locations Log</h3><div id=\"list2\"></div>';
        document.getElementById(\"text2\").appendChild(txt);
        document.getElementById(\"active\").style.background='black';
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

?> 
