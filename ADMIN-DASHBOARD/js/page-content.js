//  #reuse method to setup customer & setup staff

function setupList(list){
    setupPage();
    const listname=list+".json";
    fetch(listname)
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
            let top;
            let formaction;
            if(list=="customers"){
                top = item.email.toUpperCase();
                formaction=`<form action="edit-customer.php" method="POST">`
            }
            else if(list=="staffs"){
                top = item.role.toUpperCase();
                formaction=`<form action="edit-staff.php" method="POST">`
            }
            const name = item.name.toUpperCase();
            const id = item.id;

            const div1 = document.createElement('div');
            div1.setAttribute("class","col-xl-3 col-md-6 mb-4");
            div1.innerHTML=`<div class="card border-left-primary shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">`+top+`</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">`+name+`</div>
                                        </div>
                                        `+formaction+`
                                        <div class="col-auto d-inline">
                                            <input type="hidden" name="edit" value=`+id+`>
                                            <input type="submit" class="d-block d-sm-inline-block btn btn-primary shadow-sm" value="Edit">
                                            <button class="d-block d-sm-inline-block btn btn-danger shadow-sm" data-toggle="modal" data-target="#confirmDelete" data-id="`+id+`"><i class="fas fa-trash"></i></button>
                                        </div>
                                        </form>
                                        <div class="col-auto">
                                        </div>
                                    </div>
                                </div>
                            </div>`;

            // Append the new row to the table body
            tableBody.appendChild(div1);

        });
    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });
}

// Set the ID of the name to delete in the modal
$('#confirmDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
    var modal = $(this);
    modal.find('#deleteId').val(id); // Set the value of the hidden input
});

// ##############################################


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
        if(data.role=="admin")
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
        // document.getElementById('username').innerHTML=data.username;
        // document.getElementById('nameLabel').innerHTML=data.username;
        // document.getElementById('nameInput').value=data.username;
        document.getElementById('phone').innerHTML=data.phone;
        document.getElementById('phone').value=data.phone;
        const nametag = document.getElementsByClassName('username');
        var elements = document.querySelectorAll('.username');
            
            // Iterate through each element and change the innerHTML
            elements.forEach(function(element) {
                element.innerHTML = data.username;
                element.value=data.username;
            });
        document.getElementById('staff_id').innerHTML=data.staff_id;
        document.getElementById('email').innerHTML=data.email;
        document.getElementById('email').value=data.email;

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