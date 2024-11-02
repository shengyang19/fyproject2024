let rooms = [
    {
        "title": "Premier Park-View Room",
        "price": ""
    },
    {
        "title": "Pool Garden-View Room",
        "price": ""
    },
    {
        "title": "Park-View Room",
        "price": ""
    },
    {
        "title": "City-View Room",
        "price": ""
    },
    {
        "title": "Royal Suite",
        "price": ""
    },
    {
        "title": "Presidential Suite",
        "price": ""
    },
    {
        "title": "Ambassador Suite",
        "price": ""
    },
    {
        "title": "Palladium Park-View Suite",
        "price": ""
    },
    {
        "title": "Park-View Junior Suite",
        "price": ""
    },
    {
        "title": "Two-Bedroom Executive Park-View Apartment",
        "price": ""
    },
    {
        "title": "Two-Bedroom Premier Park-View Apartment",
        "price": ""
    },
    {
        "title": "Two-Bedroom Deluxe Apartment",
        "price": ""
    },
    {
        "title": "One-Bedroom Deluxe Apartment",
        "price": ""
    }
];


function setupReservation(){
    let room = getCookie("booking");
    if(room!=""){
        $("#title").html(rooms[room].title);
    }
}
