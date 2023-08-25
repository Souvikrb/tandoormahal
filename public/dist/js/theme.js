var url = '{{url('/')}}';

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

    
// Ajax Loader
$('.loader').html('<img width="20px" src="../dist/img/loader/loader.gif">');
$(document).ajaxStart(function(){
    $('.loader').show();
});
$(document).ajaxComplete(function(){
    $('.loader').hide();
});
// End Ajax Loader


$('.number').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    

    if (String.fromCharCode(charCode).match(/[^0-9]/g))    

        return false;                        

});    
