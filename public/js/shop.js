$(document).ready(function () {

    $('.cat-list-box .parent-list .cat_list li').mouseover(function () {
        const index = $(this).attr('data-index');
        $('.child-list-div').css('display','none');
        $('.category-list-'+ index).css('display','block');
    });

    $('#show_cat_list').hover(function () {
        $(this).find('.cat-list-div').css('display','block');
    },function () {
        $(this).find('.cat-list-div').css('display','none');
    });
});


