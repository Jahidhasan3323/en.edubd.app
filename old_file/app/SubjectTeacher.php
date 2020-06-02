<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $table = 'subjects_teachers';
        protected $guarded = [];
        public function masterClass()
        {
        return $this->belongsTo(MasterClass::class);
        }

        public function staff()
        {
        return $this->belongsTo(Staff::class);
        }

        public function subject()
        {
        return $this->belongsTo(Subject::class,'subject_id');
        }

        public function groupClass()
        {
        return $this->belongsTo(GroupClass::class);
        }

}
