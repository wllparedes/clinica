import { Calendar } from "@fullcalendar/core/index.js";
import DayGridPlugin from "@fullcalendar/daygrid";
import tippy from "tippy.js";

window.initCalendar = function (events, route) {
    let calendarEl = document.getElementById("calendar");
    let calendar = new Calendar(calendarEl, {
        plugins: [DayGridPlugin],
        locale: "es",
        timeZone: "local",
        initialView: "dayGridMonth",
        events: events,
        eventDidMount: function (info) {
            tippy(info.el, {
                content: info.event.extendedProps.description,
                allowHTML: true,
                theme: "light",
            });
        },
        eventClick: function (info) {
            window.location.href = route + info.event.id;
        },
        buttonText: {
            today: "Hoy",
        },
    });
    calendar.render();
};
