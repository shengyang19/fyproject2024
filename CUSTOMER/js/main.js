(function ($) {
"use strict";
// TOP Menu Sticky
$(window).on('scroll', function () {
	var scroll = $(window).scrollTop();
	if (scroll < 400) {
    $("#sticky-header").removeClass("sticky");
    $('#back-top').fadeIn(500);
	} else {
    $("#sticky-header").addClass("sticky");
    $('#back-top').fadeIn(500);
	}
});


$(document).ready(function(){

// mobile_menu
var menu = $('ul#navigation');
if(menu.length){
	menu.slicknav({
		prependTo: ".mobile_menu",
		closedSymbol: '+',
		openedSymbol:'-'
	});
};
// blog-menu
  // $('ul#blog-menu').slicknav({
  //   prependTo: ".blog_menu"
  // });

// review-active
$('.slider_active').owlCarousel({
  loop:true,
  margin:0,
items:1,
autoplay:true,
navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
  nav:true,
dots:false,
autoplayHoverPause: true,
autoplaySpeed: 800,
  responsive:{
      0:{
          items:1,
          nav:false,
      },
      767:{
          items:1,
          nav:false,
      },
      992:{
          items:1
      }
  }
});

// about_active
$('.about_active').owlCarousel({
  loop:true,
  margin:0,
items:1,
autoplay:true,
navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
  nav:true,
dots:false,
autoplayHoverPause: true,
autoplaySpeed: 800,
  responsive:{
      0:{
          items:1,
          nav:false,
      },
      767:{
          items:1,
          nav:false,
      },
      992:{
          items:1
      }
  }
});

// review-active
$('.testmonial_active').owlCarousel({
  loop:true,
  margin:0,
items:1,
autoplay:true,
navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
  nav:true,
dots:false,
autoplayHoverPause: true,
autoplaySpeed: 800,
  responsive:{
      0:{
          items:1,
          dots:false,
          nav:false,
      },
      767:{
          items:1,
          dots:false,
          nav:false,
      },
      992:{
          items:1,
          nav:false
      },
      1200:{
          items:1,
          nav:false
      },
      1500:{
          items:1
      }
  }
});

// for filter
  // init Isotope
  var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    percentPosition: true,
    masonry: {
      // use outer width of grid-sizer for columnWidth
      columnWidth: 1
    }
  });

  // filter items on button click
  $('.portfolio-menu').on('click', 'button', function () {
    var filterValue = $(this).attr('data-filter');
    $grid.isotope({ filter: filterValue });
  });

  //for menu active class
  $('.portfolio-menu button').on('click', function (event) {
    $(this).siblings('.active').removeClass('active');
    $(this).addClass('active');
    event.preventDefault();
	});
  
  // wow js
  new WOW().init();

  // counter 
  $('.counter').counterUp({
    delay: 10,
    time: 10000
  });

/* magnificPopup img view */
$('.popup-image').magnificPopup({
	type: 'image',
	gallery: {
	  enabled: true
	}
});

/* magnificPopup img view */
$('.img-pop-up').magnificPopup({
	type: 'image',
	gallery: {
	  enabled: true
	}
});

/* magnificPopup video view */
$('.popup-video').magnificPopup({
	type: 'iframe'
});


  // scrollIt for smoth scroll
  $.scrollIt({
    upKey: 38,             // key code to navigate to the next section
    downKey: 40,           // key code to navigate to the previous section
    easing: 'linear',      // the easing function for animation
    scrollTime: 600,       // how long (in ms) the animation takes
    activeClass: 'active', // class given to the active nav element
    onPageChange: null,    // function(pageIndex) that is called when page is changed
    topOffset: 0           // offste (in px) for fixed top navigation
  });

  // scrollup bottom to top
  $.scrollUp({
    scrollName: 'scrollUp', // Element ID
    topDistance: '4500', // Distance from top before showing element (px)
    topSpeed: 300, // Speed back to top (ms)
    animation: 'fade', // Fade, slide, none
    animationInSpeed: 200, // Animation in speed (ms)
    animationOutSpeed: 200, // Animation out speed (ms)
    scrollText: '<i class="fa fa-angle-double-up"></i>', // Text for element
    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
  });


  // blog-page

  //brand-active
$('.brand-active').owlCarousel({
  loop:true,
  margin:30,
items:1,
autoplay:true,
  nav:false,
dots:false,
autoplayHoverPause: true,
autoplaySpeed: 800,
  responsive:{
      0:{
          items:1,
          nav:false

      },
      767:{
          items:4
      },
      992:{
          items:7
      }
  }
});

// blog-dtails-page

  //project-active
$('.project-active').owlCarousel({
  loop:true,
  margin:30,
items:1,
// autoplay:true,
navText:['<i class="Flaticon flaticon-left-arrow"></i>','<i class="Flaticon flaticon-right-arrow"></i>'],
nav:true,
dots:false,
// autoplayHoverPause: true,
// autoplaySpeed: 800,
  responsive:{
      0:{
          items:1,
          nav:false

      },
      767:{
          items:1,
          nav:false
      },
      992:{
          items:2,
          nav:false
      },
      1200:{
          items:1,
      },
      1501:{
          items:2,
      }
  }
});

if (document.getElementById('default-select')) {
  $('select').niceSelect();
}

  //about-pro-active
$('.details_active').owlCarousel({
  loop:true,
  margin:0,
items:1,
// autoplay:true,
navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
nav:true,
dots:false,
// autoplayHoverPause: true,
// autoplaySpeed: 800,
  responsive:{
      0:{
          items:1,
          nav:false

      },
      767:{
          items:1,
          nav:false
      },
      992:{
          items:1,
          nav:false
      },
      1200:{
          items:1,
      }
  }
});

});

// resitration_Form
$(document).ready(function() {
	$('.popup-with-form').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#name',

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});
});



//------- Mailchimp js --------//  
function mailChimp() {
  $('#mc_embed_signup').find('form').ajaxChimp();
}
mailChimp();



        // Search Toggle
        $("#search_input_box").hide();
        $("#search").on("click", function () {
            $("#search_input_box").slideToggle();
            $("#search_input").focus();
        });
        $("#close_search").on("click", function () {
            $('#search_input_box').slideUp(500);
        });
        // Search Toggle
        $("#search_input_box").hide();
        $("#search_1").on("click", function () {
            $("#search_input_box").slideToggle();
            $("#search_input").focus();
        });

})(jQuery);	


$(document).ready(function() {
	$('.book_now').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#name',

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});
});


let booking = new Object();
$('.book_now').click(function(){
  var roomid = $(this).data('id');
  selectroom=roomid.toString();
  document.getElementById(selectroom).selected=true;
  $('select').niceSelect('update');
  if(roomid!=undefined) booking.id=roomid;
  else booking.id = null;
  booking.checkin=$('#datepicker').val();
  booking.checkout=$('#datepicker2').val();
  // else setCookie("booking",booking,0.5);
  return false;
});

function checkAvailability(){
  let user = getCookie("user");
  if(user === ""){
    if(confirm("Please log in to check availability.")) {
      window.location.href = "account/cust-login.php";
      return true;}
  }
  else{
      return false;
  }
  return true;
}

$('#room-select').change(function(){
  newselect=$(this).val();
  if(newselect!="Room type") booking.id=newselect;
  // $('.book_now').attr('data-id',$(this).val());
  // console.log($('.book_now').data('id'))
});

$('#bookRoom').click(function(){
//   if (checkAvailability()) return false;
  if(booking.id!=null){ sessionStorage.setItem("booking",JSON.stringify(booking));// Convert the 'booking' object to a JSON string
    const bookingJSON = JSON.stringify(booking);
    
    // Set a cookie with a name 'booking', value as the JSON string, and a 1-day expiration time
    document.cookie = "booking=" + encodeURIComponent(bookingJSON) + "; path=/; max-age=" + (60 * 60 * 24) + ";";
}
  else return false;
});

var checkindate = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
var checkoutdate = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()+1);
// var tomorrow = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()+1);
$('#datepicker').datepicker({
    format: 'dd/mm/yyyy',
    minDate: checkindate,
    iconsLibrary: 'fontawesome',
    icons: {
      rightIcon: '<span class="fa fa-caret-down"></span>'
  }
});
$('#datepicker2').datepicker({
  format: 'dd/mm/yyyy',
  minDate: function(){return new Date(checkindate.getFullYear(), checkindate.getMonth(), checkindate.getDate()+1)},
  iconsLibrary: 'fontawesome',
  icons: {
    rightIcon: '<span class="fa fa-caret-down"></span>'
  }
});
  
$('#datepicker').datepicker("value",checkindate)
$('#datepicker2').datepicker("value",checkoutdate)

// let checkoutdate = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()+1);
$("#datepicker").change(function(){
  checkindate = new Date(convertDateFormat($('#datepicker').val()));
  if(checkindate.getTime()>=checkoutdate.getTime())
    checkoutdate = new Date(checkindate.getFullYear(), checkindate.getMonth(), checkindate.getDate()+1);
  $('#datepicker2').datepicker("value",checkoutdate);
  booking.checkin=$('#datepicker').val();;
  booking.checkout=$('#datepicker2').datepicker("value");
});

$("#datepicker2").change(function(){
  checkoutdate = new Date(convertDateFormat($('#datepicker2').val()));
  booking.checkout=$('#datepicker2').val();
});

function convertDateFormat(dateString) {
  // Split the date string by the delimiter "/"
  const parts = dateString.split("/");
  
  // Rearrange the parts to "DD/MM/YYYY"
  const newDateFormat = `${parts[1]}/${parts[0]}/${parts[2]}`;
  
  return newDateFormat;
}

function fetchBookings() {
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
                if(item.guest_name!=null){
                    // const row = document.createElement("tr");
                    $('#bookingTable').append(`<tr>
                            <th scope="row">1</th>
                            <td>`+item.room_name+`</td>
                            <td>`+item.start_date+`</td>
                            <td>`+item.end_date+`</td>
                            <td>Paid</td>
                        </tr>`);
                }
            });
        },
    error: function() {
        console.error('Failed to fetch messages.');
    }
});
}