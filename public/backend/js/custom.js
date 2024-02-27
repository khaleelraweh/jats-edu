// لتنسيق رسالة التنبيهات القادمة مع الراوت 
// رسالة التنبيهات موجودة في الملف
// views/partial/backend/flash.blade.php
// هذا الكود يقوم باستدعاء الاليرت ثم اعمل لها فيد تو بعد خمس ثواني 
// واعمل لها سلايد اب بسرعة نص ثانية
$(function(){
    $("#alert-message").fadeTo(5000,500).slideUp(500,function(){
        $("#alert-message").slideUp(500);
    })
});


// for pagination setting 
(function($) {
    $('ul.pagination li.active')
        .prev().addClass('show-mobile')
        .prev().addClass('show-mobile');
    $('ul.pagination li.active')
        .next().addClass('show-mobile')
        .next().addClass('show-mobile');
    $('ul.pagination')
        .find('li:first-child, li:last-child, li.active')
        .addClass('show-mobile');
})(jQuery);



$(document).ready(function(){

    // update Currency Status
    $(document).on("click",".updateCurrencyStatus",function(){
        var status = $(this).children("i").attr("status");
        var currency_id = $(this).attr("currency_id");

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-currency-status',
            data:{status:status,currency_id:currency_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#currency-"+currency_id).html("<i class='fas fa-toggle-off fa-lg text-warning' aria-hidden='true' status='Inactive' />");
                }else if (resp['status'] ==1 ){
                    $("#currency-"+currency_id).html("<i class='fas fa-toggle-on fa-lg text-primary' aria-hidden='true' status='Active' />");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

});
