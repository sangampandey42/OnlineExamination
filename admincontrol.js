var studentbtn=document.querySelector("#studentbtn");
var teacherbtn=document.querySelector("#teacherbtn");
var adminbtn=document.querySelector("#adminbtn");
var studentform=document.querySelector("#studentform");
var teacherform=document.querySelector("#teacherform");
var adminform=document.querySelector("#adminform");
var titleshowcase=document.querySelector("#titleshowcase");
var logoutbtn=document.querySelector('#logoutbtn');
logoutbtn.addEventListener("click",function(){
    logout();
})

studentbtn.addEventListener('click',function(){
    studentform.classList.remove("notshown");
    titleshowcase.classList.add("notshown");
    teacherform.classList.add("notshown");
    adminform.classList.add("notshown");
})
teacherbtn.addEventListener('click',function(){
    teacherform.classList.remove("notshown");
    titleshowcase.classList.add("notshown");
    studentform.classList.add("notshown");
    adminform.classList.add("notshown");
})
adminbtn.addEventListener('click',function(){
    adminform.classList.remove("notshown");
    titleshowcase.classList.add("notshown");
    studentform.classList.add("notshown");
    teacherform.classList.add("notshown");
})


//procedure to add user
$(document).ready(function() {
;
    $('#addstudentform').submit(function(e) {
    
        e.preventDefault();
        // get all the inputs into an array.
        var $inputs = $('#addstudentform :input');
        // get an associative array of just the values.
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });

        signupcontrol(values['name'],values['email'],values['pass'],"studentform");

     });
     $('#addteacherform').submit(function(e) {
        e.preventDefault();
        // get all the inputs into an array.
        var $inputs = $('#addteacherform :input');
        // get an associative array of just the values.
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });

        signupcontrol(values['name'],values['email'],values['pass'],"teacherform");

     });
     $('#addadminform').submit(function(e) {
        e.preventDefault();
        // get all the inputs into an array.
        var $inputs = $('#addadminform :input');
        // get an associative array of just the values.
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });

        signupcontrol(values['name'],values['email'],values['pass'],"adminform");

     });
     $('#searchform').submit(function(e) {
        e.preventDefault();
        // get all the inputs into an array.
        var $inputs = $('#searchform :input');
        // get an associative array of just the values.
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });

        searchuser(values['name'],values['usertype'])

     });
    //  $("#delete").on("submit",function(){

    //     alert("pressed");
    //     //  if(==true){
    //     //     var uid=$(this).val();
    //     //     deleteUser(uid,type);
    //     //  } 
    //  })
    
});

function signupcontrol(name,mail,password,whichform){
    name = name.replace(/^\s+|\s+$|\s+(?=\s)/g, "");
    $.ajax({
        type: "POST",
        url: 'admin_handle.php',
        data: {
            username:name,
            typeofform:whichform,
            email:mail,
            pass:password
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);

            // user is logged in successfully in the back-end
            // let's redirect
            if (jsonData.success == "1")
            {
                alert(`${name} Successfully Added.`);
            }
            else
            {
                alert(jsonData.message);
            }
         }
    })
             
}
function searchuser(name,type){
    
    // var firstName = fullName.split(' ').slice(0, -1).join(' ');
    // var lastName = fullName.split(' ').slice(-1).join(' ');
    $.ajax({
        type: "POST",
        url: 'admin_handle.php',
        data: {
            name:name,
            usertype:type
        },
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            var message=jsonData.shift();
            if (message.success == "1")
            {
                var table =$("#table");
                table.html("");
                var count=0;
                while(count<jsonData.length) {
                    var element=jsonData[count];
                    table.append(`<tr id='${element.id}' ><th scope='row'>${element.id}</th><td>${element.name}</td><td>${element.email}</td><td> <button type='button' id='delete' class='btn btn-outline-danger' onClick='deleteuserpre(${element.id},${message.tableid})'><i class='far fa-trash-alt'></i></button></td></tr>`);
                    count++;
                };
        
            }
            else
            {
                alert(message.message)
            }
         }
    })
}
//deleting a user
function deleteuserpre(uid,tableid){
    if(confirm("Are you sure you want to delete?")){
        var row=$('#'+uid);
        row.fadeOut(1500,function(){
        })
        deleteuser(uid,tableid);
        $(this).remove();

    }
}
function deleteuser(uid,tableid){
    
        $.ajax({
            type: "POST",
            url: 'admin_handle.php',
            data: {
                deleteid:uid,
                tablename:tableid
            },
            success: function(response)
            {
                var jsonData = JSON.parse(response);
                var message=jsonData.shift();
                if (message.success == "1")
                {
                
                   alert(message.message);
                }
                else
                {
                    alert(message.message);
                }
             }
        })
}
 
//logging out
function logout(){
       if(confirm("Are you sure?")){
            $.ajax({
                type: "POST",
                url: 'logout.php',
                data:{
                },
                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1")
                    {
                        location.href=jsonData.link;
                        
                    }
                    else
                    {
                        alert("Failed to log out");
                    }
                }
            })
        }
}