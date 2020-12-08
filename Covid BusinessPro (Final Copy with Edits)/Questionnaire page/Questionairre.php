<?php
    session_start();
    $uid = $_SESSION['user_id'];
    echo "<script>console.log(\"logged in with uid\", '".$uid."')</script>";
    if(!isset($_SESSION['user_id'])){
        header("Location: http://www2.cs.uregina.ca/~veninatb/Signup.php");
        die();
    }

?>

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
        <a href="http://www2.cs.uregina.ca/~veninatb/Logout.php">Logout</a>
        <a href="http://www2.cs.uregina.ca/~veninatb/userProfile.php">User Profile</a>
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
                <p>Please select the option(s) that apply to you:</p></br>
                <input type="checkbox" name="chkl[ ]" value="No symptoms">No symptoms<br /> 
                <div id="risk"></div> 
                <div id="hide"><input id = "highrisk" type="checkbox" name="chkl[ ]" value="I have been in contact with someone who has COVID‐19">I have been in contact with someone who has COVID‐19<br /></div>
                <input type="checkbox" name="chkl[ ]" value="Fever">Fever<br />  
                <input type="checkbox" name="chkl[ ]" value="Dry cough">Dry cough<br />  
                <input type="checkbox" name="chkl[ ]" value="Tiredness">Tiredness<br />  
                <input type="checkbox" name="chkl[ ]" value="Aches and pains">Aches and pains<br />  
                <input type="checkbox" name="chkl[ ]" value="Sore throat">Sore throat<br /> 
                <input type="checkbox" name="chkl[ ]" value="Diarrhea">Diarrhea<br /> 
                <input type="checkbox" name="chkl[ ]" value="Conjunctivitis">Conjunctivitis<br />
                <input type="checkbox" name="chkl[ ]" value="Headache">Headache<br />
                <input type="checkbox" name="chkl[ ]" value="Loss of taste or smell">Loss of taste or smell<br />
                <input type="checkbox" name="chkl[ ]" value="A rash on skin, or discolouration of fingers or toes">A rash on skin, or discolouration of fingers or toes<br />
                <input type="checkbox" name="chkl[ ]" value="Difficulty breathing or shortness of breath">Difficulty breathing or shortness of breath<br />
                <input type="checkbox" name="chkl[ ]" value="Chest pain or pressure">Chest pain or pressure<br />
                <input type="checkbox" name="chkl[ ]" value="Loss of speech or movement">Loss of speech or movement<br />
                <br>
                <button type="submit" name="Submit" id="finishedSurvey">Done</button>
        </div>
    </form>
    <form method="post"> 
        <div id="locations" class="locations">
            <h2>Log Locations</h2>
            <hr />
            <p>Please select the departments you have entered today:</p></br>
            <div id="locations2">
            </div>
            <button type="submit" name="Submit2" id="finishedLocations">Done</button>
        </div>
    </form>
    <script type="text/javascript" src="QuestionairreEvents.js"></script> 
</body>

<?php
    $db = new mysqli("localhost", "veninatb", "Quincy7", "veninatb");
    if ($db->connect_error)
    {
        echo "<script>console.log('Database connection failed')</script>";
        die ("Connection failed: " . $db->connect_error);
    }

    //SAVE CHECKED SYMPTOMS INTO DATABASE
    $checkbox1 = $_POST['chkl'];
    if (isset($_POST['Submit']))  
    {  
        $uid = $_SESSION['user_id'];
        $date = date('Y-m-d');
        for ($i=0; $i < sizeof ($checkbox1); $i++) {  
            $query="INSERT INTO Symptoms (uid, symptom, dateOfSurvey) VALUES ('".$uid."', '".$checkbox1[$i]."', '".$date."');";  
            $r2 = $db->query($query);
        }  
    }
   
    //GET UID AND BID FROM SESSION
    $uid = $_SESSION['user_id'];
    $q="SELECT bid FROM userRegister WHERE (uid ='$uid')";
    $r = $db->query($q);
    if($r->num_rows>0){
        while($row = $r->fetch_assoc()){
            $bid = $row['bid'];
        }
    }

    //GET DEPARTMENTS FROM DATABASE
    $sql="SELECT DISTINCT department FROM Departments WHERE (bid = '".$bid."');";
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

    //SAVE CHECKED LOCATIONS INTO DATABASE
    $checkbox2 = $_POST['chk2'];
    if (isset($_POST['Submit2']))  
    {  
        $uid = $_SESSION['user_id'];
        $x="SELECT bid FROM userRegister WHERE (uid = '".$uid."');";
        $y = $db->query($x);
        if($y->num_rows>0){
            while($z = $y->fetch_assoc()){
                $bid = $z['bid'];
            }
        }
        $date = date('Y-m-d');
        for ($i=0; $i < sizeof ($checkbox2); $i++) {  
            $query="INSERT INTO logLocation (uid, bid, department, dateOfLog) VALUES ('".$uid."', '".$bid."', '".$checkbox2[$i]."', '".$date."');";  
            $r2 = $db->query($query);
        }  
    }
    
    $date = date('Y-m-d');
    $q3 = "SELECT DISTINCT symptom FROM Symptoms WHERE (dateOfSurvey = '".$date."') AND (uid ='$uid');";
    $r3 = $db->query($q3);
    $count=0;
    $symptomArray = array();
    unset($symptomArray);
    while($row2 = $r3->fetch_assoc()){
        $symptomArray[] = $row2['symptom'];
        $count++;
    }


    if (in_array("I have been in contact with someone who has COVID‐19", $symptomArray)) {
        $inContact = True;
    }

    if ($count <= "2" && !$inContact) {
        $q4="INSERT INTO Alert (uid, bid, alertLevel, dateOfAlert) VALUES ('".$uid."', '".$bid."', '0', '".$date."');";  
        $r4 = $db->query($q4);
    }
    else if($count >= "3" && $count <="4" && !$inContact){
        $q5="INSERT INTO Alert (uid, bid, alertLevel, dateOfAlert) VALUES ('".$uid."', '".$bid."', '1', '".$date."');"; 
        $r5 = $db->query($q5);
    }
    else if($count >= "5" && !$inContact){
        $q6="INSERT INTO Alert (uid, bid, alertLevel, dateOfAlert) VALUES ('".$uid."', '".$bid."', '2', '".$date."');";  
        $r6 = $db->query($q6);
    }
    else if($inContact){
        $q7="INSERT INTO Alert (uid, bid, alertLevel, dateOfAlert) VALUES ('".$uid."', '".$bid."', '2', '".$date."');";  
        $r7 = $db->query($q7);
    }

    unset($symptomArray);

?>
