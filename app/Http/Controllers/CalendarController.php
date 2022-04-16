<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $data = Interview::all();

        $interview_array = [];

        foreach ($data as $interview) {
            $data_formatted = (object) [
                'title' => $interview->event_name,
                'start' => $interview->event_start,
                'end' => $interview->event_end
            ];
            array_push($interview_array, $data_formatted);
        }

        return view('calendar', [
            "interviews_data" => json_encode($interview_array)
        ]);
    }

    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
            case 'create':
                $event = Interview::create([
                    'event_name' => $request->event_name,
                    'event_start' => $request->event_start,
                    'event_end' => $request->event_end,
                ]);

                return response()->json($event);
                break;

            case 'edit':
                $event = Interview::find($request->id)->update([
                    'event_name' => $request->event_name,
                    'event_start' => $request->event_start,
                    'event_end' => $request->event_end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Interview::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                break;
        }
    }
}
