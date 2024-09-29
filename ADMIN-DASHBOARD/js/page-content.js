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