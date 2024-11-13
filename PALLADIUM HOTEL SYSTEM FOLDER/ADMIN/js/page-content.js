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
    
    $.ajax({
        url: 'getUsername.php', // Replace with your API endpoint
        method: 'GET',
        success: function(response) {
            if(response!=""){
                let item =  JSON.parse(response);
                $('.username').html(item.username);
                document.getElementById('username').innerHTML=item.username;
                if(item.role=="admin")
                    document.getElementById('staffcontrol').removeAttribute("hidden");
            }
            else{
                window.location.replace("account/staff-login.php");
            }
        },
        
        error: function(jqXHR, textStatus, errorThrown) {
            // document.getElementById('username').innerHTML="";
        }
    });
}


function setupProfile(){
    $.ajax({
        url: 'getUsername.php', // Replace with your API endpoint
        method: 'GET',
        success: function(response) {
            let item =  JSON.parse(response);
            for (const key in item) {
                item[key]=item[key]==""?"-":item[key];
            }
            $('.username').html(item.username).val(item.username);
            $('#phone').html(item.phone).val(item.phone);
            $('#email').html(item.email).val(item.email);
            $('#staff_id').html(item.id);
            // document.getElementById('username').innerHTML=item.username;
            if(item.role=="admin")
                document.getElementById('staffcontrol').removeAttribute("hidden");
        },
        
        error: function(jqXHR, textStatus, errorThrown) {
        }
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


function setupBooking() {
    // let id=this.value;
    // let dbtable=$('.hotel-list').data('list')+'_account';
    $.ajax({
        // url: 'get-customer.php', // URL to the backend script
        url: 'fetch_bookings.php', // URL to the backend script
        method: 'GET',
        
        // dataType: 'json', // Expect JSON response
        success: function(response) {   
            const tableBody = document.getElementById("bookingTable");
            tableBody.innerHTML="";
            // Check for errors in the response
            if (response.error) {
                console.error('Error:', response.error);
                return;
            }
            // Loop through the response and append messages
            response.forEach(function(item) {
                let id=item.id;
                $('#bookingTable').append(`<tr>
                                        <td>`+item.guest_name+`</td>
                                        <td>`+item.room_name+`</td>
                                        <td><input class="di`+id+` border-0" id="ci`+id+`" type="date" value="`+convertDateFormatInput(item.start_date)+`" readonly></input></td>
                                        <td><input class="di`+id+` border-0" id="co`+id+`" type="date" value="`+convertDateFormatInput(item.end_date)+`" readonly></input></td>
                                        <td>
                                            <button type="button" class="btn btn-primary shadow-sm editBtn" value=`+id+`>Edit</button>
                                        </td>
                                        <td>
                                            <form action="reset-room.php" method="GET" style="display: inline;">
                                                <input type="hidden" name="delete" value="`+id+`">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>`);
            });
        },
    error: function() {
        console.error('Failed to fetch messages.');
    }
});
}

$('#bookingTable').on('click','.editBtn',function(){
    var booking_id=$(this).val();
    if($(this).html()=="Edit"){
        $(this).html("Save").removeClass("btn-primary").addClass("btn-success");
        $(".di"+booking_id).removeAttr("readonly").removeClass("border-0").addClass("border");
    }
    else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            }
        };
        xhttp.open("POST", "editBooking.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(
            "booking_id="+booking_id+"&checkin="+convertDateFormat($("#ci"+booking_id).val())+"&checkout="+convertDateFormat($("#co"+booking_id).val())
        );

        $(this).html("Edit").removeClass("btn-success").addClass("btn-primary");
        $(".di"+booking_id).attr("readonly",true).removeClass("border").addClass("border-0");
    }
});


function convertDateFormatInput(dateString) {
    // Split the date string by the delimiter "/"
    const parts = dateString.split("/");
    
    // Rearrange the parts to "DD/MM/YYYY"
    const newDateFormat = `${parts[2]}-${parts[1]}-${parts[0]}`;
    
    return newDateFormat;
}

function convertDateFormat(dateString) {
    // Split the date string by the delimiter "/"
    const parts = dateString.split("-");
    
    // Rearrange the parts to "DD/MM/YYYY"
    const newDateFormat = `${parts[2]}/${parts[1]}/${parts[0]}`;
    
    return newDateFormat;
}
