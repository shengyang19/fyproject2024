let l;

// Function to fetch latest data using AJAX
function fetchData(list) {
    $('#editcard').hide();
    $('#cards').show();
    let dbtable = list;
    if(list=='customer'||list=='staff') dbtable= list+"_account";
    
    $.ajax({
        // url: 'get-customer.php', // URL to the backend script
        url: 'getList.php', // URL to the backend script
        method: 'GET',
        data: { tablename: dbtable }, // Send tablename as a query parameter
        
        // dataType: 'json', // Expect JSON response
        success: function(response) {            
            // Clear the message container
            $('#cards').empty();

            // Check for errors in the response
            if (response.error) {
                console.error('Error:', response.error);
                return;
            }
            // Loop through the response and append messages
            response.forEach(function(item) {
                if(list=='customer'||list=='staff'){ 
                    const username = item.username.toUpperCase();
                    const phone = item.phone;
                    let top = item.email.toUpperCase();
                    let formaction;
                    const id=item.id;
                    if(list=="customer"){
                        formaction="edit-customer.php";
                    }
                    else if(list=="staff"){
                        formaction="edit-staff.php";
                    }
                    $('#cards').append(`
                        <div class="card border-left-primary shadow py-2 mb-3">
                            <div class="card-body">
                                <div class="d-flex no-gutters align-items-center">
                                    <div class="mr-auto">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">`+top+`</div>
                                        <div>
                                            <div class="h5 mb-1 font-weight-bold text-gray-800">`+username+`</div>
                                        </div>
                                        <div style="height: 1rem;">
                                            <div class="h5 mb-1 text-gray-800">`+phone+`</div>
                                        </div>
                                    </div>
                                    <div class="d-block">
                                        <button type="button" class="btn btn-primary shadow-sm card-button" style="width: 5rem;" id="editBtn" value="`+id+`">Edit</button>
                                        <button type="button" class="btn btn-danger shadow-sm card-button" style="width: 5rem;" data-toggle="modal" data-target="#confirmDelete" data-id="`+id+`">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>`);
                    }
                });
            },
        error: function() {
            console.error('Failed to fetch messages.');
        }
    });
}
//  #reuse method to setup customer & setup staff

function setupList(filename){
    l=filename;
    // setupPage();
    fetchData(filename);
        
    // const listname=list+".json";
    // fetch(listname)
    // .then(response => {
    //     if(!response.ok) {
    //         throw new Error('Network response was not ok');
    //     }
    //     return response.json();  // Parsing the JSON data
    // })
    // .then(data => {
    //     // Get a reference to the table body where you want to insert rows
    //     const tableBody = document.getElementById('cards'); // Make sure this ID matches your HTML

    //     // Clear any existing rows
    //     tableBody.innerHTML = "";

    //     // Loop through the fetched data and create a table row for each entry
    //     data.forEach(item => {
    //         const name = item.name.toUpperCase();
    //         const id = item.id;
    //         const phone = item.phone;
    //         let top;
    //         let formaction;
    //         if(list=="customers"){
    //             top = item.email.toUpperCase();
    //             formaction=`<form action="edit-customer.php" method="POST">`
    //         }
    //         else if(list=="staffs"){
    //             top = item.role.toUpperCase();
    //             formaction=`<form action="edit-staff.php" method="POST">`
    //         }

    //         const div1 = document.createElement('div');
    //         div1.setAttribute("class","mb-3");
            // div1.innerHTML=`<div class="card border-left-primary shadow py-2" style="max-width: 600px">
            //                     <div class="card-body">
            //                         <div class="row no-gutters align-items-center">
            //                             <div class="col mr-2">
            //                                 <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">`+top+`</div>
            //                                 <div>
            //                                     <div class="h5 mb-1 font-weight-bold text-gray-800">`+name+`</div>
            //                                 </div>
            //                                 <div style="height: 1rem;">
            //                                     <div class="h5 mb-1 text-gray-800">`+phone+`</div>
            //                                 </div>
            //                             </div>
            //                             `+formaction+`
            //                             <div class="col-auto d-inline">
            //                                 <input type="hidden" name="edit" value=`+id+`>
            //                                 <input type="submit" class="d-inline btn btn-primary btn-lg shadow-sm" value="Edit"/>
            //                                 <button type="button" class="d-inline btn btn-danger btn-lg shadow-sm" data-toggle="modal" data-target="#confirmDelete" data-id="`+id+`"><i class="fas fa-trash"></i></button>
            //                             </div>
            //                             </form>
            //                             <div class="col-auto">
            //                             </div>
            //                         </div>
            //                     </div>
            //                 </div>`;

    //         // Append the new row to the table body
    //         tableBody.appendChild(div1);

    //     });
    // })
    // .catch(error => {
    //     console.error('Error fetching JSON data:', error);
    // });
}

// Set the ID of the name to delete in the modal
$('#confirmDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
    var modal = $(this);
    modal.find('#deleteId').val(id); // Set the value of the hidden input
});

$('.hotel-list').on('click',function(){
    fetchData($(this).data('list'));
});

$('#cancelBtn').on('click',function(){
    // fetchData($('.hotel-list').data('list'));
    $('#editcard').hide();
    $('#cards').show();
});

$('#cards').on('click','#editBtn',function(event){
    let id=this.value;
    let dbtable=$('.hotel-list').data('list')+'_account';
    $.ajax({
        // url: 'get-customer.php', // URL to the backend script
        url: 'getList.php', // URL to the backend script
        method: 'GET',
        data: { tablename: dbtable, id: id }, // Send tablename as a query parameter
        
        
        // dataType: 'json', // Expect JSON response
        success: function(response) {            
            // Hide the list container
            $('#cards').hide();
            $('#editcard').show(500);
            $('#saveButton').val(id);
            
            // Check for errors in the response
            if (response.error) {
                console.error('Error:', response.error);
                return;
            }
            // Loop through the response and append messages
            response.forEach(function(item) {
                $('#inputEmail').text(item.email);
                $('#inputFullname').val(item.username);
                $('#inputPhone').val(item.phone);
                if(dbtable=="customer_account"){
                    $('#inputBirthdate').val(item.birthday);
                    $('#inputMembership').val(item.membership);
                }
                else if(dbtable=="staff_account"){
                    document.getElementById(item.role).selected=true;
                }
            });
        },
    error: function() {
        console.error('Failed to fetch messages.');
    }
});
});

// save button to update database
$(document).ready(function() {
    $('#saveButton').on('click', function() {
        // Get values from input fields
        const dbtable=$('.hotel-list').data('list')+'_account';
        const username = $('#inputFullname').val();
        const phone = $('#inputPhone').val();
        const birthday = $('#inputBirthdate').val();
        const membership = $('#inputMembership').val();
        const role = $('#inputRole').val();
        
        const editId = this.value;
        
        
        // Perform AJAX request
        $.ajax({
            url: 'setList.php', // Replace with your API endpoint
            method: 'POST', // Use POST for updates
            data: {
                tablename: dbtable, // Specify your table name
                username: username,
                phone: phone,
                birthday: birthday,
                membership: membership,
                role: role,
                id: editId // Include the ID of the record you're updating
            },
            success: function(response) {
                // Handle successful response
                fetchData(l);
                console.log('Update successful:', response);
                alert('Data updated successfully!');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error
                console.error('Update failed:', textStatus, errorThrown);
                alert('Error updating data.');
            }
        });
    });
});

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
        var elements = document.querySelectorAll('.username');
            
            // Iterate through each element and change the innerHTML
            elements.forEach(function(element) {
                element.innerHTML = data.username;
                element.value=data.username;
            });
        document.getElementById('staff_id').innerHTML=data.staff_id;
        document.getElementById('email').innerHTML=data.email;
        document.getElementById('email').value=data.email;
        if(data.role=="admin")
            document.getElementById('staffcontrol').removeAttribute("hidden");

    })
    .catch(error => {
        console.error('Error fetching JSON data:', error);
    });
}

function setupFeedback(){
    // setupPage();
    let dbtable="feedback";
    $.ajax({
        // url: 'get-customer.php', // URL to the backend script
        url: 'getList.php', // URL to the backend script
        method: 'GET',
        data: { tablename: dbtable }, // Send tablename as a query parameter
        
        // dataType: 'json', // Expect JSON response
        success: function(response) {            
            // Clear the message container
            $('#feedbackTableBody').empty();

            // Check for errors in the response
            if (response.error) {
                console.error('Error:', response.error);
                return;
            }
            // Loop through the response and append messages
            response.forEach(function(item) {
                $('#feedbackTableBody').append(`<tr>
                        <td>`+item.subject+`</td>
                        <td>`+item.message+`</td>
                        <td>`+item.name+`</td>
                        <td>`+item.date+`</td>
                        <td>`+item.email+`</td>
                    </tr>`);
                
                });
            },
        error: function() {
            console.error('Failed to fetch messages.');
        }
    });
}

function timer(){
    if(l!=""){
        fetchData(l);
    }
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