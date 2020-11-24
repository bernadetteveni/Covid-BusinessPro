function changeWidth() {
    document.getElementById('box').style.width = "340px"
}

function changeWidthBack() {
    document.getElementById('box').style.width = "290px"
}

function departments(val) {
    if (val == true){
        var signup = document.getElementById('box');
        //signup.style.display = 'none';
        var departments = document.getElementById('departments');
        departments.style.display = 'block';
    }
  }
  
function createNewElement() {
    var txtNewInputBox = document.createElement('input');
    txtNewInputBox.setAttribute("type","text");
    txtNewInputBox.setAttribute("name","dep1[]");
    txtNewInputBox.setAttribute("placeholder","Add Departments");
    txtNewInputBox.classList.add("class","signup_input");
    txtNewInputBox.classList.add("class","form-control");
	document.getElementById("newDepartment").appendChild(txtNewInputBox);
}

function createInput(){
    var authInput= document.createElement("input");
    document.getElementById("birthDate").insertAdjacentElement("afterend",authInput);
    document.getElementById("employee_auth").appendChild(authInput);
    authInput.setAttribute("type","number");
    authInput.setAttribute("placeholder","Authenticate");
    authInput.setAttribute("name","empAuth");
    authInput.classList.add("signup_input");
    authInput.classList.add("form-control");
}

function checkEmpType(){
    var check=document.getElementById("inputGroupSelect01").value;
    if(check == 'none'){
        var errorMessage = document.createElement('div');
        errorMessage.innerHTML = "Employee type can't be none.";
        document.getElementById("error").appendChild(errorMessage);
    }
}

function pullDepartment(){
    var xhttp;  
    var department;
    var email = document.getElementById("email").value;
    var auth = document.getElementsByName("empAuth")[0].value;
    console.log(email);
    console.log(auth);
    if (auth == "") {
      document.getElementsByName("inputDepartment").innerHTML = "";
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {  
        department= this.responseText;
        document.getElementById("inputGroupSelect02").innerHTML= department;
        console.log(department);
      }
    };
    xhttp.open("GET", "ajaxDepartment.php?email="+email+"&auth="+auth, true);
    xhttp.send(null);
}

function HRcheck(e) {
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;
    var errorMessage = document.createElement('div');
    console.log(e.value);
    var check= false;
    if (email == '' || pass == '' || email == null || pass == null) {
            check =true;
            errorMessage.innerHTML = "Please fill in above values and then reselect Employee Type";
            document.getElementById("error").appendChild(errorMessage);
    }
    if(e.value == "1" && check == false){
        console.log("did not pass verification");
        document.getElementById("departments").style.visibility = "visible";
        document.getElementById("Corp").style.required= true;
        document.getElementById("reg").style.display = "none";
        document.getElementById("employee_auth").display = "none";
        document.getElementById("employee_auth").required = false;
        document.getElementById("Corp").required = true;
        document.getElementById("HrAuth").required= true;
        var x = true;
        departments(x);
        //errorMessage.innerHTML = "Please fill in all options and reselect employee type";
    }
}

function empCheck(e){
    var errorMessage = document.createElement('div');
    if(e.value=='0'){
        errorMessage.innerHTML = "Please fill in all options and click submit";
        document.getElementById("employee_auth").style.visibility = "visible";
        document.getElementsByName("inputDepartment").required= true;
        if(document.getElementsByName("empAuth").length == 0){
        createInput();
        }
    }
}