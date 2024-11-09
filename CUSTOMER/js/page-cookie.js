function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}
function deleteCookie(cname) {
    const d = new Date();
    d.setTime(d.getTime() - 1);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=;" + expires + ";path=/";
}
function checkCookie(cname) {
    let user = getCookie("user");
    if (user != "") {//if cookie exist
        //document.getElementById("profile-btn").hidden=false;
        document.getElementById("profile-btn").href="profile.html"; 
        //document.getElementById("acc_name").innerHTML=user;
    }
    else document.getElementById("profile-btn").href="cust-login.php";   
}

function setupPage(cname){
    let user = getCookie(cname);
    if (user!="") {//if cookie exist
        //edit profile menu
        $('#profile-menu').html(`
        <a id="profile-menu-1" href="profile.html" class="dropdown-item" type="button">Profile</a>
        <a id="profile-menu-3" href="booking-history.html" class="dropdown-item" type="button">Booking</a>
        <a onclick="logout()" id="profile-menu-2" href="index.html" class="dropdown-item" type="button">Logout</a>`);
    }
}

function setupProfile(){
    $('.username').html(decodeURIComponent(getCookie('user'))).val(decodeURIComponent(getCookie('user')));
    $('#custEMAIL').html(decodeURIComponent(getCookie('email')));
    $('#custPHONE').html(getCookie('phone')).val(getCookie('phone'));
    $('#birthday').html(getCookie('birthday')).val(getCookie('birthday'));
    $('#custMEMBER').html(decodeURIComponent(getCookie('membership')));
}

function logout(){
    deleteCookie('user_id');
    deleteCookie('user');
    deleteCookie('phone');
    deleteCookie('membership');
    deleteCookie('birthday');
    deleteCookie('email');
}

function setupEditProfile(){
}


setupPage("user");