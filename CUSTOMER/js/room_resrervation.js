let rooms = [
    {
        "title": "Premier Park-View Room",
        "price": "MYR&nbsp;500"
    },
    {
        "title": "Pool Garden-View Room",
        "price": "MYR&nbsp;400"
    },
    {
        "title": "Park-View Room",
        "price": "MYR&nbsp;300"
    },
    {
        "title": "City-View Room",
        "price": "MYR&nbsp;350"
    },
    {
        "title": "Royal Suite",
        "price": "MYR&nbsp;1,000"
    },
    {
        "title": "Presidential Suite",
        "price": "MYR&nbsp;1,200"
    },
    {
        "title": "Ambassador Suite",
        "price": "MYR&nbsp;1,100"
    },
    {
        "title": "Palladium Park-View Suite",
        "price": "MYR&nbsp;900"
    },
    {
        "title": "Park-View Junior Suite",
        "price": "MYR&nbsp;800"
    },
    {
        "title": "Two-Bedroom Executive Park-View Apartment",
        "price": "MYR&nbsp;1,800"
    },
    {
        "title": "Two-Bedroom Premier Park-View Apartment",
        "price": "MYR&nbsp;2,000"
    },
    {
        "title": "Two-Bedroom Deluxe Apartment",
        "price": "MYR&nbsp;1,500"
    },
    {
        "title": "One-Bedroom Deluxe Apartment",
        "price": "MYR&nbsp;700"
    }
];


function setupReservation(){
    let room = getCookie("booking");
    if(room!=""){
        $("#title").html(rooms[room].title);
        $("#originalPrice").html(rooms[room].price);
        $("#totalPrice").html(rooms[room].price);
    }
}
