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
    else document.getElementById("profile-btn").href="profilelogin.html";   
}