function changeWidth() {
    document.getElementById('box').style.width = "340px"
}

function changeWidthBack() {
    document.getElementById('box').style.width = "290px"
}

function departments(val) {
    if (val == true){
        var signup = document.getElementById('box');
        signup.style.display = 'none';
        var departments = document.getElementById('departments');
        departments.style.display = 'block';
    }
  }


function createNewElement() {
	var txtNewInputBox = document.createElement('div');
	txtNewInputBox.innerHTML = "<input type='text' id='newInputBox'>";
	document.getElementById("newDepartment").appendChild(txtNewInputBox);
}