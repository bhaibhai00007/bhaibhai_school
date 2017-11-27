// searchBar
$('.input-group .form-control').focus(function(){
    $(this).closest('.input-group').addClass('focus');
}).blur(function() {
    $(this).closest('.input-group').removeClass('focus');
})

// mobile coding
if ($(window).width() < 991) {
    $('.homebanner-holder').insertBefore('.sidebar');
    $('.singleProduct').insertBefore('.sidebar');
    $('#refund').insertBefore('#policy');
    $('#paymentMethod').insertBefore('#refund');
    $('.breadcrumb .filterBtn').click(function() {
        $('.sidebar.filters').toggleClass('active');
    });
    $('.sidebar.filters .cross').click(function() {
        $('.sidebar.filters').toggleClass('active');
    });
};