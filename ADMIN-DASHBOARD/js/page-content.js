function setupCustomer(){
    setupPage();
    fetch('customers.json')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();  // Parsing the JSON data
    })
    .then(data => {
        // Get a reference to the table body where you want to insert rows
        const tableBody = document.getElementById('cards'); // Make sure this ID matches your HTML

        // Clear any existing rows
        tableBody.innerHTML = "";

        // Loop through the fetched data and create a table row for each entry
        data.forEach(item => {
            const custemail = item.email.toLowerCase();
            const custname = item.name.toUpperCase();

            const div1 = document.createElement('div');
            div1.setAttribute("class","col-xl-3 col-md-6 mb-4");

            const div2 = document.createElement('div');
            div2.setAttribute("class","card border-left-primary shadow py-2");
            div1.appendChild(div2);

            const div3 = document.createElement('div');
            div3.setAttribute("class","card-body");
            div2.appendChild(div3);

            const div4 = document.createElement('div');
            div4.setAttribute("class","row no-gutters align-items-center");
            div3.appendChild(div4);

            const div5 = document.createElement('div');
            div5.setAttribute("class","col mr-2");
            div4.appendChild(div5);

            const div9 = document.createElement('div');
            div9.setAttribute("class","text-xs font-weight-bold text-primary text-uppercase mb-1");
            div9.textContent = custemail;
            div5.appendChild(div9);

            const div6 = document.createElement('div');
            div6.setAttribute("class","h5 mb-0 font-weight-bold text-gray-800");
            div6.textContent = custname;
            div5.appendChild(div6);

            const div7 = document.createElement('div');
            div7.setAttribute("class","col-auto");
            div4.appendChild(div7);

            const div8 = document.createElement('a');
            div8.setAttribute("class","d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm");
            div8.textContent = "Edit";
            div7.appendChild(div8);

            // Append the new row to the table body
            tableBody.appendChild(div1);

        });
    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });
}

function setupStaff(){
    setupPage();
    fetch('staffs.json')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();  // Parsing the JSON data
    })
    .then(data => {
        // Get a reference to the table body where you want to insert rows
        const tableBody = document.getElementById('cards'); // Make sure this ID matches your HTML

        // Clear any existing rows
        tableBody.innerHTML = "";

        // Loop through the fetched data and create a table row for each entry
        data.forEach(item => {
            const staffname = item.name.toUpperCase();
            const role = item.role.toLowerCase();
            staffrole=role[0].toUpperCase()+role.slice(1);

            const div1 = document.createElement('div');
            div1.setAttribute("class","col-xl-3 col-md-6 mb-4");

            const div2 = document.createElement('div');
            div2.setAttribute("class","card border-left-primary shadow py-2");
            div1.appendChild(div2);

            const div3 = document.createElement('div');
            div3.setAttribute("class","card-body");
            div2.appendChild(div3);

            const div4 = document.createElement('div');
            div4.setAttribute("class","row no-gutters align-items-center");
            div3.appendChild(div4);

            const div5 = document.createElement('div');
            div5.setAttribute("class","col mr-2");
            div4.appendChild(div5);

            const div9 = document.createElement('div');
            div9.setAttribute("class","text-xs font-weight-bold text-primary text-uppercase mb-1");
            div9.textContent = staffrole;
            div5.appendChild(div9);

            const div6 = document.createElement('div');
            div6.setAttribute("class","h5 mb-0 font-weight-bold text-gray-800");
            div6.textContent = staffname;
            div5.appendChild(div6);

            const div7 = document.createElement('div');
            div7.setAttribute("class","col-auto");
            div4.appendChild(div7);

            const div8 = document.createElement('a');
            div8.setAttribute("class","d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm");
            div8.textContent = "Edit";
            div7.appendChild(div8);

            // Append the new row to the table body
            tableBody.appendChild(div1);

        });
    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });
}

function setupPage(){
    fetch('data.json')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();  // Parsing the JSON data
    })
    .then(data => {
        //Edit page content
        document.getElementById('username').innerHTML=data.username;
        document.getElementById('staffcontrol').removeAttribute("hidden");
        
    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });

}


function setupProfile(){
    fetch('data.json')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();  // Parsing the JSON data
    })
    .then(data => {
        //Edit page content
        document.getElementById('username').innerHTML=data.username;
        const nametag = document.getElementsByClassName('username');
        document.getElementById('staff_id').innerHTML=data.staff_id;
        document.getElementById('email').innerHTML=data.email;
        document.getElementById('staffcontrol').removeAttribute("hidden");

    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });
}

function loadFeedback(){
    setupPage();
    // Fetch the JSON data from the PHP script
    // console.log("test");
    fetch('feedback.json')
    .then(response => {
        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();  // Parsing the JSON data
    })
    .then(data => {
        // Get a reference to the table body where you want to insert rows
        const tableBody = document.getElementById('feedbackTableBody'); // Make sure this ID matches your HTML

        // Clear any existing rows
        tableBody.innerHTML = "";

        // Loop through the fetched data and create a table row for each entry
        data.forEach(item => {
            const row = document.createElement('tr');

            // Create cells for each piece of data
            const subjectCell = document.createElement('td');
            subjectCell.textContent = item.subject;
            row.appendChild(subjectCell);

            const messageCell = document.createElement('td');
            messageCell.textContent = item.message;
            row.appendChild(messageCell);

            const nameCell = document.createElement('td');
            nameCell.textContent = item.name;
            row.appendChild(nameCell);

            const dateCell = document.createElement('td');
            dateCell.textContent = item.date;
            row.appendChild(dateCell);

            const emailCell = document.createElement('td');
            emailCell.textContent = item.email;
            row.appendChild(emailCell);

            // Append the new row to the table body
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });

    //else window.location.href="index.html";
}

// function getCookie(cname) {
//     let name = cname + "=";
//     let decodedCookie = decodeURIComponent(document.cookie);
//     let ca = decodedCookie.split(';');
//     for(let i = 0; i <ca.length; i++) {
//       let c = ca[i];
//       while (c.charAt(0) == ' ') {
//         c = c.substring(1);
//       }
//       if (c.indexOf(name) == 0) {
//         return c.substring(name.length, c.length);
//       }
//     }
//     return "";
//   }