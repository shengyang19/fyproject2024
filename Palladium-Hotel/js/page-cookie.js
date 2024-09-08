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

function setupPage(cname){
    let user = getCookie(cname);
    if (user!="") {//if cookie exist
        //edit profile menu
        const menu1 = document.getElementById("profile-menu-1");
        menu1.innerHTML="View profile";
        menu1.setAttribute('href', 'profile.html');
        let newChild=menu1.cloneNode();
        document.getElementById("profile-menu").appendChild(newChild);
        //const node=document.createTextNode("Logout");
        //newChild.appendChild(node);
        newChild.innerHTML="Logout";
        newChild.setAttribute('href', '');
        newChild.setAttribute('id', 'profile-menu-2');
        newChild.setAttribute('onclick','deleteCookie(\'user\')');

    }
}

function setupProfile(){
    let user = getCookie("user");
    if (user!="") {//if cookie exist
        //edit profile info
        let mail = getCookie('email');
        document.getElementById('username').innerHTML="<span>Name </span>: "+user;
        document.getElementById('titlename').innerHTML=user;
        document.getElementById('email').innerHTML ="<span>Email </span>:  <i class=\"fa fa-envelope\"></i> "+mail;
        document.getElementById('titleemail').innerHTML =mail;
        document.getElementById('phone').innerHTML ="<span>Mobile </span>: "+getCookie('phone');
    }
    //else window.location.href="index.html";
}