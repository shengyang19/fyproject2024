let rooms = [
    {
        "title": "Club Premier Park-View Room",
        "price": "MYR&nbsp;500",
        "pricepernight": 500
    },
    {
        "title": "Premier Park-View Room",
        "price": "MYR&nbsp;500",
        "pricepernight": 500
    },
    {
        "title": "Pool Garden-View Room",
        "price": "MYR&nbsp;400",
        "pricepernight": 400
    },
    {
        "title": "Park-View Room",
        "price": "MYR&nbsp;300",
        "pricepernight": 300
    },
    {
        "title": "City-View Room",
        "price": "MYR&nbsp;350",
        "pricepernight": 350
    },
    {
        "title": "Royal Suite",
        "price": "MYR&nbsp;1,000",
        "pricepernight": 1000
    },
    {
        "title": "Presidential Suite",
        "price": "MYR&nbsp;1,200",
        "pricepernight": 1200
    },
    {
        "title": "Ambassador Suite",
        "price": "MYR&nbsp;1,100",
        "pricepernight": 1100
    },
    {
        "title": "Palladium Park-View Suite",
        "price": "MYR&nbsp;900",
        "pricepernight": 900
    },
    {
        "title": "Park-View Junior Suite",
        "price": "MYR&nbsp;800",
        "pricepernight": 800
    },
    {
        "title": "Two-Bedroom Executive Park-View Apartment",
        "price": "MYR&nbsp;1,800",
        "pricepernight": 1800
    },
    {
        "title": "Two-Bedroom Premier Park-View Apartment",
        "price": "MYR&nbsp;2,000",
        "pricepernight": 2000
    },
    {
        "title": "Two-Bedroom Deluxe Apartment",
        "price": "MYR&nbsp;1,500",
        "pricepernight": 1500
    },
    {
        "title": "One-Bedroom Deluxe Apartment",
        "price": "MYR&nbsp;700",
        "pricepernight": 700
    }
];

function convertDateFormat(dateString) {
    // Split the date string by the delimiter "/"
    const parts = dateString.split("/");
    
    // Rearrange the parts to "DD/MM/YYYY"
    const newDateFormat = `${parts[1]}/${parts[0]}/${parts[2]}`;
    
    return newDateFormat;
}

function getTotalDays(date1, date2) {
    // Convert the date strings to Date objects
    const startDate = new Date(date1);
    const endDate = new Date(date2);
    
    // Get the time in milliseconds for each date
    const startTime = startDate.getTime();
    const endTime = endDate.getTime();
    
    // Calculate the difference in milliseconds
    const differenceInMilliseconds = endTime - startTime;
    
    // Convert milliseconds to days (1 day = 86400000 milliseconds)
    const differenceInDays = differenceInMilliseconds / (1000 * 60 * 60 * 24);
    
    return Math.abs(differenceInDays); // Return the absolute value to avoid negative days
}


function setupReservation(){
    let room = JSON.parse(sessionStorage.getItem("booking"));
    let id = room.id;
    let isAvailable = false;
    let roomcount = 0;
    let availableRoom;
    if(room!=null){
        $("#title").html(rooms[room.id].title);
        const totalDays = getTotalDays(convertDateFormat(room.checkin), convertDateFormat(room.checkout));
        const totalPrice = totalDays*rooms[room.id].pricepernight;
        $("#originalPrice").html(rooms[room.id].price);
        $("#totalPrice").html("MYR&nbsp;"+totalPrice.toString());
        $("#checkindate").html(room.checkin);
        $("#checkoutdate").html(room.checkout);
        $.ajax({
            // url: 'get-customer.php', // URL to the backend script
            url: 'getBooking.php', // URL to the backend script
            method: 'GET',
            data: { id: id }, // Send tablename as a query parameter
            
            
            // dataType: 'json', // Expect JSON response
            success: function(response) {
                
                // Check for errors in the response
                if (response.error) {
                    console.error('Error:', response.error);
                    return;
                }
                // Loop through the response and append messages
                response.forEach(function(item) {
                    if(item.guest_id==null){
                        availableRoom=item.id;
                        roomcount++;
                        isAvailable = true;
                    }
                });
            },
            error: function() {
                console.error('Failed to fetch messages.');
            }
        });
        if (!isAvailable) { $("#availableText").html("Not available");}//disable payment button
    }
    
}

setupReservation();
