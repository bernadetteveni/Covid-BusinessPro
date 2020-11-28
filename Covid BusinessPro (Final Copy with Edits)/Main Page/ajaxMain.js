setInterval(check,30);//run the loop every 30milliseconds
var bid=document.getElementsByClassName("find_id")[0].id;
//check();
var check_sum=0;
var hide_world=0;
function check(){
    var  xmlhttp = new XMLHttpRequest();
    // access the onreadystatechange event for the XMLHttpRequest object
        xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
            var results = JSON.parse(this.responseText);
            var check_alert_update=0;
             for(var x=0;x<results.length;x++){
                check_alert_update=check_alert_update+results[x].aid;
                 }
             if(results.length==0&&hide_world==0)
             {
                     var new_content="No new alerts";
                     $("#name").html(new_content);
                    var new_number=results.length;
                     $("#newAlerts").html(new_number);
                     hide_world++;
                     shows();
             }  
             else if(check_alert_update!=check_sum)
             {  hide_world=0;
                var most_recent=aid(results);
                console.log(most_recent);
                delete_noti();
                create_noti(most_recent,results);
                delete_alert();
                create_alert(results);
                shows();
                check_sum=check_alert_update;
             }
         }
        }
        
     xmlhttp.open("GET", "ajaxMain.php?bid="+ bid, true);
     xmlhttp.send();
}

function delete_noti(){
    var new_append=$("");
    $("#name").html(new_append);
    var new_number=("");
    $("#newAlerts").html(new_number);
}

function create_noti(most_recent,results){
    var new_append=$("<div id=\"notificationName\">"+most_recent["username"]+" has been added to alerts with level: "+most_recent["level"]+"</div>");
    $("#name").append(new_append);
    var new_number=results.length;
    $("#newAlerts").html(new_number);

}

function aid(what){
    var max_aid=0;
    var find_most_recent;
    for(var x=0;x<what.length;x++)
    {
        if(max_aid<parseInt(what[x].aid))
        {
            max_aid=parseInt(what[x].aid);
            find_most_recent={aid:what[x].aid,username:what[x].username,level:what[x].alert};

        }
    }

    return find_most_recent;
}


function delete_alert(){

    var new_append=$("");
    $("#add_alert_list").html(new_append);

}
function create_alert(results){

    for(var x=0;x<results.length;x++)
    {
        if(results[x]['alert']==2)
        {
            var new_append=$("<li id='"+results[x]["aid"]+"'><a href='userProfile.php?uid="+results[x]["uid"]+"'><input type='checkbox' name='submitted' value='"+results[x]["uid"]+"'class='checkbox' id='"+results[x]["uid"]+"'>"+ results[x]["username"] +", "+  results[x]["department"]+"</a></li>");
            $("#add_alert_list").append(new_append);
        }
    }

    for(var x=0;x<results.length;x++)
    {
        if(results[x]['alert']==1)
        {
            var new_append=$("<li id='"+results[x]["aid"]+"'><a href='userProfile.php?uid="+results[x]["uid"]+"' style='background-color: rgb(246, 237, 152);'  onmouseover=\"this.style.background=\'rgb(255, 245, 109)\'\" onmouseout=\"this.style.background=\'rgb(246, 237, 152)\'\"><input type='checkbox' name='submitted' value='"+results[x]["uid"]+"'class='checkbox' id='"+results[x]["uid"]+"'>"+ results[x]["username"] +", "+  results[x]["department"]+"</a></li>");
            $("#add_alert_list").append(new_append);
        }
    }


}

function shows(){

    $("#name").show();
    setTimeout(function() { $("#name").hide(); }, 5000);
}


