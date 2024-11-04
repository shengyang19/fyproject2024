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
    if(room!=null){
        const totalDays = getTotalDays(convertDateFormat(room.checkin), convertDateFormat(room.checkout));
        const totalPrice = totalDays*rooms[room.id].pricepernight;
        $("#title").html(rooms[room.id].title);
        $("#originalPrice").html(rooms[room.id].price);
        $("#totalPrice").html("MYR&nbsp;"+totalPrice.toString());
        $("#checkindate").html(room.checkin);
        $("#checkoutdate").html(room.checkout);
    }
}

setupReservation();
