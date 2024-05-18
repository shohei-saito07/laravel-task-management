<!DOCTYPE html>
<html>
<head>
    <title>FullCalendar in Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div style="width: 50%;margin: auto">
        <div id='calendar'></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
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
                    debugger;
                    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {});
                    let dateTimeEl = document.getElementById('start_date_time');
                    dateTimeEl.value = info.startStr;

                    myModal.toggle();
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('event.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">タイトル:</label>
                            <input type="text" name="title" class="form-control" id="recipient-name">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div> -->
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">開始日:</label>
                            <input type="date" name="start_date_time" id="start_date_time" value="" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">登録</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</body>
</html>
