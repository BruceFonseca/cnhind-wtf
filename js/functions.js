$(document).ready(function () {

//sidebar
  $('#wrapper').addClass('toggled');
  
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = true;

      trigger.removeClass('is-closed');
      trigger.addClass('is-open');

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {   
        // overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        // overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }

  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  


// tooltips Bootstrap
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="dropdown"]').tooltip();


});