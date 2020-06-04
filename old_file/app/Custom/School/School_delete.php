<?php
 namespace App\Custom\School;

 use App\School;
 use App\User;
 use App\AttenEmployee;
 use App\AttenStudent;
 use App\Subject;
 use App\SubjectTeacher;
 use App\Unit;
 use App\Http\Controllers\Controller;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Arr;
 use Storage;

 class school_delete extends Controller
 {
   protected $school_id;
   protected $school;
   protected $egger_data=[
      'student',
      'staff',
      'commitees',
      'absent_content',
      'class_routines',
      'exam_routines',
      'holidays',
      'notices',
      'results',
      'user',
      'important_setting'
   ];

   public function __construct($school_id)
   {
         $this->school_id=$school_id;
         $this->school=School::with($this->egger_data)->where('id',$school_id)->first();
   }


   public function users(){
      $user_id1=$this->school->student->pluck('user_id')->toArray();
      $user_id2=$this->school->staff->pluck('user_id')->toArray();
      $user_id3=$this->school->commitees->pluck('user_id')->toArray();
      $user_id4=[];
      array_push($user_id4, $this->school->user_id);
      $user_id=array_merge($user_id1,$user_id2,$user_id3,$user_id4);
      User::whereIn('id',$user_id)->delete();
      return $this;
   }

   public function atten_employees(){
      AttenEmployee::where('school_id',$this->school_id)->forceDelete();
      return $this;

   }

   public function atten_students(){
      AttenStudent::where('school_id',$this->school_id)->forceDelete();
      return $this;

   }

   

   public function subjects(){
      Subject::where('school_id',$this->school_id)->forceDelete();
      return $this;

   }

   public function subject_teachers(){
      SubjectTeacher::where('school_id',$this->school_id)->delete();
      return $this;
   }

   public function units(){
      Unit::where('school_id',$this->school_id)->forceDelete();
      return $this;

   }

   public function destroy(){
      foreach ($this->school->student as $st) {
         if(file_exists(public_path(Storage::url($st->photo))))
            Storage::delete($st->photo);
         if(file_exists(public_path(Storage::url($st->f_photo))))
            Storage::delete($st->f_photo);
         if(file_exists(public_path(Storage::url($st->m_photo))))
            Storage::delete($st->m_photo);
      }
      foreach ($this->school->staff as $staff) {
         if(file_exists(public_path(Storage::url($staff->photo))))
           Storage::delete($staff->photo);
      }
      foreach ($this->school->commitees as $commitee) {
         if(file_exists(public_path(Storage::url($commitee->image))))
            Storage::delete($commitee->image);
      }

      foreach ($this->school->class_routines as $class_routine) {
         if(file_exists(public_path(Storage::url($class_routine->path))))
            Storage::delete($class_routine->path);
      }

      foreach ($this->school->exam_routines as $exam_routine) {
         if(file_exists(public_path(Storage::url($exam_routine->path))))
            Storage::delete($exam_routine->path);
      }

      foreach ($this->school->notices as $notice) {
         if(file_exists(public_path(Storage::url($commitee->image))))
            Storage::delete($commitee->image);
      }

      if(file_exists(public_path(Storage::url($this->school->logo))))
         Storage::delete($this->school->logo);
      
      if(file_exists(public_path(Storage::url($this->school->signature_p))))
         Storage::delete($this->school->signature_p);

      $this->school->delete();
      return $this;
   }

 }