document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");

  // Initialize FullCalendar
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    selectable: true,
    editable: true,
    events: [
      // Add sample events for the different churches
      {
        title: "Sta. Ana - 6:00 AM Mass",
        start: "2024-10-24T06:00:00",
        color: "#007bff", // Blue for Sta. Ana
      },
      {
        title: "San Luis - 8:00 AM Mass",
        start: "2024-10-25T08:00:00",
        color: "#28a745", // Green for San Luis
      },
      {
        title: "Candaba - 10:00 AM Mass",
        start: "2024-10-26T10:00:00",
        color: "#dc3545", // Red for Candaba
      },
      {
        title: "Arayat - 7:00 AM Mass",
        start: "2024-10-27T07:00:00",
        color: "#ffc107", // Yellow for Arayat
      },
      {
        title: "Sta. Monica - 9:00 AM Mass",
        start: "2024-10-28T09:00:00",
        color: "#6f42c1", // Purple for Sta. Monica
      },
    ],
    dateClick: function (info) {
      // Show modal to add event
      $("#scheduleModal").modal("show");
      $("#scheduleDate").val(info.dateStr);
    },
    eventClick: function (info) {
      // Show modal to edit event
      alert("Event: " + info.event.title);
      // Add additional logic for editing or deleting the event
    },
  });

  calendar.render();
});

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");

  // Initialize FullCalendar
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    selectable: true,
    editable: true,
    events: [
      // Add sample events for the different churches
      {
        title: "Sta. Ana - 6:00 AM Mass",
        start: "2024-10-24T06:00:00",
        color: "#007bff", // Blue for Sta. Ana
      },
      {
        title: "San Luis - 8:00 AM Mass",
        start: "2024-10-25T08:00:00",
        color: "#28a745", // Green for San Luis
      },
      {
        title: "Candaba - 10:00 AM Mass",
        start: "2024-10-26T10:00:00",
        color: "#dc3545", // Red for Candaba
      },
      {
        title: "Arayat - 7:00 AM Mass",
        start: "2024-10-27T07:00:00",
        color: "#ffc107", // Yellow for Arayat
      },
      {
        title: "Sta. Monica - 9:00 AM Mass",
        start: "2024-10-28T09:00:00",
        color: "#6f42c1", // Purple for Sta. Monica
      },
    ],
    dateClick: function (info) {
      // Show modal to add event
      $("#scheduleModal").modal("show");
      $("#scheduleDate").val(info.dateStr);
    },
    eventClick: function (info) {
      // Show modal to edit event
      alert("Event: " + info.event.title);
      // Add additional logic for editing or deleting the event
    },
  });

  calendar.render();
});
