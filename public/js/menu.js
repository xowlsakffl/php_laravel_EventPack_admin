$(function(){
    $('.menu-btn').click(function(){
        $(this).stop().toggleClass('active');
        $('.sidebar').stop().toggleClass('active');
        $('.main').stop().toggleClass('active');
    });

    $('.auth_btn').click(function(){
        $('.auth_box').fadeToggle(400);
    });

    $('.slideDownMenu').click(function(){
        $(this).siblings('ul').stop().slideToggle();
    })
})