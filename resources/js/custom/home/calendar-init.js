//

document.addEventListener('DOMContentLoaded', function() {
// <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FNew_York&bgcolor=%230B8043&showPrint=0&src=ampsY2xlYW5zZXJ2aWNlc0BnbWFpbC5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uY2hyaXN0aWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4udXNhI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23EF6C00&color=%2333B679&color=%230B8043&color=%230B8043&color=%230B8043" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>

    var calendarEl = document.getElementById('cal-view');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        googleCalendarApiKey: 'AIzaSyDPMFK5rxexkPU_uR4TYpq4Ly6dAzJenrU',
        events: {
            googleCalendarId: 'jjlcleanservices@gmail.com',
        },
        initialView: 'listWeek',
        headerToolbar: {
            "left": "prev,next today",
            "center": "title",
            "right": "listWeek,dayGridDay,dayGridWeek,dayGridMonth"
        },
        eventSourceSuccess: function(content, response) {
            console.log(content)
        }
    });
    calendar.render();
});