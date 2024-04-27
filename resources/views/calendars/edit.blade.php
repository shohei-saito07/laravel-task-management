<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
     <div class="container">
     <h1>予定</h1>

     <!-- エラーがある場合にエラー内容を表示 -->
     <ul>
          @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
          @endforeach
     </ul>

     <form action="{{ route('event.update', $calendar) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
               <label for="store-title">タイトル</label>
               <div>
                    <input type="text" name="title" id="store-title" value="{{ old('title', $calendar->title) }}" class="form-control">
               </div>
          </div>
          <div class="form-group">
               <label for="store-start_date_time">開始日</label>
               <div class="col-sm-10">
                    <input type="date" id="start_date_time" name="start_date_time" value="{{ old('start_date_time', substr($calendar->start_date_time, 0, 10)) }}" class="form-control w-25">
               </div>
          </div>
          <button type="submit" class="btn btn-success">更新</button>
     </form>
     <form action="{{ route('event.destroy', $calendar) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">削除</button>
    </form>
     <a href="{{ route('calendar.home') }}" onclick="#">カレンダーに戻る</a>
     </div>
</body>
</html>