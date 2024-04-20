<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;

class EventController extends Controller
{
    public function index()
    {

          $calendars = Calendar::all();

          $events = [];
          // $events = [[test]];

          foreach($calendars as $calendar)
          {
               array_push($events, [
                    'title' => $calendar->title,
                    'start' => date('Y-m-d', strtotime($calendar->start_date_time))
                ]);
          }

        return response()->json($events);
    }

    public function create() 
    {
        // 予定作成画面へ遷移
        return view('calendars.create');
    }

    public function store(Request $request) 
    {
        // 予定追加処理
        // バリデーションのチェック
        $request->validate([
            'title' => 'required',
            'start_date_time' => 'required'
        ]);

        $calendar = new Calendar();
        $calendar->title = $request->input('title');
        $calendar->start_date_time = $request->input('start_date_time');
        $calendar->save();

        return redirect('/calendar'); 
    }

    public function home()
    {
        

        // カレンダーホーム画面へ遷移
        return redirect('/calendar'); 
    }
}