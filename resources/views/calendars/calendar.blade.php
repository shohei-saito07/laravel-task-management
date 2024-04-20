<!DOCTYPE html>
<html>
<head>
    <title>FullCalendar in Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div style="width: 50%;margin: auto">
        <div id='calendar'></div>
    </div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true, // 日付選択を可能にする
            select: function(info) {
                debugger;
                let url = "{{ route('event.create') }}";
                window.location.href = url;
            },
            events: 'events' // イベントデータを取得するエンドポイント
        });

        calendar.render();
    });
</script>
</body>
</html>