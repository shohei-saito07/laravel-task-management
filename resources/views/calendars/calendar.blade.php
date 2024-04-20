<!DOCTYPE html>
<html>
<head>
    <title>FullCalendar in Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* 親要素をflexコンテナに設定 */
        .container {
            display: flex;
        }

        /* 左側のパネルのスタイル */
        #side-panel {
            width: 0; /* 初期は非表示 */
            overflow: hidden; /* 非表示時には内容が見えないようにする */
            transition: width 0.3s ease; /* アニメーションを追加 */
            padding: 20px;
            background-color: #f0f0f0;
        }

        /* カレンダーのスタイル */
        #calendar {
            flex: 1; /* 残りのスペースをカレンダーが占有 */
            min-width: 70%; /* 最小幅を設定 */
            width: calc(100% - 30%); /* パネルの幅を引いた幅を設定 */
        }
    </style>
</head>
<body>
    <!-- 親要素のflexコンテナ -->
    <div class="container">
        <!-- 左側のパネル -->
        <div id="side-panel">
            <!-- ここに左側のコンテンツを追加 -->
            <h2>左側のパネル</h2>
            <p>ここに追加したいコンテンツを配置します。</p>
        </div>

        <!-- カレンダー -->
        <div id="calendar"></div>
    </div>

    <!-- ボタン -->
    <button onclick="toggleSidePanel()">左側のパネルを表示する</button>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
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

        // 左側のパネルを表示/非表示する関数
        function toggleSidePanel() {
            var sidePanel = document.getElementById('side-panel');
            if (sidePanel.style.width === '0px') {
                sidePanel.style.width = '30%';
                document.getElementById('calendar').style.width = 'calc(100% - 30%)';
            } else {
                sidePanel.style.width = '0px';
                document.getElementById('calendar').style.width = '100%';
            }
        }
    </script>
</body>
</html>
