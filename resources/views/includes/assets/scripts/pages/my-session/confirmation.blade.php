<script>
$(document).ready(function(){

    // Set the date we're counting down to
    var countDownDate = new Date('{{ date("M d, y H:i:s", strtotime($mySessionsBooking->belongsToAppointment->belongsToMySessionDate->date.' '.$mySessionsBooking->belongsToAppointment->start_time)) }}').getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var days_attr = days == 0 ? null : ' يوم ';
        var hours_attr = hours == 0 ? null : ' ساعة ';
        var minutes_attr = minutes == 0 ? null : ' دقيقة ';

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + days_attr + hours + hours_attr + minutes + minutes_attr + seconds + " ثانية حتي ميعاد الجلسة.";

        // If the count down is finished, write some text
        if (distance < 0) 
        {
            document.getElementById("demo").innerHTML = "انتهت المهلة";

            clearInterval(x);
            
            window.location.replace("{{ $mySessionsBooking->belongsToAppointment->link }}");
        }

    }, 1000);
});
</script>