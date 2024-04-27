<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    // カレンダーTOP画面へ遷移
    public function index()
    {
        $calendars = Calendar::all();
        $events = [];

        foreach($calendars as $calendar)
        {
            array_push($events, [
                'title' => $calendar->title,
                'start' => date('Y-m-d', strtotime($calendar->start_date_time)),
                'id' => $calendar->id
            ]);
        }

        return response()->json($events);
    }

    public function create() 
    {
        // タスク作成画面へ遷移
        return view('calendars.create');
    }

    // タスク登録処理
    public function store(Request $request) 
    {
        // バリデーションのチェック
        $request->validate([
            'title' => 'required|max:20',
            'start_date_time' => 'required'
        ]);

        $calendar = new Calendar();
        $calendar->title = $request->input('title');
        $calendar->start_date_time = $request->input('start_date_time');
        $calendar->save();

        return redirect('/calendar'); 
    }

    public function edit($id) 
    {
        // 予定のIDを元に、該当する予定を取得し、編集画面に渡す処理を行う
        $calendar = Calendar::findOrFail($id);

        Log::error($calendar);
        // 編集画面へ遷移
        return view('calendars.edit', compact('calendar'));
    }

    // タスク更新処理
    public function update(Request $request, Calendar $calendar) 
    {
        // バリデーションのチェック
        $request->validate([
            'title' => 'required|max:20',
            'start_date_time' => 'required'
        ]);

        $calendar->title = $request->input('title');
        $calendar->start_date_time = $request->input('start_date_time');
        $calendar->update();

        return redirect('/calendar'); 
    }

    // タスク削除処理
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();

        return redirect('/calendar'); 
    }
    
    // 【TODO】ホーム画面を追加予定
    // public function home()
    // {
    //     // カレンダーホーム画面へ遷移
    //     return redirect('/calendar'); 
    // }
}