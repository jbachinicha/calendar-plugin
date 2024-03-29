<?php
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');



/*
 * Generate event calendar in HTML format
 */
function getCalender($year = '', $month = ''){
    $dateYear = ($year != '')?$year:date("Y");
    $dateMonth = ($month != '')?$month:date("m");
    $date = $dateYear.'-'.$dateMonth.'-01';
    $currentMonthFirstDay = date("N",strtotime($date));
    $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
    $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
    $boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
    <div class="calendar-wrap">
        <div class="cal-nav">
            <a id="beforeNav" href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&laquo;</a>
            <select class="month_dropdown"><?php echo getAllMonths($dateMonth); ?></select>
            <select class="year_dropdown"><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&raquo;</a>
        </div>
        <div id="event_list" class="none"></div>
        <!--For Add Event-->
        <div id="event_add" class="none addsection">
            <p>Add Event on <span id="eventDateView"></span></p>

            <input type="text" id="eventTitle" value="" placeholder="Event Title..." required/>
            <input type="text" id="eventFromTime" value="" placeholder="From..."required/>
            <input type="text" id="eventToTime" value="" placeholder="To..."required/>
            <textarea id="eventDescription" value="" placeholder="Description..."/></textarea>
            <input type="hidden" id="eventDate" value=""/>
            <input type="submit" id="addEventBtn" class="addBtn" value="Add"/>

          <button onclick="cancelEventBtn()" class="cancelBtn">Cancel</button>
        </div>
        <div class="calendar-days">
            <ul>
                <li>SUN</li>
                <li>MON</li>
                <li>TUE</li>
                <li>WED</li>
                <li>THU</li>
                <li>FRI</li>
                <li>SAT</li>
            </ul>
        </div>
        <div class="calendar-dates">
            <ul>
            <?php
                $dayCount = 1;
                for($cb=1;$cb<=$boxDisplay;$cb++){
                    if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
                        // Current date
                        $currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;

                        // Include the database config file
                        // include 'connect.php';
                        include( plugin_dir_path( __DIR__ ) . '\controller\connect.php' );

                        // Get number of events based on the current date
                        $result = $wpdb->get_results("SELECT title FROM $tableName WHERE date = '".$currentDate."' AND status = 1");
                        $eventNum = $wpdb->get_var("SELECT COUNT(*) FROM $tableName WHERE date = '".$currentDate."' AND status = 1");

                        // Define date cell color
                        if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
                            echo '<li date="'.$currentDate.'" class="grey date_cell">';
                        }elseif($eventNum > 0){
                            echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
                        }else{
                            echo '<li date="'.$currentDate.'" class="date_cell">';
                        }
                        // echo $eventNum;

                        if($result){

                            foreach ($result as $r){
                                echo $r->title;
                            }
                        } else {

                        }

                        // Date cell
                        echo '<span>';
                        echo $dayCount;
                        echo '</span>';

                        // Hover event popup
                        echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
                        echo '<div class="date_window">';
                        echo '<div class="popup_event">Events ('.$eventNum.')</div>';
                        echo ($eventNum > 0)?'<a href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">view events</a>':'';
                        //For Add Event
                        //if(is_user_logged_in()){
                          echo '<a href="javascript:;" onclick="addEvent(\''.$currentDate.'\');">Add Event</a>';
                        //}
                        echo '</div></div>';

                        echo '</li>';
                        $dayCount++;
            ?>
            <?php }else{ ?>
                <li><span>&nbsp;</span></li>
            <?php } } ?>
            </ul>
        </div>
    </div>

    <script>
        // function getCalendar(target_div, year, month){
        //     $.ajax({
        //         type:'POST',
        //         url:'/calendar.php',
        //         data:'func=getCalender&year='+year+'&month='+month,
        //         success:function(html){
        //             $('#'+target_div).html(html);
        //         }
        //     });
        // }

        // function getEvents(date){
        //     $.ajax({
        //         type:'POST',
        //         url:'calendar.php',
        //         data:'func=getEvents&date='+date,
        //         success:function(html){
        //             $('#event_list').html(html);
        //             $('#event_add').slideUp('slow');
        //             $('#event_list').slideDown('slow');
        //         }
        //     });
        // }

        // For Add Event
        function addEvent(date){
            $('#eventDate').val(date);
            $('#eventDateView').html(date);
            $('#event_list').slideUp('slow');
            $('#event_add').slideDown('slow');
        }
        function cancelEventBtn() {
          $('#event_add').slideUp('slow');
        }
        //For Add Event
        // jQuery(document).ready(function(){
        //     $('#addEventBtn').on('click',function(){
        //         var date = $('#eventDate').val();
        //         var title = $('#eventTitle').val();
        //         $.ajax({
        //             type:'POST',
        //             url:'../../controller/calendar.php',
        //             data:'func=addEvent&date='+date+'&title='+title,
        //             success:function(msg){
        //                 if(msg == 'ok'){
        //                     var dateSplit = date.split("-");
        //                     $('#eventTitle').val('');
        //                     alert('Event Created Successfully.');
        //                     getCalendar('calendar_div',dateSplit[0],dateSplit[1]);
        //              }else{
        //                     alert('Some problem occurred, please try again.');
        //                 }
        //             }
        //         });
        //     });
        // });

       jQuery(document).ready(function(){
            $('.date_cell').mouseenter(function(){
                date = $(this).attr('date');
                //$(".date_popup_wrap").fadeOut();
                $("#date_popup_"+date).css("display", "block");
            });
            $('.date_cell').mouseleave(function(){
                $(".date_popup_wrap").css("display", "none");
            });
            $('.month_dropdown').on('change',function(){
                getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
            });
            $('.year_dropdown').on('change',function(){
                getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
            });
            jQuery(document).click(function(){
                $('#event_list').slideUp('slow');
            });
        });
    </script>
<?php
}

/*
 * Generate months options list for select box
 */
function getAllMonths($selected = ''){
    $options = '';
    for($i=1;$i<=12;$i++)
    {
        $value = ($i < 10)?'0'.$i:$i;
        $selectedOpt = ($value == $selected)?'selected':'';
        $options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
    }
    return $options;
}

/*
 * Generate years options list for select box
 */
function getYearList($selected = ''){
    $options = '';
    for($i=2019;$i<=2025;$i++)
    {
        $selectedOpt = ($i == $selected)?'selected':'';
        $options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
    }
    return $options;
}

/*
 * Generate events list in HTML format
 */
function getEvents($date = ''){
    // Include the database config file
    // include_once 'connect.php';
    include_once( plugin_dir_path( __DIR__ ) . '\controller\connect.php' );


    $eventListHTML = '';
    $date = $date?$date:date("Y-m-d");

    // Fetch events based on the specific date
    $result = $wpdb->get_results("SELECT title FROM '.$tableName.' WHERE date = '".$date."' AND status = 1");
    if($result->num_rows > 0){
        $eventListHTML = '<h2>Events on '.date("l, d M Y",strtotime($date)).'</h2>';
        $eventListHTML .= '<ul>';
        while($row = $result->fetch_assoc()){
            $eventListHTML .= '<li>'.$row['title'].'</li>';
        }
        $eventListHTML .= '</ul>';
    }
    echo $eventListHTML;
}


/*
 * Add event to date
 */
function postEvent($date,$title){
    echo 'posting...';
    //Include db configuration file
    // include 'connect.php';
    include( plugin_dir_path( __DIR__ ) . '\controller\connect.php' );

    $currentDate = date("Y-m-d H:i:s");
    //Insert the event data into database
    $insert = $wpdb->get_results("INSERT INTO '.$tableName.' (title,date,created,modified) VALUES ('".$title."','".$date."','".$currentDate."','".$currentDate."')");
    if($insert){
        echo 'ok';
    }else{
        echo 'err';
    }
}
