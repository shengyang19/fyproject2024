let rooms = [{
      "title": "Premier Park-View Room",
      "image": "img/offers/2.png",
      "description": [
        "One king bed or two twin beds, One extra bed or one crib",
        "King bed: 3 adults, or 2 adults and 1 child; Twin beds: 3 adults, or 2 adults and 2 children",
        "KLCC Park and fountain"
      ],
      "booking_link": "#test-form"
  }

]

function setupReservation(){
    let room = getCookie("booking");
    if(room!=""){
        $("#title").html(rooms[room].title);
    }
}
