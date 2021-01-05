$("#sidebar_menu li").click(function () {
    $("#sidebar_menu li").removeClass('active')
    $(this).addClass('active');
    $('.child_menu').slideUp(500);
    $('.child_menu',this).slideDown(500);
    $('#sidebar_menu .fa-angle-left').removeClass('fa-angle-down');
    $('.fa-angle-left',this).addClass('fa-angle-down');
});

select_file = function () {
    $("#image").click();
};

loadFile = function (event) {
    const render = new FileReader();
    render.onload = function () {
        const output = document.getElementById('output');
        output.src = render.result;
    };
    render.readAsDataURL(event.target.files[0]);
};

delete_row = function (url, token, message_text) {
    if (confirm(message_text))
    {
        let form = document.createElement('form');
        form.setAttribute('method', 'POST');
        form.setAttribute('action', url);
        const hiddenField1 = document.createElement('input');
        hiddenField1.setAttribute('name', '_method');
        hiddenField1.setAttribute('value', 'DELETE');
        form.appendChild(hiddenField1);
        const hiddenField2 = document.createElement('input');
        hiddenField2.setAttribute('name', '_token');
        hiddenField2.setAttribute('value', token);
        form.appendChild(hiddenField2);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }
};

$("span[data-toggle='tooltip']").tooltip();

