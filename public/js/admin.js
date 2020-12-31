$("#sidebar_menu li").click(function () {
    $("#sidebar_menu li").removeClass('active')
    $(this).addClass('active');
    $('.child_menu').slideUp(500);
    $('.child_menu',this).slideDown(500);
    $('#sidebar_menu .fa-angle-left').removeClass('fa-angle-down');
    $('.fa-angle-left',this).addClass('fa-angle-down');
});

select_file = function () {
    $("#pic").click();
};

loadFile = function (event) {
    const render = new FileReader();
    render.onload = function () {
        const output = document.getElementById('output');
        output.src = render.result;
    };
    render.readAsDataURL(event.target.files[0]);
};
