$('.hitme').click(function(){
    $('.pop2').removeClass('d-none');
});

$('.delete').click(function() {
    $('.checkboxbandka').removeClass('d-none');
    // $(".checkboxbandka").show(2500);
    $(".checkboxbandka").delay(700).fadeIn();
    // $(".checkboxbandka").delay(2500).removeClass('d-none');
    // $('.checkboxbandka').removeClass('d- ');
    $('.delete').addClass('d-none');
    $('.addkado').removeClass('d-none');
    $('.threedo').removeClass('col-xl-3');
    $('.threedo').addClass('col-xl-4');
    $('.fourdo').addClass('col-xl-4');
    $('.onedo').removeClass('col-xl-5');
    $('.onedo').addClass('col-xl-4');
    
});
  $('.cleardo').click(function() {
    $('.delete').removeClass('d-none');
    $('.hitme').addClass('d-none');
    $('.checkboxbandka').addClass('d-none');
    $('.threedo').removeClass('col-xl-4');
    $('.threedo').addClass('col-xl-3');
    $('.fourdo').removeClass('col-xl-3');
    $('.fourdo').addClass('col-xl-4');
    $('.onedo').removeClass('col-xl-4');
    $('.onedo').addClass('col-xl-5');
    
});
    