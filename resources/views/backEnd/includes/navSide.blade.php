<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu" style="">
            <li class="text-center" style="">
                <a href="
                    @if(Auth::is('admin'))
                    {{url('/schoolProfile')}}

                    @elseif(Auth::is('teacher'))
                    {{url('/teacherProfile')}}

                    @elseif(Auth::is('student'))
                    {{url('/studentProfile')}}
                    @else
                    {{url('/home')}}
                    @endif
                    "><img style="max-width: 100%; " src="{{Storage::url($photo)}}" class="user-image img-responsive"/>
                </a>
            </li>

            <li>
                <a class="active-menu" href="{{url('/home')}}"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
            </li>
            @if (Auth::is('root'))
                <li>
                    <a class="menu" href="{{ route('student.add') }}"><i class="fa fa-user fa-2x"></i> Add Student</a>
                </li>
            @endif
            @if(Auth::is('admin'))
                <li class="@yield('active_sms')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>SMS Service Management<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/sms/report')}}">SMS Report (Dashboard)</a>
                        </li>
                        <li>
                            <a href="{{url('/sms')}}">Notification of Absent Student</a>
                        </li>
                        <li>
                            <a href="{{url('/sms/present-student')}}">Notification of Present Student</a>
                        </li>
                        <li>
                            <a href="{{url('/sms/create')}}">Notice</a>
                        </li>

                        <li>
                            <a href="{{url('/sms/contentCreate')}}">Content Settings</a>
                        </li>
                        <li>
                            <a href="{{url('/sms/result')}}">SMS Result</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::is('root'))
                <li class="@yield('active_school')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Institute Client Management<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/schools/create')}}">Add institute</a>
                        </li>
                        <li>
                            <a href="{{url('/schools')}}">Institute List</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('active_login_info')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Login Information<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('student_login_info') }}">Student Login Info</a>
                        </li>
                        <li>
                            <a href="{{ route('student_password') }}">Student Password Reset</a>
                        </li>
                        <li>
                            <a href="{{ route('student_email') }}">Student Email Reset</a>
                        </li>
                        <li>
                            <a href="{{ route('employee_login_info') }}">Employee Login Info</a>
                        </li>
                        <li>
                            <a href="{{ route('employee_password') }}">Employee Password Reset</a>
                        </li>
                        <li>
                            <a href="{{ route('employee_email') }}">Employee Email Reset</a>
                        </li>
                        <li>
                            <a href="{{ route('committee_login_info') }}">Committee Login Info</a>
                        </li>
                        <li>
                            <a href="{{ route('committee_password') }}">Committee Password reset</a>
                        </li>
                        <li>
                            <a href="{{ route('committee_email') }}">Committee Email reset</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('active_sms_login_info')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>SMS<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/sms/number-collection')}}">Collection Phone No.</a>
                        </li>
                        <li>
                            <a href="{{ route('rootSms.daily_sms_report')}}">Institute Based Daily SMS Report</a>
                        </li>
                        <li>
                            <a href="{{ route('smsLimit.sms_setup')}}">Select Automatic SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('loginInfo.student')}}">Send Student Login Info</a>
                        </li>
                        <li>
                            <a href="{{ route('loginInfo.employee')}}">Send Empolyee Login Info</a>
                        </li>
                        <li>
                            <a href="{{ route('loginInfo.committee')}}">Send Commitee Login Info</a>
                        </li>
                        <li>
                            <a href="{{ route('rootSms.add')}}">Inistitute Based SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('rootSms.multi_school')}}">Multi Institute Based SMS</a>
                        </li>
                    </ul>
                </li>
                <li class="@yield('active_birthday_text')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Birthday SMS<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('birthdayText.add')}}">Add SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('birthdayText.list')}}">All SMS</a>
                        </li>
                    </ul>
                </li>

                <li class="@yield('active_attendance_text')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>SMS Settings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('attendanceText.add')}}">Add SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('attendanceText.list')}}">SMS</a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('attendanceTime.add')}}">Add Attendance Time</a>
                        </li>
                        <li>
                            <a href="{{ route('attendanceTime.list')}}">Attendance Time List</a>
                        </li> --}}
                    </ul>
                </li>

                <li class="@yield('message_length')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Automatic SMS Settings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('messageLength.add')}}">Add SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('messageLength.list')}}">SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('attendanceOption.list')}}">Automatic Attendance Option</a>
                        </li>
                    </ul>
                </li>

            @endif


            @if(Auth::is('root'))
                <li class="@yield('active_designation')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Designation Management<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/designations/create')}}">Add Designation</a>
                        </li>
                        <li>
                            <a href="{{url('/designations')}}">Designations</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin'))
                <li class="@yield('active_attendance')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Attendance Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('attendence/create')}}">Attendance Entry</a>
                        </li>
                        <li>
                            <a href="{{url('menual/student-entry')}}">Menulaly Student Attendance</a>
                        </li>
                        <li>
                            <a href="{{url('menual/staff-entry')}}">Menualy Staff Attendance</a>
                        </li>
                        <li>
                            <a href="{{url('attendence/student')}}">Student Attendance</a>
                        </li>
                        <li>
                            <a href="{{url('atten_employee')}}">Employee Attendance</a>
                        </li>
                        <li>
                            <a href="{{url('leave/create')}}">Employee and Student Leave Entry</a>
                        </li>
                        <li>
                            <a href="{{url('attendence-report/create')}}">Attendance Report</a>
                        </li>
                    </ul>
                </li>
                <hr style="margin: 0;padding:0;display: none;">
            @endif

            @if(Auth::is('admin'))
                <li class="@yield('active_teacher')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Employee Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/staff/create')}}">Add Employee</a>
                        </li>
                        <li>
                            <a href="{{url('/staff')}}">Employee Info</a>
                        </li>

                        <li>
                            <a href="{{url('/staff-old')}}">Former Employe History</a>
                        </li>

                        <li>
                            <a href="{{url('staff-regine')}}">Regine</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin')||Auth::is('commitee'))
                <li class="@yield('active_commitee')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Commitee Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('admin'))
                        <li>
                            <a href="{{url('/commitee/create')}}">Add Commitee</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{url('/commitee')}}">Commitees</a>
                        </li>

                        <li>
                            <a href="{{url('/commitee_old')}}">Former Commitee History</a>
                        </li>

                    </ul>
                </li>
            @endif

            @if(Auth::is('admin'))
                <li class="@yield('active_student')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Student Management<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/students/create')}}">Add New Student</a>
                        </li>

                        <li>
                            <a href="{{url('/students_list')}}">Students</a>
                        </li>
                        <li>
                            <a href="{{url('/old_students_list')}}">Former Student History</a>
                        </li>
                        <li>
                            <a href="{{url('/testimonial')}}">List of Testimonial</a>
                        </li>
                        <li>
                            <a href="{{url('/transfer_certificate')}}">Transfer Certificates</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin'))
                <li class="@yield('active_class_promotion')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Class Migration Management<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/promotion/menual')}}">Class Migration</a>
                        </li>
                    </ul>
                </li>
            @endif




            @if(Auth::is('admin')|| Auth::is('teacher') || Auth::is('student'))
                <li class="@yield('active_subject')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Subject Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                            @if(Auth::is('admin'))
                            <li>
                                <a href="{{url('/subjects/create')}}">Add Subject</a>
                            </li>
                            @endif

                            @if(Auth::is('admin') || Auth::is('teacher') || Auth::is('student'))
                            <li>
                                <a href="{{url('/subjects')}}">Subjects</a>
                            </li>
                            @endif

                            @if(Auth::is('admin'))
                            <li>
                                <a href="{{url('/subjectTeachers/create')}}">Subject Teacher</a>
                            </li>
                            @endif

                            @if(Auth::is('admin') || Auth::is('teacher') || Auth::is('student'))
                            <li>
                                <a href="{{url('/subjectTeachers')}}">Assign Statistic</a>
                            </li>
                            @endif
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin')|| Auth::is('teacher') || Auth::is('student'))
                <li class="@yield('active_ca_subject')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>CA Attachment Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('admin'))
                        <li>
                            <a href="{{url('/ca-subjects/create')}}">Add Subject (CA)</a>
                        </li>
                        @endif

                        @if(Auth::is('admin') || Auth::is('teacher') || Auth::is('student'))
                        <li>
                            <a href="{{url('/ca-subjects')}}">Subjects (CA)</a>
                        </li>
                        @endif
                        @if(Auth::is('admin'))
                        <li>
                            <a href="{{url('/ca-result/create')}}">Entry Result (CA)</a>
                        </li>
                        <li>
                            <a href="{{url('/ca-result/list')}}">Edit Result (CA)</a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Auth::is('admin'))
                <li class="@yield('online_admission')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Online Admission<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/online_admission/create')}}">Create Online Admission</a>
                            <a href="{{url('/online_admission')}}">Online Admission List</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::is('root')||Auth::is('admin'))
                <li class="@yield('active_exam')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Examination Management<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('root'))
                        <li>
                            <a href="{{url('/examTypes/create')}}">Add Exam Type</a>
                        </li>
                        <li>
                            <a href="{{url('/examTypes')}}">Exam Types</a>
                        </li>
                        @endif

                        @if(Auth::is('admin'))
                        <li>
                            <a href="{{url('/schoolExams')}}">Exam Types</a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif


            @if(Auth::is('teacher')||Auth::is('admin')||Auth::is('student'))
                <li class="@yield('question')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Question Management<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/mcq/question/create')}}">Add MCQ</a>
                        </li>
                        <li>
                            <a href="{{url('mcq/question')}}">MCQ List</a>
                        </li>
                        <li>
                            <a href="{{url('mcq/question/all')}}">All MCQ</a>
                        </li>
                        <li>
                            <a href="{{url('written/question/create')}}">Add Written Question</a>
                        </li>
                        <li>
                            <a href="{{url('written/question')}}">Written Questions</a>
                        </li>
                        <li>
                            <a href="{{url('written/question/all')}}">All Written Question</a>
                        </li>
                        @if(Auth::is('teacher')||Auth::is('admin'))

                        <li>
                            <a href="{{url('/exam/create')}}">Add Questionnaire</a>
                        </li>
                        <li>
                            <a href="{{url('exam/mcq')}}">MCQ Questionnaires</a>
                        </li>
                        <li>
                            <a href="{{url('exam/written')}}">Written Questionnaires</a>
                        </li>

                        @endif
                    </ul>
                </li>
            @endif
            @if( Auth::is('student'))
                <li class="@yield('online_exam')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Online Exam Management<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('student'))
                            <li>
                                <a href="{{url('/exam/mcq/student')}}">MCQ Exam</a>
                             </li>
                             <li>
                                <a href="{{url('/exam/written/student')}}">Written Exam</a>
                             </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin') || Auth::is('teacher') || Auth::is('student'))
                <li class="@yield('active_result')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>{{Auth::is('student') ? 'See Result' : 'Result Management'}}<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(isset($imp_setting->result_entry_type)&&($imp_setting->result_entry_type=='single'))
                          @if(Auth::is('admin')||Auth::is('teacher'))
                           <li>
                               <a href="{{url('/single-result/create')}}">Entry Result (Single)</a>
                           </li>
                           <li>
                               <a href="{{url('/single-result/list')}}">Edit Result (Single)</a>
                           </li>
                          @endif
                        @else
                          @if(Auth::is('admin'))
                          <li>
                              <a href="{{url('/result/create')}}">Entry Result (All)</a>
                          </li>
                          <li>
                              <a href="{{url('/result/edit')}}">Edit Result (All)</a>
                          </li>
                          @endif
                        @endif
                          @if(Auth::is('admin'))
                            <li>
                                <a href="{{url('/result/to_publish')}}">Publish the Results</a>
                            </li>
                            <li>
                                <a href="{{url('/progress/class-card-create')}}">Class-based Progress Card</a>
                            </li>
                            <li>
                                <a href="{{url('/progress/create')}}">Progress Report Card</a>
                            </li>
                            <li>
                                <a href="{{url('/result/tebulation-create')}}">Class-based Tabulation</a>
                            </li>
                            <li>
                                <a href="{{url('/result/class')}}">Class-based Result</a>
                            </li>
                          @endif
                        <li>
                            <a href="{{url('/result')}}">See Result</a>
                        </li>
                        @if(Auth::is('admin'))
                            <li>
                                <a href="{{url('/elective/setting')}}">Elective Settings</a>
                            </li>
                        @endif
                        @if(Auth::is('student'))
                            <li>
                                <a href="{{url('/online-exam/result')}}">See Online Exam Result</a>
                             </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin') || Auth::is('staff') || Auth::is('commitee') || Auth::is('teacher') || Auth::is('student'))
                <li class="@yield('active_routine')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>{{Auth::is('admin') ? 'Routine Management' : 'Routine'}}<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('admin'))
                            <li>
                                <a href="{{url('/classRoutine/add')}}">Add Class Routine</a>
                            </li>
                            <li>
                                <a href="{{url('/examRoutine/add')}}">Add Exam Routine</a>
                            </li>
                        @endif

                            <li>
                                <a href="{{url('/classRoutines')}}">See Class Routine</a>
                            </li>
                            <li>
                                <a href="{{url('/examRoutines')}}">See Exam Routine</a>
                            </li>
                    </ul>
                </li>
            @endif


            @if(Auth::is('admin') || Auth::is('teacher') || Auth::is('student')|| Auth::is('staff'))
                <li class="@yield('active_notice')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>{{Auth::is('admin') ? 'Notice Management' : 'Notice'}}<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/notice')}}">See Notice</a>
                        </li>
                        @if(Auth::is('admin'))
                            <li>
                                <a href="{{url('/notice/create')}}">Add Notice</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin') || Auth::is('teacher') || Auth::is('staff') || Auth::is('student'))
                <li class="@yield('leave_application')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>{{Auth::is('admin') ? 'Leave Application Management' : 'Leave Application'}}<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(!Auth::is('admin'))
                            <li>
                                <a href="{{url('/leave_application')}}">Leave Applications</a>
                            </li>
                            <li>
                                <a href="{{url('/leave_application/create')}}">Leave Application</a>
                            </li>
                        @endif
                        @if(Auth::is('admin'))
                            <li>
                                <a href="{{url('/leave_application/pending_list')}}">In Process Leave Application</a>
                            </li>
                            <li>
                                <a href="{{url('/leave_application/accept_list')}}">Received Leave Application</a>
                            </li>
                            <li>
                                <a href="{{url('/leave_application/cancle_list')}}">Canceled Leave Application</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Auth::is('admin') || Auth::is('teacher') || Auth::is('staff') || Auth::is('student'))
                <li class="@yield('active_counseling')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>{{'Student Complaints'}}<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('student'))
                            <li>
                                <a href="{{route('complaint.add')}}">Send Complaint</a>
                            </li>
                        @endif
                            <li>
                                <a href="{{url('/complaint.list')}}">Complaints</a>
                            </li>
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin')||Auth::is('root'))
                <li class="@yield('active_accounts')">
                    <a href="#">
                        <i class="fa fa-sitemap fa-2x"></i>
                        Account Management
                        <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                      @if(Auth::is('root'))
                        <li>
                            <a href="{{ route('fee_category_add') }}"> Fee Category Management</a>
                        </li>

                        <li>
                            <a href="{{ route('fund_create') }}"> Fund Management </a>
                        </li>
                      @endif
                      @if(Auth::is('admin'))
                       <li>
                           <a href="{{ route('account_dashboard') }}"> Account Dashboard</a>
                       </li>
                       <li>
                           <a href="{{ route('fee_sub_category_add') }}"> Fee Sub Category Management</a>
                       </li>
                       <li>
                           <a href="{{ route('fee_setup_add') }}"> Fee Amount Setup</a>
                       </li>
                        <li>
                            <a href="{{ route('fee_collection_add') }}"> Fee Collection</a>
                        </li>
                        <li>
                            <a href="{{ route('fee_collection_manage') }}"> Fee Collection Manage</a>
                        </li>
                        <li>
                            <a href="{{ route('due_sms') }}"> Send Due SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('income_add') }}">Income Add & Print</a>
                        </li>
                        <li>
                            <a href="{{ route('income_manage') }}"> Income Manage</a>
                        </li>
                        <li>
                            <a href="{{ route('expense_add') }}"> Expense Add & Print</a>
                        </li>
                        <li>
                            <a href="{{ route('expense_manage') }}"> Expense Manage</a>
                        </li>
                        <li>
                            <a href="{{ route('fine_setup_add') }}"> Fine Setup</a>
                        </li>
                        <li>
                            <a href="{{ route('fine_collection_add') }}"> Fine Collection</a>
                        </li>
                        <li>
                            <a href="{{ route('fine_collection_manage') }}"> Fine Manage</a>
                        </li>
                        <li>
                            <a href="{{ route('fine_sms') }}">Send Fine SMS</a>
                        </li>
                        <li>
                            <a href="{{ route('salary_setup_add') }}"> Basic Salary Management </a>
                        </li>
                        <li>
                            <a href="{{ route('salary_fund_add') }}"> Salary Funds Management </a>
                        </li>
                        <li>
                            <a href="{{ route('provident_fund_add') }}"> Provident Fund Management </a>
                        </li>
                        <li>
                            <a href="{{ route('bank_provident_fund_list') }}">Bank Deposit Provident Fund</a>
                        </li>
                        <li>
                            <a href="{{ route('advanced_paid_add') }}"> Advanced Salary Management </a>
                        </li>
                        <li>
                            <a href="{{ route('salary_sheet_add') }}"> Monthly Salary Sheet create & Print </a>
                        </li>
                        <li>
                            <a href="{{ route('salary_sheet_search') }}"> Monthly Salary Sheet Manage </a>
                        </li>
                        <li>
                            <a href="{{ route('asset_add') }}"> Asset Management </a>
                        </li>
                        <li>
                            <a href="{{ route('bank_add') }}">Bank Management</a>
                        </li>
                        <li>
                            <a href="{{ route('bank_aacount_type_add') }}">Bank Account Type Management</a>
                        </li>
                        <li>
                            <a href="{{ route('bank_deposit_add') }}">Bank Deposit Management</a>
                        </li>
                        <li>
                            <a href="{{ route('bank_withdraw_add') }}">Bank Withdraw</a>
                        </li>
                        <li>
                            <a href="{{ route('account_report') }}"> Account Report</a>
                        </li>
                        <li>
                            <a href="{{ route('account_setting_add') }}"> Account Setting</a>
                        </li>
                      @endif
                    </ul>
                </li>
            @endif


            @if(Auth::is('root'))
            <li></li>
                <li class="@yield('active_card1')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Create ID Card <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        @if(Auth::is('root'))
                        <!--
                        <li>
                        <a href="{{url('/studentCard')}}">Create Student ID Card </a>
                        </li>
                        -->
                        <li>
                        <a href="{{url('/stafCard')}}">Create Employee ID Card </a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(Auth::is('admin'))
                <li class="@yield('active_latter')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>All Paper Management <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                         <a href="{{url('/result-list/index')}}">Make a list of the results  </a>
                        </li>
                        <li>
                         <a href="{{url('/attendance-list/create')}}">Daily Attendance List (Blank) </a>
                        </li>
                        <li>
                         <a href="{{url('/attendance-list/create-monthly')}}">Monthly Attendance List (Blank) </a>
                        </li>
                        <li>
                         <a href="{{url('/admit-card/create')}}">Create Admit Card </a>
                        </li>
                        <li>
                         <a href="{{url('/exam-seat-plan/create')}}">Create Exam Seat plan </a>
                        </li>
                        <li>
                         <a href="{{url('/testimonial/create')}}">Create Testimonial </a>
                        </li>
                        <li>
                         <a href="{{url('/transfer_certificate/create')}}">Create Transfer Certificate</a>
                        </li>
                        <li>
                         <a href="{{url('/important_form')}}">Form Download </a>
                        </li>
                    </ul>
                </li>
            @endif


            @if(Auth::is('root')||Auth::is('admin'))
                <li class="@yield('active_class1')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Settings Option<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('root'))
                        <li>
                            <a href="{{url('/class/create')}}">Add Class</a>
                        </li>
                        <li>
                            <a href="{{url('/class')}}">Classes</a>
                        </li>

                        <li>
                            <a href="{{url('/group/create')}}">Create Department</a>
                        </li>
                        <li>
                            <a href="{{url('/group')}}">Department</a>
                        </li>
                        <li>
                            <a href="{{url('/service-type')}}">Service Types</a>
                        </li>
                        <li>
                            <a href="{{url('/important_file')}}">Important Files</a>
                        </li>
                        @endif
                        @if(Auth::is('admin'))
                        <li>
                            <a href="{{url('/unit/create')}}">Create Branch</a>
                        </li>
                        <li>
                            <a href="{{url('/unit')}}">All Branch</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{url('/holiday/create')}}">Create Holiday</a>
                        </li>
                        <li>
                            <a href="{{url('/holiday')}}">Holidays</a>
                        </li>
                        @if(Auth::is('admin'))
                        <li>
                            <a href="{{url('/holiday-cancel/create')}}">Cancel Holiday</a>
                        </li>
                        <li>
                            <a href="{{url('/holiday-cancel')}}">Cancel Holidays</a>
                        </li>
                        <li>
                            <a href="{{url('/important-settings')}}">Important Settings</a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="@yield('active_care')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Care<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if (Auth::is('root'))
                            <li>
                                <a href="{{ route('problem.root_problem') }}">Problems</a>
                            </li>
                            <li>
                                <a href="{{ route('advice.root_advice') }}">All Advice</a>
                            </li>
                        @endif
                        @if(Auth::is('admin'))
                        <li>
                            <a href="{{ route('problem.add') }}">Write Problem</a>
                        </li>
                        <li>
                            <a href="{{ route('problem.list') }}">Problems</a>
                        </li>
                        <li>
                            <a href="{{ route('advice.add') }}">Send Your Advice</a>
                        </li>
                        <li>
                            <a href="{{ route('advice.list') }}">All Advice</a>
                        </li>
                        <li>
                            <a href="{{ route('problem.list.website') }}">Site Problems</a>
                        </li>
                        <li>
                            <a href="{{ route('advice.list.website') }}">All Advice About Site</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if(Auth::is('admin'))
                <li class="@yield('active_visitor')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Visitor Management<span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('visitorType.add') }}">Visitor Type</a>
                        </li>
                        <li>
                            <a href="{{ route('visitor.add') }}">Add Visitor</a>
                        </li>
                        <li>
                            <a href="{{ route('visitor.list') }}">Visitors</a>
                        </li>
                    </ul>
                </li>
                @endif

            @endif
            @if(Auth::is('teacher') || Auth::is('student'))
            <li>
                <li class="@yield('online_class')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Online Class<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('teacher'))
                        <li>
                            <a href="{{ route('online_class.create') }}">Add Online Class</a>
                        </li>
                        <li>
                            <a href="{{ route('online_class') }}">Online Class Information</a>
                        </li>
                        @endif
                        @if(Auth::is('student'))
                        <li>
                            <a href="{{ route('online_class.student') }}">Online Class Information</a>
                        </li>
                        @endif
                    </ul>
                </li>
            </li>
            @endif
            @if(Auth::is('teacher') || Auth::is('student'))
            <li>
                <li class="@yield('online_class_youtube')">
                    <a href="#"><i class="fa fa-sitemap fa-2x"></i>Youtube Online Class<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::is('teacher'))
                        <li>
                            <a href="{{ route('online_class_youtube.create') }}">Add Online Class</a>
                        </li>
                        <li>
                            <a href="{{ route('online_class_youtube') }}">Online Class Information</a>
                        </li>
                        @endif
                        @if(Auth::is('student'))
                        <li>
                            <a href="{{ route('online_class_youtube.student') }}">Online Class Information</a>
                        </li>
                        @endif
                    </ul>
                </li>
            </li>
            @endif
            @if(Auth::is('admin'))
                <li>
                    <a href="{{url('school_settings')}}"><i class="fa fa-angle-double-down fa-2x"></i>Web Management</a>

                </li>
            @endif
            @if(Auth::is('root') || Auth::is('teacher') || Auth::is('staff') || Auth::is('student'))
            {{-- <li>
                <a href="{{url('chat')}}" ><i class="fa fa-comment fa-2x"></i>Ehsan Chatting Application</a>

            </li> --}}
            @endif
            {{-- <li class="@yield('post')">
                    <a href="#">
                        <i class="fa fa-sitemap fa-2x"></i>Ehsan Education Social Site  <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/post/')}}">Timeline</a>
                        </li>
                        <li>
                            <a href="{{url('/post/profile',1)}}">Profile</a>
                        </li>
                        @if(Auth::is('root') || Auth::is('admin'))
                        <li>
                            <a href="{{url('/post/pending_list')}}">Pending list</a>
                        </li>
                        <li>
                            <a href="{{url('/post/accept_list')}}">Accepted list</a>
                        </li>
                        <li>
                            <a href="{{url('/post/cancel_list')}}">Cencel list</a>
                        </li>
                        <li>
                            <a href="{{url('/post/delete_list')}}">Trash</a>
                        </li>
                        @endif

                    </ul>
                </li> --}}
            <!-- @if(Auth::is('admin'))
             <li>
                 <a href="{{url('qbank')}}"><i class="fa fa-sitemap fa-2x"></i>প্রশ্নপত্র সংরক্ষণ</a>
             </li>
            @endif -->
            @if(Auth::is('root'))
                <li class="@yield('active_advertisement')">
                    <a href="#">
                        <i class="fa fa-sitemap fa-2x"></i>Advertisement Management <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                        <a href="{{url('/advertisement')}}">Add Advertisement </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Auth::is('root'))
                <li class="@yield('date_language')">
                    <a href="#">
                        <i class="fa fa-sitemap fa-2x"></i>Web Management <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/admin_date_language/create')}}">Add Date Language</a>
                        </li>
                         <li>
                            <a href="{{url('/admin_date_language')}}">All Date Language </a>
                        </li>
                        <li>
                            <a href="{{url('/important_links_category_root/create')}}">Add Important Link Category</a>
                        </li>
                         <li>
                            <a href="{{url('/important_links_category_root')}}">Important Link Categories </a>
                        </li>
                        <li>
                            <a href="{{url('/important_link_root/create')}}">Add Important Link</a>
                        </li>
                         <li>
                            <a href="{{url('/important_link_root')}}">All Important Link</a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>

    </div>

</nav>
