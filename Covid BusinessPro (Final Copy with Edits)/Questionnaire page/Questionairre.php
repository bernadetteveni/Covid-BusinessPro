<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="Questionairre.js"></script>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
</html>
<body>  
    <div class="navigationBar">
        <div class="logo">
            Covid BusinessPro
        </div>
        <a href="http://www2.cs.uregina.ca/~veninatb/ENSEProject/Signup.html">Logout</a>
        <a href="http://www2.cs.uregina.ca/~veninatb/ENSEProject/userProfile.php">User Profile</a>
      </div>
      <h2>Daily Questionnaire</h2>

    <div id="cards" class="container center">
        <div class="card">
            <h2>Survey</h2>
            <hr />
            <p> In this survey you will be asked about potential symptoms of the virus. Please fill out the survey every day, also in cases where you are feeling well and do not experience any symptoms. All data will be used solely for tracking the spread of the virus and will not be shared with colleagues. Please understand that this questionnaire cannot diagnose coronavirus infection.</p>
            <button type="button" id="surveyButton">Take the Survey</button>
        </div>
        <div class="space">
            <div class="card">
                <h2>Log Locations</h2>
                <hr />
                <p>This survey is designed to locate potential areas where the coronavirus is spreading in your business. Please log your locations within your business every day, also in cases where you are feeling well and do not experience any symptoms. All data will be used solely for tracking the spread of the virus and will not be shared with colleagues.
                </p>
                <button type="button" id="locationsButton">Log your Locations</button>
            </div>
        </div>
    </div>

    <form method="post">  
        <div id="survey" class="survey">
            <h2>Survey</h2>
            <hr />
                <input type="checkbox" name="chkl[ ]" value="Symptom1">Symptom1<br />  
                <input type="checkbox" name="chkl[ ]" value="Symptom2">Symptom2<br />  
                <input type="checkbox" name="chkl[ ]" value="Symptom3">Symptom3<br />  
                <input type="checkbox" name="chkl[ ]" value="Symptom4">Symptom4<br />  
                <input type="checkbox" name="chkl[ ]" value="Symptom5">Symptom5<br /> 
                <br>
                <button type="submit" name="Submit" id="finishedSurvey">Done</button>
        </div>
    </form>
    <form method="post"> 
        <div id="locations" class="locations">
            <h2>Log Locations</h2>
            <hr />
            <div id="locations2">
            </div>
            <button type="submit" name="Submit2" id="finishedLocations">Done</button>
        </div>
    </form>
    <script type="text/javascript" src="QuestionairreEvents.js"></script> 
</body>

<?php
    $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
    if ($db->connect_error)
    {
        echo "<script>console.log('Database connection failed')</script>";
        die ("Connection failed: " . $db->connect_error);
    }
    echo "<script>console.log(\"inside php\")</script>";
    $checkbox1 = $_POST['chkl'];
    if (isset($_POST['Submit']))  
    {  
        echo "<script>console.log(\"inside post\")</script>";
        // $uid = $_SESSION['uid']; TODO: Change to live uid
        $uid = 1;
        $date = date('Y-m-d');
        echo "<script>console.log(\"saved q1\")</script>";
        for ($i=0; $i < sizeof ($checkbox1); $i++) {  
            $query="INSERT INTO Symptoms (uid, symptom, dateOfSurvey) VALUES ('".$uid."', '".$checkbox1[$i]."', '".$date."');";  
            $r2 = $db->query($query);
            echo "<script>console.log(\"saved query\")</script>";
        }  
        echo "<script>console.log(\"inserted\")</script>";
    }
   
        // $uid = $_SESSION['uid']; TODO: Change to live uid
        $uid = 1; 
        $bid = 1; //TODO: get actual bid for my user from userRegister
        $sql="SELECT department FROM Departments WHERE (bid = '".$bid."');";
        $result = $db->query($sql);
        $htmlResult = "";
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $htmlResult = "<script>
                var txt = document.createElement('div');
                txt.innerHTML = '<input type=\"checkbox\" name=\"chk2[ ]\" value=\"".$row["department"]."\">".$row["department"]."<br />';
                document.getElementById(\"locations2\").appendChild(txt);
                </script>";
                echo $htmlResult;
            }
        }
        else{
            echo("0 results"); //TODO: fix print statement when no results
        }

        $checkbox2 = $_POST['chk2'];
        if (isset($_POST['Submit2']))  
        {  
            echo "<script>console.log(\"inside post\")</script>";
            // $uid = $_SESSION['uid']; TODO: Change to live uid
            $uid = 1;
            $date = date('Y-m-d');
            $bid = 1; //TODO: get actual bid for my user from userRegister
            echo "<script>console.log(\"saved q1\")</script>";
            for ($i=0; $i < sizeof ($checkbox2); $i++) {  
                $query="INSERT INTO logLocation (uid, bid, department, dateOfLog) VALUES ('".$uid."', '".$bid."', '".$checkbox2[$i]."', '".$date."');";  
                $r2 = $db->query($query);
                echo "<script>console.log(\"saved query\")</script>";
            }  
            echo "<script>console.log(\"inserted\")</script>";
        }

        $date = date('Y-m-d');
        $q3 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."');";
        $r3 = $db->query($q3);
        $count=0;
        $symptomArray = array();
        while($row2 = $r3->fetch_assoc()){
            $symptomArray[] = $row['symptom'];
            $count++;
        }
        echo "<script>console.log(\"'".$count."'\")</script>";
        if ($count <= "2") {
            echo "<script>console.log(\"alert 0\")</script>";
            $q4="INSERT INTO Alert (uid, alertLevel, dateOfAlert) VALUES ('".$uid."', '0', '".$date."');";  
            $r4 = $db->query($q4);
        }
        else if($count >= "3" && $count <="4" ){
            echo "<script>console.log(\"alert 1\")</script>";
            $q5="INSERT INTO Alert (uid, alertLevel, dateOfAlert) VALUES ('".$uid."', '1', '".$date."');"; 
            $r5 = $db->query($q4);
        }
        else if($count >= "5"){
            echo "<script>console.log(\"alert 2\")</script>";
            $q6="INSERT INTO Alert (uid, alertLevel, dateOfAlert) VALUES ('".$uid."', '2', '".$date."');";  
            $r6 = $db->query($q4);
        }
?>

