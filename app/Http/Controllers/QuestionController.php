<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionOption;
use App\MasterClass;
use App\Student;
use App\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="নৈর্ব্যক্তিক";
        $questions=Question::with('masterClass','user','subject')->where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'type'=>1])->orderby('id','DESC')->groupby('subject_id')->get();
        return view('backEnd.question.mcq.index',compact('questions','tittle'));
    }
    public function subjectwiseQuestion($subject_id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="নৈর্ব্যক্তিক";
        $questions=Question::with('options','user')->where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'type'=>1,'subject_id'=>$subject_id])->orderby('id','DESC')->get();
        return view('backEnd.question.mcq.subjectwise_question',compact('questions','tittle'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $subjects=Subject::where('school_id',Auth::getSchool())->get();
        return view('backEnd.question.mcq.create',compact('classes','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $data=$request->except('option');
        
        $this->validate($request, [
            'question' => 'required',
            'mark' => 'required',
            'answer' => 'required',
            'master_class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $data['type']=1;

        if($imageFile = $request->file('file')){
           $image_file=$this->imagesProcessing1($imageFile,'question/',350,350);
           $data['file'] = $image_file;
        }
        $question=Question::create($data);
        if($request->option){
            $i=1;
            foreach ($request->option as $option) {
                if($option){
                    QuestionOption::insert(['option'=>$option,'serial'=>$i,'question_id'=>$question->id]);
                }

                $i++;
            }
        }
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $subjects=Subject::where('school_id',Auth::getSchool())->get();
        $question=Question::with('options','masterClass','user')->where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'id'=>$id])->orderby('id','DESC')->first();
        return view('backEnd.question.mcq.edit',compact('classes','question','subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $data=$request->except('_token','_method','option');
        
        $this->validate($request, [
            'question' => 'required',
            'mark' => 'required',
            'answer' => 'required',
            'master_class_id' => 'required',
            'subject_id' => 'required',
        ]);

        if($imageFile = $request->file('file')){
           $image_file=$this->imagesProcessing1($imageFile,'question/',350,350);
           $data['file'] = $image_file;
        }

        $question=Question::where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'id'=>$id])->update($data);
        if($request->option){
            QuestionOption::where(['question_id'=>$id])->delete();
            $i=1;
            foreach ($request->option as $option) {
                QuestionOption::insert(['option'=>$option,'serial'=>$i,'question_id'=>$id]);
                $i++;
            }
        }
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $question=Question::where(['id'=>$id,'school_id'=> Auth::getSchool(),'user_id'=>Auth::id()])->delete();
        
        return $this->returnWithSuccess('আপনার তথ্য মুছে ফেলা হয়েছে !');


    }

    

    public function indexWritten()
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="লিখিত";
        $questions=Question::with('masterClass','subject')->where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'type'=>2])->orderby('id','DESC')->groupby('subject_id')->get();
        return view('backEnd.question.written.index',compact('questions','tittle'));
    }
    public function subjectwiseWrittenQuestion($subject_id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="লিখিত";
        $questions=Question::with('options','user')->where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'type'=>2,'subject_id'=>$subject_id])->orderby('id','DESC')->get();
        return view('backEnd.question.written.subjectwise_question',compact('questions','tittle'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWritten()
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $subjects=Subject::where('school_id',Auth::getSchool())->get();
        return view('backEnd.question.written.create',compact('classes','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWritten(Request $request)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $data=$request->except('option');
        
        $this->validate($request, [
            'question' => 'required',
            'mark' => 'required',
            'master_class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $data['type']=2;

        if($imageFile = $request->file('file')){
           $image_file=$this->imagesProcessing1($imageFile,'question/',350,350);
           $data['file'] = $image_file;
        }

        $question=Question::create($data);
        
        
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function editWritten($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $type=Auth::schoolType();
        $school_type_ids=explode('|', $type);
        $classes = MasterClass::whereIn('school_type_id', $school_type_ids)->get();
        $question=Question::with('options','masterClass','user')->where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'id'=>$id])->orderby('id','DESC')->first();
        $subjects=Subject::where('school_id',Auth::getSchool())->get();
        return view('backEnd.question.written.edit',compact('classes','question','subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function updateWritten(Request $request, $id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $data=$request->except('_token','_method','option');
        
        $this->validate($request, [
            'question' => 'required',
            'mark' => 'required',
            'master_class_id' => 'required',
            'subject_id' => 'required',
        ]);

        if($imageFile = $request->file('file')){
           $image_file=$this->imagesProcessing1($imageFile,'question/',350,350);
           $data['file'] = $image_file;
        }

        $question=Question::where(['school_id'=> Auth::getSchool(),'user_id'=>Auth::id(),'id'=>$id])->update($data);
        
        return $this->returnWithSuccess('আপনার তথ্য সংরক্ষণ হয়েছে !');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroyWritten($id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $question=Question::where(['id'=>$id,'school_id'=> Auth::getSchool(),'user_id'=>Auth::id()])->delete();
        
        return $this->returnWithSuccess('আপনার তথ্য মুছে ফেলা হয়েছে !');


    }

    public function allMcqQuestion()
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="নৈর্ব্যক্তিক";
        $questions=Question::with('masterClass','subject')->where(['type'=>1])->orderby('id','DESC')->groupby('subject_id')->get();
        return view('backEnd.question.mcq.all_question',compact('questions','tittle'));
    }
    public function subjectwiseAllMcqQuestion($subject_id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="নৈর্ব্যক্তিক";
        $questions=Question::with('options','user','school')->where(['type'=>1,'subject_id'=>$subject_id])->orderby('id','DESC')->get();
        return view('backEnd.question.mcq.subjectwise_all_question',compact('questions','tittle'));
    }


    public function allWrittenQuestion()
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="লিখিত";
        $questions=Question::with('masterClass','subject')->where(['type'=>2])->orderby('id','DESC')->groupby('subject_id')->get();
        return view('backEnd.question.written.all_question',compact('questions','tittle'));
    }
    public function subjectwiseAllWrittenQuestion($subject_id)
    {
        if(!Auth::is('admin') && !Auth::is('teacher') && !Auth::is('student')){
            return redirect('/home');
        }
        $tittle="লিখিত";
        $questions=Question::with('options','user','school')->where(['type'=>2,'subject_id'=>$subject_id])->orderby('id','DESC')->get();
        return view('backEnd.question.written.subjectwise_all_question',compact('questions','tittle'));
    }



    public function mcqStudent()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $tittle="নৈর্ব্যক্তিক";
        $class=Student::where(['user_id'=>Auth::id()])->value('master_class_id');
        $questions=Question::with('options','masterClass','user')->where(['school_id'=> Auth::getSchool(),'type'=>1,'master_class_id'=>$class])->orderby('id','DESC')->get();
        return view('backEnd.question.student_question',compact('questions','tittle'));
    }

    public function writtenStudent()
    {
        if(!Auth::is('student')){
            return redirect('/home');
        }
        $tittle="লিখিত";
        $class=Student::where(['user_id'=>Auth::id()])->value('master_class_id');
        $questions=Question::with('options','masterClass','user')->where(['school_id'=> Auth::getSchool(),'type'=>2,'master_class_id'=>$class])->orderby('id','DESC')->get();
        return view('backEnd.question.student_question',compact('questions','tittle'));
    }
}
