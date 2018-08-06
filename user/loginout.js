$(document).ready(init);
function init() {
    $("#loginbutton").on('click', loginUser);
    $("#logoutbutton").on('click', logoutUser);
    showWelcome();
    showfbookWelcome(userInfo);
    $('#formButton').on('click', fillForm);
    // $('#savebutton').on('click', saveMySelection);
}

function loginUser() {
    //alert('hi');
    var email = $('#email').val();
    var password = $('#password').val();

    $.ajax({
        url: 'user/login.php',
        method: 'post',
        dataType: 'json',
        data: {
            email, password
        },
        success: function(response) {
            console.log("login response is ",response);
//response.user

console.log(response.user);
            if(response.success) {
                showWelcome(response.user);
                $('#savebutton').on('click', function() {
                    saveMySelection(response.user.id);
                });
            } else {
                showRegiterInfo(response.error);
            }
        },
        error: function(response) {
            console.log(JSON.stringify(response));
           
        }
    });
}//end loginUser()

function showWelcome(userInfo) {
    console.log('show welcome userinfo is  ', userInfo);
    if(userInfo) {
        $('#loginSection').hide();
        $('#dbInfoButton').show();

        $("#savebutton").show();
        $('#logoutSection').show();
        $('#formButton').hide();
        $('#loginUserName').text(userInfo.username);
    }else {
        $('#logoutSection').hide();
        $('#dbInfoButton').hide();
        $("#savebutton").hide();

        $('#loginSection').show();
        $('#formButton').hide();
        $('#loginUserName').empty();
        
    }
}//end showWelcome

function logoutUser() {
    alert('bye');
    $.ajax({
        url: 'user/logout.php',
        method: 'get',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if(response.success) {
                showWelcome(response.user);
            }
        }
        
    });
}// end logoutUser()

function showRegiterInfo(registerErrorInfo){
    //alert(registerErrorInfo);
    $('.notifyRegister').text(registerErrorInfo);
    $('#formButton').show();
    // $('<a>', )
    // <a href='registration.php'>Registration</a>
    //<div id="logoutSection">
   
    // <button id="registrationbutton">register</button>

    
}

function fillForm() {
    alert('hi');
  
    $("#form1").toggle();

    $("#submit").on('click', function() {
        alert('register');
        var url = 'user/reginstration.php';

        var username = $('#formusername').val();
        var email = $('#formemail').val();
        var password = $('#formpassword').val();
        userdata = {
            username: username,
            email: email,
            password: password
        }
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: userdata,
        success: function(response) {
            console.log('registration page', response);
         
        },
        error: function () {
            console.log('server not response');    
        }
    });
    });
    
}//fillForm()

function saveMySelection(userid) {
    alert('hi');
    console.log('saveMySelection userid is ', userid);
    var url = 'user/saveitem.php';

        userdata = {
            game_id: 'com.nine54.ArmyHero',
            user_id: userid,
            genre: 'Casual',
            platform:  'android',
            price_value: 'free'
            
        }          
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: userdata,
        success: function(response) {
            console.log('save item response', response);
         
        },
        error: function () {
            console.log('server not response');    
        }
    });
}

function showfbookWelcome(userInfo) {
    console.log('facebook user welcome userinfo is  ', userInfo);
    //will get {id: "10106353438320505", name: "Daniel Kay S"}
    if(userInfo) {
        $('#loginSection').hide();
        $('#dbInfoButton').show();

        $("#savebutton").show();
        $('#logoutSection').show();
        $('#formButton').hide();
        $('#loginUserName').text(userInfo.name);
    }else {
        $('#logoutSection').hide();
        $('#dbInfoButton').hide();
        $("#savebutton").hide();

        $('#loginSection').show();
        $('#formButton').hide();
        $('#loginUserName').empty();
        
    }
}//end showWelcome