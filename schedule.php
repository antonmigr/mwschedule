<?php

$databasehost = "localhost:3306";
$databasename = "test";
$databaseusername ="root";
$databasepassword = "";


$con = mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
mysql_select_db($databasename) or die(mysql_error());
mysql_query("SET CHARACTER SET utf8");


$toadd = isset($_POST["toadd"]);
$todelete=isset($_POST["todelete"]);

if($toadd=="true"){
	
    $toAddArray=explode("|",$_POST["toadd"]);
    $query = "SELECT name,latitude,longitude,address from stores;";
	
    for($i=0;$i<sizeof($toAddArray);$i++){
		
        $toinsert=explode($toAddArray[i]);
		echo ' fd';
        mysql_query("INSERT INTO SCHEDULE VALUES(" . $toinsert[0] . "," . $toinsert[1] . "," . $toinsert[2] . ", \"patient\");");

       }
}

if($todelete=="true"){
	
        $toDeleteArray=explode("|",$_POST["todelete"]);

		for($i=0;$i<sizeof($toDeleteArray);$i++){
			$toinsert=explode($toAddArray[i]);
			mysql_query("DELETE FROM SCHEDULE WHERE START=" . $toDeleteArray[i] . ";" );

       }
}

?>







<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='registerbutton.css' rel='stylesheet' />
<link href='fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js' type="text/javascript"></script>
<script src='lib/jquery.min.js' type="text/javascript"></script>
<script src='lib/jquery-ui.custom.min.js' type="text/javascript"></script>
<script src='fullcalendar.js' type="text/javascript"></script>
<script src='require.js' type="text/javascript"></script>
<script type="text/javascript">

    var alreadySelected = false;
    var lastEvent = null;
	var theID=4;
	//eventsArray = array of starts of events
	 var eventsArray=[];
	 var endsArray=[];
	 function checkForOverlap(start,end){

		var oldend=moment(end.toISOString());

		var currentstart=moment(start).subtract(4,'hours').toISOString();
		var currentend=moment(end).subtract(4,'hours').toISOString();
		var tempend=oldend.subtract(4,'hours').subtract(30,'minutes').toISOString();
		oldend=moment(end.toISOString());
		var tempendtwo=oldend.subtract(4,'hours').subtract(60,'minutes').toISOString();
		var alertedOnce=false;
		for(i in eventsArray){

			var oneOfEvents=moment(eventsArray[i]);
			var tocompare=oneOfEvents.subtract(4,'hours').toISOString();
			//tocompare is the current event's start
			var oneOfEventEnds=moment(endsArray[i]).subtract(4,'hours').toISOString();

			var arElemStart=tocompare;
			var arElemEnd=oneOfEventEnds;
			
			//tocompare=one of array elements starts. oneOfEventsEnds=one of array elemenets ends. currentstart=current event's start.  currentend=current event's end
			if(( moment(arElemEnd).format('dddd')==moment(currentend).format('dddd') && moment(arElemStart).format('dddd')==moment(currentstart).format('dddd')  ) 
			&& ( (moment(currentstart).add(4,'hours').toISOString()>=arElemStart && arElemEnd>=moment(currentend).add(4,'hours').toISOString() )
			||   (moment(currentstart).add(4,'hours').toISOString()<arElemEnd && arElemEnd<moment(currentend).add(4,'hours').toISOString() ) )){
				
				return true;
			}

			if(tocompare==tempend || tocompare==tempendtwo){
				
				return true;
			}

		}
	 }


	 
 <?php
                $query = "SELECT Start,End,Description,Type FROM SCHEDULE;";
		        $results = mysql_query($query);			
		        $row=array();

		        while($row=mysql_fetch_assoc($results)){

					if($row["Type"]=="patient"){
						echo 'eventsArray[eventsArray.length]=moment(\'' . $row["Start"] . '\').toISOString();';
						echo 'endsArray[endsArray.length]= moment(\'' . $row["End"] . '\').toISOString();';
					}else{
						echo 'eventsArray[eventsArray.length]=moment(\'' . $row["Start"] . '\').toISOString();';
						echo 'endsArray[endsArray.length]=moment(\'' . $row["End"] . '\').toISOString();';
					}
		        }
                

		     
?>


	function getClientEvents(){
	}

    function populateApptInfo() {      
		var startDates = [];

        var firstname = getCookie("input_firstname");
        var lastname = getCookie("input_lastname");
        var email = getCookie("input_email");
        var phone = getCookie("input_phone");
        document.getElementById("firstname").value = firstname;
        document.getElementById("lastname").value = lastname;
        document.getElementById("phone").value = phone;
        document.getElementById("email").value = email;
        document.getElementById("apptime").value = lastEvent.start.toISOString();
        document.getElementById("endtime").value = lastEvent.end.toISOString();
		
        var mom = moment(lastEvent.start.toISOString());

        $to="antonmigr@gmail.com";
        $subject="test";
        $message="testing";
        $header="From: antonmigr@gmail.com";
        mail($to,$subject,$message,$header);
		
        return true;
    }
    </script>

<link href="css/reset.css" type="text/css" rel="stylesheet">
<link href="css/styles.css" type="text/css" rel="stylesheet">
<script type="text/javascript">

    var eventId = 1;
    var dateRightNow = new Date();
    var currentTime = null;
    
    function setCookie(cname, cvalue) {
		
        document.cookie = document.cookie + cname + "=" + cvalue + ";";
    }

    function getCookie(cname) {
		
        var name = cname + "=";
        var ca = document.cookie.split(':');
		
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
        }
		
        return "";
    }

    function checkCookie() {
		
        var user = getCookie("username");
		
        if (user != "") {
            alert("Welcome again " + user);
        } else {
            user = prompt("Please enter your name:", "");
			
            if (user != "" && user != null) {
                setCookie("username", user, 365);
            }
        }
    }

    function isOverlapping(event){
    var array = calendar.fullCalendar('clientEvents');
	
    for(i in array){
		
        if(array[i].id != event.id){
            if(!( /*(Date(event.start)>=Date(array[i].end) && Date(event.end)<=Date(array[i].end)) ||*/ Date(array[i].start) >= Date(event.end) || Date(array[i].end) <= Date(event.start))){
                return true;
            }
        }
    }
	
    return false;
}

    function populateForm() {        
    }

    function mouseDown() {
		
        dateRightNow = new Date();
        currentTime = dateRightNow.getMilliseconds();
        document.getElementById('tt').innerHTML = currentTime;
    }
	
    function cancelEvent() {
		
        document.getElementById('apptInfo').innerHTML="<p id=\"p_serving\">Please choose the time that works best for you.  Grey areas indicate times that are unavailable.</p>";
        alreadySelected = false;
        $('#calendar').fullCalendar('removeEvents', 1); clearSelection();
    }
	
	
    $(document).ready(function () {
		
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
			//USE THIS FOR AUTOMATIC DATE UPDATES
            defaultDate: ''+ moment(new Date()).format('YYYY-MM-DD')+'',
            selectable: true,
            selectHelper: true,
            defaultEventMinutes: 60,
            defaultView: 'agendaWeek',

            eventClick: function (event, jsEvent, view) {

            },
            slotEventOverlap: false,
            eventMouseover: function (event, jsEvent, view) {

            },

            select: function (start, end) {
                if (alreadySelected == false) {
                    lastEvent = {
                        start: start,
						end: end
                    };
					if(!(checkForOverlap(start,end)==true)){
						rightNow=new Date();
						  if (!((start.month() == rightNow.getMonth()) && ((start.date() - rightNow.getDate()) < 0)) || (start.month() < rightNow.getMonth())) {
							//alert('earlier2!');
							document.getElementById('apptInfo').innerHTML = "<p id=\"p_serving\">Schedule an appointment for " + start.toISOString().slice(11, 16) + " o'clock on "+moment(start.toISOString()).format('LL')+// + (start.month()+1) +
							"? Your appointment will last about an hour, but could take longer.</p> " + "<br>"+ 
							"<div style=\"text-align:center\"><br>" +
							"<form name=\"input\"  onsubmit=\"populateApptInfo()\" action=\"thankyou.php\" method=\"post\">" +
							"<input type=\"hidden\" name=\"firstname\" id=\"firstname\" value=\"\">" +
							"<input type=\"hidden\" name=\"lastname\" id=\"lastname\" value=\"\">" +
							"<input type=\"hidden\" name=\"email\" id=\"email\" value=\"\">" +
							"<input type=\"hidden\" name=\"phone\" id=\"phone\" value=\"\">" +
							"<input type=\"hidden\" name=\"apptime\" id=\"apptime\" value=\"\">" +
							"<input type=\"hidden\" name=\"endtime\" id=\"endtime\" value=\"\">" +
							  "<input type=\"submit\" value=\"Proceed\">" + "<span style=\"width=20px\">  </span>" +
					
							"<input type=\"button\" value=\"Cancel\"  onclick=\"cancelEvent()\"></button></form></div></p>";
						}
					}
                }
                //populateForm();

                var rightNow = new Date();
                var title = ' ';
				

				if(checkForOverlap(start,end)==true){alert('Please don\'t set up a time that overlaps with another time slot.');title = null;}
						


                if (((start.month() == rightNow.getMonth()) && ((start.date() - rightNow.getDate()) < 0)) || (start.month() < rightNow.getMonth())) {
					alert('Please select a valid time slot.');
                    title = null;
                }

                if (alreadySelected == true) {
                    
                    title = null;
                }

                var eventData;
                if (title) {
                    eventData = {
                        id: eventId,
                        backgroundColor: '#SomeColor',
                        title: title,
                        start: start,
                        end: end//.add(30,'minutes'),  

                    };
 
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    alreadySelected = true;
                }
                $('#calendar').fullCalendar('unselect');
            },

            editable: true,
            events: [
				{
				    title: '',
				    start: '2014-06-01'
				},
				{
				    title: '',
				    start: '2014-06-07',
				    end: '2014-06-10'
				},
				{
				    id: 999,
				    title: '',
				    start: '2014-06-09T16:00:00'
				},
				{
				    id: 999,
				    title: '',
				    start: '2014-06-16T16:00:00'
				},
     
	 
				<?php
				
                $query = "SELECT Start,End,Description,Type FROM SCHEDULE;";
		        $results = mysql_query($query);			
		        $row=array();

		        while($row=mysql_fetch_assoc($results)){
					
					if($row["Type"]=="patient"){
						echo '{
						id:theID++,';					
						echo 'start: moment(\''. $row["Start"] . '\').subtract(4,\'hours\').toISOString(),';
						echo 'end: moment(\''. $row["End"] . '\').subtract(4,\'hours\').toISOString(),';					
						echo 'backgroundColor:\'#C8C8C8 \'';		     
						echo '},';
					
					}else{
						echo '{
						id:theID++,';				
						echo 'start: moment(\''. $row["Start"] . '\').subtract(4,\'hours\').toISOString(),';
						echo 'end: moment(\''. $row["End"] . '\').subtract(4,\'hours\').toISOString(),';
						echo 'backgroundColor:\'#C8C8C8 \'';		     
						echo '},';
					}
		       }                

		        mysql_close($con);				
                ?>


				{
				    title: '',
				    start: '2014-07-09T10:30:00',
				    end: '2014-07-09T12:30:00'
				},


            ],
            eventColor: '#d3d3d3'
        }); 
			
			 
		    var eventsArray =  $('#calendar').fullCalendar('clientEvents');
			var eventsArrayTwo =  $('#calendar').fullCalendar('clientEvents');

			
			//take care of combining adjecent events
			for(i in eventsArray){
			

				var currentEvent=eventsArray[i];
			//	alert(currentEvent.end+' '+eventsArray[i].start);
				 for(j in eventsArrayTwo){
				 	
					if(
					
					//(
					moment(currentEvent.end).toISOString()==moment(eventsArrayTwo[j].start).toISOString()
					
					&& moment(currentEvent.end).format('dddd')==moment(eventsArrayTwo[j].start).format('dddd') 
					
					){
						currentEvent.end=eventsArrayTwo[j].end
					//alert(eventsArrayTwo[j].id+' '+moment(eventsArrayTwo[j].start).toISOString());
						$('#calendar').fullCalendar('updateEvent',currentEvent);
						$('#calendar').fullCalendar('removeEvents',eventsArrayTwo[j].id);
						$('#calendar').fullCalendar('refresh');
					}
				 }
				// $('#calendar').fullCalendar('updateEvent',eventsArray[i]);
			
			}
			
			//take care of overlapping events upon load, after the 30 min add-subtract transformaiton			
			for(i in eventsArray){
				
				var currentEvent=eventsArray[i];
				if(moment(currentEvent.start).format('dddd')=="Monday" || moment(currentEvent.start).format('dddd')=="Monday" ){
				}
				
				for(j in eventsArrayTwo){
				
					if(moment(currentEvent.start).format('dddd')==moment(eventsArrayTwo[j].start).format('dddd') && currentEvent.start!=eventsArrayTwo[j].start && currentEvent.end!=eventsArrayTwo[j].end){
						if(currentEvent.start<=eventsArrayTwo[j].start && currentEvent.end>=eventsArrayTwo[j].end){

							$('#calendar').fullCalendar('removeEvents',eventsArrayTwo[j].id);
							$('#calendar').fullCalendar('refresh');
							
						}else if(currentEvent.start>eventsArrayTwo[j].start && currentEvent.start<eventsArrayTwo[j].end){
							
							//overlapping events, not one inside another like rpeviously
							currentEvent.start=eventsArrayTwo[j].end;
							$('#calendar').fullCalendar('updateEvent',currentEvent.id);
							$('#calendar').fullCalendar('refresh');
						}
					}
				}
			}

			
    }); //doc.ready()

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

    <div id="clickReg" onclick="promptit()">
	
   
    <div id="fixed_stripe">
				<header id="fixed_stripe_center">
						<a id="a_logo" href="#"><img src="img/logo.png"></a>
						<menu id="menu">
								<ul>
									<li><a href="index.html" id="a_about">about</a></li>
									<li><a href="services.html" id="a_services">services</a></li>
									<li><a href="massage.html" id="a_massage">wellness massage</a></li>
									<li><a href="reference.html" id="a1">reference</a></li>
									<li><a href="contacts.html" id="a_contacts">contacts</a></li>
								</ul>
						</menu>						
				</header>
		</div>
	
		<div id="empty_stripe"></div>
               
				<div id="contacts">
                     <h1>Book your appointment.</h1>
                    <div id='calendar' style="width:700px"></div>
                    <div id="apptInfo"><p id="p_serving">Please choose the time that works best for you.  Grey areas indicate times that are unavailable.</p></div>
                    <p id="p_serving">
                    
                   <!-- <div id='calendar'></div>-->
		
					<br><br>
					
				
					<div class="clear"></div>
					<div id="footer_stripe"></div>
					<a id="a_amta_logo" href="http://www.amtamassage.org/index.html"><img id="img_amta_logo" src="img/amta_logo.png"></a>
					
				</div>

</body>
</html>
