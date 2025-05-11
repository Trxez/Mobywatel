$('body').removeClass('ovh');
$('#wybordokumentu').hide();
$('#menu').hide();
$('#danedowodu').hide();
$('#danemdowodu').hide();

function wybordokumentumenu() {
    // Toggle the visibility of the section
    window.scrollTo({
      top: 0
    });
    $('body').toggleClass('ovh');
    $('#wybordokumentu').toggle();
    $('#menu').toggle();
}

function danedowodowe() {
  $('#wybordokumentu').hide();
  $('#danedowodu').show();
}

function danemdowodowe() {
  $('#wybordokumentu').hide();
  $('#danemdowodu').show();
}

function zamknij2() {
  $('#danedowodu').hide();
  $('#danemdowodu').hide();
  $('#menu').hide();
  $('body').removeClass('ovh');
}


function wroc(){
  $('#wybordokumentu').show();
  $('#danedowodu').hide();
  $('#danemdowodu').hide();
}