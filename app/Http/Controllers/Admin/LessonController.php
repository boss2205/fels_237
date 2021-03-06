<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Activity;


class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('user', 'category')->get();

        return view('admin.lesson.index', compact('lessons'));
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'message' => trans('settings.error_message'),
            ]);
        }
        
        $activity = Activity::where('action_id', $request->id)->where('action_type', 'like', '%lesson%')->delete();
        $lesson = Lesson::where('id', $request->id)->delete();

        if (!$activity && !$lesson) {
            return response()->json([
                'message' => trans('settings.error_message'),
            ]);
        }

        return response()->json([
            'message' => trans('settings.success_message'),
        ]);
    }
}
