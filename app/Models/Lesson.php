<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    
    protected $fillable = [
        'user_id',
        'test_id',
        'spent_time',
        'result',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name']);
    }

    public function test()
    {
        return $this->belongsTo(Test::class)->select(['id', 'question_number']);
    }

    public function category()
    {
        return $this->belongsToThrough(Category::class, Test::class);
    }

    public function activity()
    {
        return $this->hasOne(Activity::class, 'action_id');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'lesson_id');
    }
}
