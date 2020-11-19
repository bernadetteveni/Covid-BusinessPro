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
        <div id="locations" class="locations">
            <h2>Log Locations</h2>
            <hr />
            <p>Locations data to be pulled from database
            </p>
            <button id="finishedLocations">Done</button>
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
    echo "<script>console.log(\"inside php\")</script>";
    $checkbox1 = $_POST['chkl'];
    if (isset($_POST['Submit']))  
    {  
        echo "<script>console.log(\"inside post\")</script>";
        $uid = $_SESSION['uid'];
        $date = date('Y-m-d');
        $q1 = "INSERT INTO Questionnaire (dateOfQuestionnaire) VALUES ('". $date ."')";
        $r1 = $db->query($q1);
        echo "<script>console.log(\"saved q1\")</script>";
        for ($i=0; $i < sizeof ($checkbox1); $i++) {  
            $query="INSERT INTO Symptoms (symptom) VALUES ('".$checkbox1[$i]."')";  
            $r2 = $db->query($query);
            echo "<script>console.log(\"saved query\")</script>";
        }  
        echo "<script>console.log(\"inserted\")</script>";
    }
?>

