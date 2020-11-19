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
                <li><button type="submit" name="button1" id="active">Nov 16, 2020</button></li>
            </form>
            <li><a name="button2" href="#date1">Nov 15, 2020</a></li>
            <li><a name="button3" href="#date2">Nov 14, 2020</a></li>
            <li><a name="button4" href="#date3">Nov 13, 2020</a></li> 
            <!-- innerHTML could be used to dynamically add dates, maybe only going back past week -->
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
    echo "<script>console.log(\"inside php\")</script>";
    if(isset($_POST['button1'])) { 
        echo "<script>console.log(\"inside post\")</script>";
        button1(); 
    } 
    else if(array_key_exists('button2', $_POST)) { 
        button2(); 
    } 
    else if(array_key_exists('button3', $_POST)) { 
        button3(); 
    } 
    else if(array_key_exists('button4', $_POST)) { 
        button4(); 
    } 
    function button1() { 
        echo "<script>console.log(\"inside button1\")</script>";
        echo "<script>var txt = document.createElement('div');
        txt.innerHTML = \"<h3>Symptoms Log</h3><p>log of users symptoms for questionaire dated 00/00/00 to be pulled from database</p>\";
        document.getElementById(\"text\").appendChild(txt);
        var txt2 = document.createElement('div');
        txt2.innerHTML = \"<h3>Locations Log</h3><p>log of users symptoms for questionaire dated 00/00/00 to be pulled from database</p>\";
        document.getElementById(\"text2\").appendChild(txt2);
        document.getElementById(\"active\").style.background='black';
        </script>"; 
        $db = new mysqli("localhost", "veninatb", "Quincy7", "veninatb");
        if ($db->connect_error)
        {
            echo "<script>console.log('Database connection failed')</script>";
            die ("Connection failed: " . $db->connect_error);
        }
        if (isset($_POST['button1'])){  
            echo "<script>console.log(\"inside submit\")</script>";
            //everything working except this query, not 100% sure on how to join the two tables
            $query="SELECT * FROM Symptoms INNER JOIN Questionnaire ON Symptoms.qid=Questionnaire.qid WHERE Questionnaire.dateOfQuestionnaire = '2020-11-18'";
            $result = $conn->query($query);
            echo $result;
            $conn->close();
        }
    } 
    // REPEAT ABOVE with edits for dates:
    // function button2() { 
    //     echo "<script>console.log(\"saved q1\")</script>"; 
    // } 
    // function button3() { 
    //     echo "<script>console.log(\"saved q1\")</script>"; 
    // } 
    // function button4() { 
    //     echo "<script>console.log(\"saved q1\")</script>"; 
    // } 
?> 