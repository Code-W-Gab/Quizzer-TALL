<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'folder_id',
        'type',
        'question_text'
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
