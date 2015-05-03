<?php
error_reporting(0);
$databasehost = "localhost:3306";
$databasename = "test";
$databaseusername ="root";
$databasepassword = "";


$con = mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
mysql_select_db($databasename) or die(mysql_error());
#mysql_query("SET CHARACTER SET utf8;");

    
	
$toadd = isset($_POST["toadd"]);
$todelete=isset($_POST["toremove"]);

if($toadd=="true"){
	
    $toAddArray=explode("|",$_POST["toadd"]);
    $query = "SELECT name,latitude,longitude,address from stores;";
	
    for($i=0;$i<sizeof($toAddArray);$i++){
		
		$start=array();
		$start=explode("=",$toAddArray[$i]);
        $toinsert=explode("_",$start[1]);		
         mysql_query("INSERT INTO SCHEDULE VALUES(\"" . $start[0] . "\",\"" . $toinsert[0] . "\",\"" . $toinsert[1] . "\",\"" . $toinsert[2] . "\");");

       }
}
if($todelete=="true"){
        $toDeleteArray=explode("|",$_POST["toremove"]);
		
		for($i=0;$i<sizeof($toDeleteArray)-1;$i++){
	
			$startTime=explode("=",$toDeleteArray[$i]);
			 $delQuery = "DELETE FROM SCHEDULE WHERE START='" . $startTime[0] . "';";
			
			 mysql_query($delQuery );
		
       }
}


?>
         
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href="registerbutton.css" type="text/css" rel="stylesheet">
<link href='fullcalendaradmin.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='lib/jquery-ui.custom.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script>

    var oneCanceled = "false";
    var lastEvent = null;
    var timeId;
    var theID = 1;

    var toadd = "";
    var toremove = "";
    function addToNew(cname, cvalue) {
		
       toadd = toadd + cname + "=" + cvalue + "|";     
    }

    function getFromNew(cname) {
		
        var name = cname + "=";
        var ca = document.cookie.split(':');
		
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
        }
		
        return "";
    }

    function addToRemove(cname, cvalue) {
		
        toremove = toremove + cname + "=" + cvalue + "|";      
    }

    function getFromRemove(cname) {
		
        var name = cname + "=";
        var ca = document.cookie.split(':');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
        }
        return "";
    }

    function finalize() {
		
        document.getElementById("toadd").value = toadd;
        document.getElementById("toremove").value = toremove;
    }

    function undo() {		
	
        if (oneCanceled=="false") {
            $('#calendar').fullCalendar('renderEvent', lastEvent, true); // stick? = true
        }
		
        oneCanceled = "true";
    }
	
	$(document).ready(function() {

		$('#calendar').fullCalendar({
		    header: {
		        left: 'prev,next today',
		        center: 'title',
		        right: ''
		    },
			
		    eventStartEditable: false,
		    eventDurationEditable: false,
		    allDaySlot: false,
		    minTime: "08:00:00",
		    maxTime: "14:00:00",
		    defaultDate: ''+ moment(new Date()).format('YYYY-MM-DD')+'',
		    selectable: true,
		    selectHelper: true,
		    defaultEventMinutes: 60,
		    defaultView: 'agendaWeek',
		    dayClick: function (calEvent, jsEvent, view) {
		        prompt('clicked');

		    },
		    eventClick: function (event, jsEvent, view) {
				
				var deletebool=confirm("Do you really want to delete this slot?");
				if(deletebool==true){

		        //all are removed because ID is always 99!
		        //lastEvent = event;
		        lastEvent = {
		            id: event.id,
		            title: event.title,
		            start: event.start,
		            end: event.end

		        };
		      
		        oneCanceled = "false";
		        addToRemove(event.start.toISOString(), "one");

		        $('#calendar').fullCalendar('removeEvents', event.id);
		        //alreadySelected = true;
				} 
		    },

		    select: function (start, end) {
				
		        timeId;
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					
				    eventData = {
                        id: theID++,
						title: title,
						start: start,
						end: end
				    };
					
				    lastEvent = eventData;
				    oneCanceled = "true";
				    addToNew(eventData.start.toISOString(), eventData.end.toISOString() + "_" + eventData.title + "_other");
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}

				$('#calendar').fullCalendar('unselect');
			},
			editable: true,
			events: [
				{
					title: 'All Day Event',
					start: '2014-06-01'
				},
				{
					title: 'Long Event',
					start: '2014-06-07',
					end: '2014-06-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-06-16T16:00:00'
				},
				{
                    id: 765,
					title: 'Meeting',
					start: '2014-06-12T10:30:00',
					end: '2014-06-12T12:30:00'
				},
               <?php
			   
                $query = "SELECT Start,End,Description,Type FROM SCHEDULE;";
		        $results = mysql_query($query);			
		        $row=array();
			
		        while($row=mysql_fetch_assoc($results)){
					
					$desc = str_replace(" ",'\n',$row["Description"]);			    
			        echo '{
		            id:theID++,
		            title: \'' .  $desc  . '\',
		            start: \' ' . $row["Start"] . '\',
		            end: \' ' . $row["End"]  . '\',';
		            if($row["Type"]=="patient"){
						echo 'backgroundColor:\'green\'';
		            } else {
		            # echo 'backgroundColor: \'#D4B5B5\'';								            
                    }
					echo '},';
		       }
                

		        mysql_close($con);
                ?>


				{
				    id: 766,
					title: 'Lunch',
					start: '2014-06-12T12:00:00'
				},
				{
				    id: 767,
					title: 'Birthday Party',
					start: '2014-06-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-06-28'
				}
			]
		});
		/*ADMINSCHEDULE*/
		$("#calendar").width(1700);
		$("#calendar").fullCalendar("render");
	
	});

</script>
<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		width: 900px;
		margin: 40px auto;
	}

</style>
</head>
<body>
	<h1 align="center">Appointment Schedule Manager</h1>
	<div id='calendar'></div>
    <!--<input type="button" onclick="undo()" value="Undo" />-->
     <form name="input"  onsubmit="finalize()" action="adminschedule.php" method="post"> 
       <input type="hidden" name="toadd" id="toadd" value="">
       <input type="hidden" name="toremove" id="toremove" value="">
      <div align="center"><input type="submit" style="font-size: 35px;"  value="Save"></div>
     </form>
</body>
</html>
