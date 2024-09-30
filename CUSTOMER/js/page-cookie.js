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
        // Fetch the JSON data from the PHP script
        // console.log("test");
        fetch('js/getData.php')
            .then(response => response.json()) // Parse the JSON from the response
            .then(data => {
                //console.log(data); // Log the data for debugging

                // edit profile info
                document.getElementById('custTitle').innerHTML=data.name;
                document.getElementById('custNAME').innerHTML=data.name;
                document.getElementById('custEMAIL').innerHTML=data.email;
                document.getElementById('custPHONE').innerHTML=data.phone;
                document.getElementById('custNAME').value=data.name;
                // document.getElementById('custEMAIL').innerHTML=data.email;
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
    }
    //else window.location.href="index.html";
}

function setupEditProfile(){
    let user = getCookie("user");
    if (user!="") {//if cookie exist
        // Fetch the JSON data from the PHP script
        // console.log("test");
        fetch('js/getData.php')
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
    }
    //else window.location.href="index.html";
}