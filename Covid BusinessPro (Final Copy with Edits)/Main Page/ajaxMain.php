<?php
    $bid =$_GET['bid'];
    $db = new mysqli("localhost", "ense374", "Ense374team#", "CovidApp");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }


    if($bid>0)
    {   
        $response=array ();
        $index=0;
            $q2="SELECT Departments.department,Alert.uid From Departments,Alert WHERE Departments.uid=Alert.uid and Departments.bid=$bid and Alert.alertLevel>0 ORDER BY uid DESC;";
            $r2=$db->query($q2);
            $uid=" ";
            while($find_department=$r2->fetch_assoc())//find employee who have alertLevel either 1or 2;
            {       
                    $q3="SELECT userRegister.username,Alert.dateOfAlert,Alert.alertLevel,Alert.uid,Alert.aid From userRegister,Alert WHERE userRegister.uid=Alert.uid and userRegister.uid=$find_department[uid] and Alert.alertLevel>0 ORDER BY aid DESC;";
                    $r3=$db->query($q3);
                    $find_username=$r3->fetch_assoc();
                    if($uid!=$find_username[uid]){//find username for alerting employee
                        $response[$index]['aid']=$find_username[aid];
                        $response[$index]['uid']=$find_department[uid];   
                        $response[$index]['alert']=$find_username["alertLevel"];
                        $response[$index]['username']=$find_username["username"];
                        $response[$index]['department']=$find_department["department"];
                        $response[$index]['date']=$find_username["dateOfAlert"];
                        $index++;
                        $uid=$find_username[uid];}
            }
        }


$JSON_response=json_encode($response);
echo $JSON_response;

    $db->close();
?>
