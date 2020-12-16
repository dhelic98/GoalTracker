if($('#index-form').length > 0) {
  $('.form-slide').not(':first-of-type').hide();

  $('.btn-next-js').click(function(){
      $('.form-slide:visible').hide().next().show();
      $('.dot.active').removeClass('active').next().addClass('active');
  });

  $('.btn-prev-js').click(function(){
      $('.form-slide:visible').hide().prev().show();
      $('.dot.active').removeClass('active').prev().addClass('active');
  });
}
