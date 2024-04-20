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

     //    $events = [
     //        [
     //            'title' => 'イベント 1',
     //            'start' => '2024-04-11'
     //        ],
     //        [
     //            'title' => 'イベント 2',
     //            'start' => '2024-04-15'
     //        ]
     //    ];

        return response()->json($events);
    }
}