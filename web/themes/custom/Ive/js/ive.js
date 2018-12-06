(function($,Drupal, drupalsittings){
  $(document).ready(function(){
     // alert('Hello!');
    $("a[href ^='http']").attr('target','_blank');
    var host = window.location.origin;
    $("a[href^='http']")
      .css('background-image', 'url("' + host + '/mon-projet/web/themes/custom/Ive/images/external-link.gif")')
      .css('background-size','20px')
      .css('pading-left','-25px')
      .css('background-repeat','no-repeat')
      .css('background-position','left center');
  });

  $( ".block h2" ).click(function() {
    $( this ).parent().find(".content").slideToggle();
  });
})(jQuery, Drupal, drupalSettings);

