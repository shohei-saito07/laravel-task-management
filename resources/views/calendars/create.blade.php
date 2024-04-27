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
     
     <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
               <label for="store-title">タイトル</label>
               <div>
                    <input type="text" name="title" id="store-title" value="{{ old('title') }}" class="form-control">
               </div>
          </div>
          <div class="form-group">
               <label for="store-start_date_time">開始日</label>
               <div class="col-sm-10">
                    <input type="date" id="start_date_time" name="start_date_time" value="{{ old('start_date_time') }}" class="form-control w-25">
               </div>
          </div>
          <button type="submit" class="btn btn-success">登録</button>
     </form>

     <a href="#" onclick="history.back()">カレンダーに戻る</a>
     </div>
</body>
</html>