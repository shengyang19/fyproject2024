function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
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
        <a id="profile-menu-2" href="" class="dropdown-item" type="button" onclick="deleteCookie('user')">Logout</a>`);
        // const menu1 = document.getElementById("profile-menu-1");
        // menu1.innerHTML="Profile";
        // menu1.setAttribute('href', 'profile.html');
        // let newChild=menu1.cloneNode();
        // document.getElementById("profile-menu").appendChild(newChild);
        //const node=document.createTextNode("Logout");
        //newChild.appendChild(node);
        // newChild.innerHTML="Logout";
        // newChild.setAttribute('href', '');
        // newChild.setAttribute('id', 'profile-menu-2');
        // newChild.setAttribute('onclick','deleteCookie(\'user\')');
        setupProfile();setupEditProfile();
    }
}

function setupProfile(){
    // let user = getCookie("user");
    // if (user!="") {//if cookie exist
        // Fetch the JSON data from the PHP script
        fetch('js/data.json')
            .then(response => response.json()) // Parse the JSON from the response
            .then(data => {
                //console.log(data); // Log the data for debugging

                // edit profile info
                document.getElementById('custTitle').innerHTML=data.name;
                document.getElementById('custNAME').innerHTML=data.name;
                document.getElementById('custEMAIL').innerHTML=data.email;
                document.getElementById('custPHONE').innerHTML=data.phone;
                document.getElementById('custMEMBER').innerHTML=data.membership;
                document.getElementById('custNAME').value=data.name;
                // document.getElementById('custEMAIL').innerHTML=data.email;
                document.getElementById('custPHONE').value=data.phone;
                document.getElementById('birthday').value=data.birthday;
                document.getElementById('birthday').innerHTML=data.birthday;
                // document.getElementById('output').innerHTML = `
                //     <p>Name: ${data.name}</p>
                //     <p>Role: ${data.role}</p>
                //     <p>Security Level: ${data.securityLevel}</p>
                // `;
            })
            .catch(error => {
                console.error('Error fetching JSON data:', error);
            });
    // }
    //else window.location.href="index.html";
}

function setupEditProfile(){
    // let user = getCookie("user");
    // if (user!="") {//if cookie exist
        // Fetch the JSON data from the PHP script
        // console.log("test");
        fetch('js/data.json')
            .then(response => response.json()) // Parse the JSON from the response
            .then(data => {
                //console.log(data); // Log the data for debugging

                // edit profile info
                document.getElementById('custTitle').value=data.name;
                document.getElementById('custNAME').value=data.name;
                document.getElementById('custEMAIL').innerHTML=data.email;
                document.getElementById('custPHONE').value=data.phone;
                // document.getElementById('output').innerHTML = `
                //     <p>Name: ${data.name}</p>
                //     <p>Role: ${data.role}</p>
                //     <p>Security Level: ${data.securityLevel}</p>
                // `;
            })
            .catch(error => {
                console.error('Error fetching JSON data:', error);
            });
    // }
    //else window.location.href="index.html";
}


$('.book_now').click(function(){
    let booking = $(this).data('id');
    console.log(booking);
    if(booking==undefined) deleteCookie("booking");
    else setCookie("booking",booking,0.5);
    return false;
})

setupPage("user");