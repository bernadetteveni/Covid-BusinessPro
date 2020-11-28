<?php 
    require_once('./connection.php');
    $email= $_GET['email'];
    $shortemail= substr($email, strrpos($email, '@' )+1);
    $auth= $_GET['auth'];
    $sql = "SELECT Departments.department FROM userRegister , Departments, Corporate WHERE (userRegister.email LIKE '%$shortemail' AND Departments.bid=Corporate.bid AND  userRegister.uid = Departments.uid AND userRegister.accountType = '1' AND Corporate.accountAuthorization ='$auth')";
    $result= mysqli_query($conn, $sql); //execute query with bind parameter
    $department= "";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $department .="<option value='".$row['department']."'>".$row['department']."</option>";
        }
    }
    echo $department;
mysqli_close($conn);
?>
