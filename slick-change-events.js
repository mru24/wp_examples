$('.slider').on('beforeChange', function() {
  let last_item = $('.slider .image.slick-current').index();
  $('.menu-bar-item:nth-child('+last_item+')').removeClass('active');
});
$('.slider').on('afterChange', function() {
  let next_item = $('.slider .image.slick-current').index();
  $('.menu-bar-item:nth-child('+next_item+')').addClass('active');
});
