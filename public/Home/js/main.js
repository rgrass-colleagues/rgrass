






$('#book_data_click_content table tr:nth-child(1)').css({background: "#6BFFBE"});
$('#book_data_click_content table tr:nth-child(2)').css({background: "#EAF6CE"});
$('#book_data_comment_content table tr:nth-child(1)').css({background: "#6BFFBE"});
$('#book_data_comment_content table tr:nth-child(2)').css({background: "#EAF6CE"});
function clearText(input){
    $(input).attr("value",'');

}




var url = window.location.href;
arr = url.split('/');
var path_name = arr.pop();
$('.js_url').removeAttr("id");
$('.'+path_name).attr('id','js_style');

