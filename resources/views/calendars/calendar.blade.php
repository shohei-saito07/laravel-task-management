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
        document.addEventListener('DOMContentLoaded', function () 
        {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // 土日の設定
                events: 'events', // タスクを取得
                selectable: true, // カレンダー選択可否
                // タスクの作成
                select: function(info) {
                    let url = "{{ route('event.create') }}";
                    window.location.href = url;
                },
                // タスクの編集
                eventClick: function(info) {
                    let eventId = info.event.id;
                    let url = "{{ route('event.edit', ':id') }}".replace(':id', eventId);
                    window.location.href = url;
                },
            });
            calendar.render();
        });
    </script>
</body>
</html>
