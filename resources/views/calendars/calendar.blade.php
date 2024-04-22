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
            var calendar = new FullCalendar.Calendar(calendarEl, 
            {
                initialView: 'dayGridMonth',
                locale: 'ja', // カレンダーに表示する文字の言語選択
                selectable: true, // 日付選択を可能にする
                select: function(info) {
                    let url = "{{ route('event.create') }}";
                    window.location.href = url;
                },
                // タスクの編集をする
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';
                    debugger;
                    // 予定編集画面へ遷移
                    let eventId = info.event.id;
                    let url = "{{ route('event.edit', ':id') }}".replace(':id', eventId);
                    window.location.href = url;
                },
                events: 'events' // イベントデータを取得するエンドポイント
            });
            calendar.render();
        });
    </script>
</body>
</html>
