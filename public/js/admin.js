$("#sidebar_menu li").click(function () {
    $("#sidebar_menu li").removeClass('active')
    $(this).addClass('active');
    $('.child_menu').slideUp(500);
    $('.child_menu',this).slideDown(500);
    $('#sidebar_menu .fa-angle-left').removeClass('fa-angle-down');
    $('.fa-angle-left',this).addClass('fa-angle-down');
});
