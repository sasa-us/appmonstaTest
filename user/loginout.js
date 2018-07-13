$(document).ready(init);
function init() {
    $("#loginbutton").on('click', loginUser);
    $("#logoutbutton").on('click', logoutUser);
    showWelcome();
    $('#registrationbutton').on('click', registerUser);
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
        $('#logoutSection').show();
        $('#registrationbutton').hide();
        $('#loginUserName').text(userInfo.username);
    }else {
        $('#logoutSection').hide();
        $('#loginSection').show();
        $('#registrationbutton').hide();
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
    $('#registrationbutton').show();
    // $('<a>', )
    // <a href='registration.php'>Registration</a>
    //<div id="logoutSection">
   
    // <button id="registrationbutton">register</button>

    
}

function registerUser() {
    alert('hi');
    //go to registrationform.php
}