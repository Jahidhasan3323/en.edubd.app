<?php

namespace App\Http\Controllers;
//use App\CaSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\CaSubject;
use App\Rules\CaSubjectCheck;

class CaSubjectController extends Controller
{
    protected $subject;
    public function __construct(CaSubject $subject)
    {
        $this->middleware('auth');
        $this->subject=$subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = $this->subject::with('masterClass','groupClass')
                    ->where(['school_id'=>Auth::getSchool()])
                    ->groupBy(['master_class_id','group_class_id'])
                    ->selectRaw('master_class_id, group_class_id, count(id) as total_subject')->get();

        return view('backEnd.caSubjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $master_classes = $this->getClasses();
       $group_classes = $this->groupClasses();
       return view('backEnd.caSubjects.create', compact('group_classes','master_classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->subject_validation($request, NULL);
        try {
            $this->subject->create($request->all());
            return $this->returnWithSuccess('বিষয় সফলভাবে যোগ করা হয়েছে !');
        } catch (\Exception $e) {
            return $this->returnWithError('errmgs', 'দুঃখিত, বিষয় যোগ করা হয়নি !'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($master_class_id, $group_class_id)
    {
        $subjects = $this->subject::with('masterClass','groupClass')
                    ->where([
                        'school_id'=>Auth::getSchool(),
                        'master_class_id'=>$master_class_id,
                        'group_class_id'=>$group_class_id,
                    ])->get();
        return view('backEnd.caSubjects.show', compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $master_classes = $this->getClasses();
        $group_classes = $this->groupClasses();
        $subject = $this->subject::where(['school_id'=>Auth::getSchool(),'id'=>$id])->first();
        return view('backEnd.caSubjects.edit', compact('group_classes','master_classes','subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->subject_validation($request, $id);
        try {
            $this->subject->where([
                'id'=>$id,
                'id'=>Auth::getSchool(),
            ])->update($request->except('_token'));
            return $this->returnWithSuccess('বিষয় সফলভাবে আপডেট করা হয়েছে !');
        } catch (\Exception $e) {
            return $this->returnWithError('errmgs', 'দুঃখিত, বিষয় আপডেট করা হয়নি !'.$e->getMessage());
        }
    }


    protected function subject_validation($request, $id){
        $this->validate($request,[
            "subject_name"=>['required',new CaSubjectCheck($request->only('master_class_id','group_class_id'),$id)],
            "total_mark"=>'required|numeric',
            "pass_mark"=>'required|numeric',
            "master_class_id"=>'required',
            "group_class_id"=>'required',
            "year"=>'required'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try {
            $this->subject->where(['id'=>$id,'school_id'=>Auth::getSchool()])->forceDelete();
            return $this->returnWithSuccess('বিষয় সফলভাবে মুছে ফেলা হয়েছে ! !');
         } catch (\Exception $e) {
            return $this->returnWithError('errmgs', 'দুঃখিত, বিষয়  মুছে ফেলা হয়নি !'.$e->getMessage());
         }
    }
}
