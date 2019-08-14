function getCalendar(target_div, year, month){ 
    $.ajax({ 
        type:'POST', 
        url:'controller/calendar.php', 
        data:'func=getCalender&year='+year+'&month='+month, 
        success:function(html){ 
            $('#'+target_div).html(html); 
        } 
    }); 
} 
 
function getEvents(date){
    $.ajax({
        type:'POST',
        url:'controller/calendar.php',
        data:'func=getEvents&date='+date,
        success:function(html){
            $('#event_list').html(html);
            $('#event_add').slideUp('slow');
            $('#event_list').slideDown('slow');
        }
    });
}
 
// //For Add Event
// function addEvent(date){
//     $('#eventDate').val(date);
//     $('#eventDateView').html(date);
//     $('#event_list').slideUp('slow');
//     $('#event_add').slideDown('slow');
// }

//For Add Event
jQuery(document).ready(function(){
    jQuery('#addEventBtn').on('click',function(){
        var date = jQuery('#eventDate').val();
        var title = jQuery('#eventTitle').val();
        // jQuery.ajax({
        //     type:'POST',
        //     url:'./postEvent.php',
        //     dataType: 'json',
        //     data:'func=addEvent&date='+date+'&title='+title,
        //     data: JSON.stringify({
        //         post: 'addEvent',
        //         date: date,
        //         title: title
        //     }),
        //     // data: date,
        //     success:function(msg){
        //         if(msg == 'ok'){
        //             var dateSplit = date.split("-");
        //             $('#eventTitle').val('');
        //             alert('Event Created Successfully.');
        //             getCalendar('calendar_div',dateSplit[0],dateSplit[1]);
        //      }else{
        //             alert('Some problem occurred, please try again.');
        //         }
        //     },
        //     error: function(msg) {
        //         console.log(msg);
        //     }
        // });
    });
});

// jQuery(document).ready(function(){
//     $('.date_cell').mouseenter(function(){
//         date = $(this).attr('date');
//         $(".date_popup_wrap").fadeOut();
//         $("#date_popup_"+date).fadeIn();    
//     });
//     $('.date_cell').mouseleave(function(){
//         $(".date_popup_wrap").fadeOut();        
//     });
//     $('.month_dropdown').on('change',function(){
//         getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
//     });
//     $('.year_dropdown').on('change',function(){
//         getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
//     });
//     jQuery(document).click(function(){
//         $('#event_list').slideUp('slow');
//     });
// });