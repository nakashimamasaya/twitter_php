$(document).ready(function(){
  $('.button').click(function(){
    var id = this.id;
    $.ajax({
        url: "/following/add",
        type: "POST",
        data: {id: id},
        dataType: "json"
    }).done(function (response) {
        if(response["result"] === "OK"){
            $(this).html((index, element)=>{
                $(`.follow_${id}`).replaceWith('<h3>フォローしました</h3>');
            });
        }
        else if (response["result"] === "NO"){
            $(this).html((index, element)=>{
                $(`#${id}`).prev('.error_message').replaceWith('<p class="error">フォローに失敗しました</p>');
            });
        }
    }).fail(function (response) {
        $(this).html((index, element)=>{
            $(`#${id}`).prev('.error_message').replaceWith('<p class="error">フォローに失敗しました</p>');
        });
    });
  });
});


