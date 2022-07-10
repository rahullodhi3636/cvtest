 $(document).ready(function() {
  var date = new Date();
  date.setDate(date.getDate());
   $('#menu_icon').click(function() {
      if ($('.sidebar').hasClass('expandit')){
          $('.sidebar').addClass('collapseit');
          $('.sidebar').removeClass('expandit');
          $('.profile-info').addClass('short-profile');
          //$('.logo-area').addClass('logo-icon');
          $('.main-content').addClass('sidebar_shift');
          //$('.menu-title').css("display", "none");
  } else {
    $('.sidebar').addClass('expandit');
    $('.sidebar').removeClass('collapseit');
    $('.profile-info').removeClass('short-profile');
      //$('.logo-area').removeClass('logo-icon');
      $('.main-content').removeClass('sidebar_shift');
      //$('.menu-title').css("display", "inline-block");
  }
});

    $('.datetimepicker').datepicker({
    /*weekStart: 0,*/
    startDate: date,
    todayHighlight: true
});

});