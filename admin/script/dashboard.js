$('.page').on('click', function(){
    var icon = $('span:contains(".fa-chevron-right")');
    let sub =  $('.sub_pages').css('display');
    if(sub == 'none'){
    // $(this).find('i').remove();
    // $('.page').add('<i class="fas fa-chevron-down"></i>');
    $('#icon i').removeClass('fa-chevron-right');
    $('#icon i').addClass('fa-chevron-down');
    $('.sub_pages').css('display', 'block');
    }
    else{
        $('#icon i').removeClass('fa-chevron-down');
        $('#icon i').addClass('fa-chevron-right');
        $('.sub_pages').css('display', 'none');
    }
});
$('.sale').on('click', function(){
    let sub =  $('.sub_sale').css('display');
    if(sub == 'none'){
    $('.sub_sale').css('display', 'block');
    }
    else{
        $('.sub_sale').css('display', 'none');
    }
});
$('.authens').on('click', function(){
    // var icon = $('span:contains(".fa-chevron-right")');
    let sub =  $('.sub_authen').css('display');
    if(sub == 'none'){
    $('#icon1 i').removeClass('fa-chevron-right');
    $('#icon1 i').addClass('fa-chevron-down');
    $('.sub_authen').css('display', 'block');
    }
    else{
            $('#icon1 i').removeClass('fa-chevron-down');
            $('#icon1 i').addClass('fa-chevron-right');
            $('.sub_authen').css('display', 'none');
    }
});
$('.errors').on('click', function(){
    let sub =  $('.sub_error').css('display');
    let icon = $('#icon2 i').attr('class');
    var icon2 = $('#icon2 i');
    if(icon == 'fas fa-chevron-right'){
        $('#icon2 i').removeClass('fas fa-chevron-right');
        $('#icon2 i').addClass('fas fa-chevron-down')
    }
    else{
        $('#icon2 i').removeClass('fas fa-chevron-down');
        $('#icon2 i').addClass('fas fa-chevron-right');
    }
    if(sub == 'none'){ 
    $('.sub_error').css('display', 'block');
    }
    else{    
        $('.sub_error').css('display', 'none');
    }
});
$('#bar').on('click', function(){
   var left_position = $('main').find('.left').css('left');
   if(left_position == "0px"){
    $('main').find('.left').css('left','-260px');
    $('main').find('.right').css('left','-260px');
    }
    else{
        $('main').find('.left').css('left','0px');
        $('main').find('.right').css('left','0px');
    }
});
var ulElement = document.querySelector(".myForm ul");
ulElement.onmousedown = function(e){
    e.preventDefault();
}

