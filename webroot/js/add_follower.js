$(document).ready(function(){
  $('.button').click(function(){
    var id = this.id;
    $.ajax({
        url: "/following/add",
        type: "POST",
        data: {id: id},
        dataType: "text"
    }).done(function (response) {
        $(this).html((index, element)=>{
            $(`.follow_${id}`).replaceWith('<h3>フォローしました</h3>');
        });
    }).fail(function () {
        $(`#error_${id}`).html('フォローに失敗しました');
    });
  });
});


