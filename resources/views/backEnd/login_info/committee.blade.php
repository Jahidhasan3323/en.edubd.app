@extends('backEnd.master')

@section('mainTitle', 'Login Info')

@section('active_sms_login_info', 'active')

@section('content')
    <div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">Send login information</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif
        <div class="col-md-12" style="border: 1px solid #ddd;">
            <h4 style="margin-bottom: 20px;" class="text-center">Select institute</h4>
            <div class="row col-md-8 col-md-offset-2">
                <form action="{{route('loginInfo.comm_search')}}" method="post">
                    {{csrf_field()}}
                    <div class="col-md-12 {{$errors->has('school_id') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <select class="form-control" name="school_id" id="school_id">
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}" >{{$school->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('school_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('school_id')}}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(isset($committees))
        <div class="col-sm-12">
        <h4 style="margin-bottom: 10px;" class="text-center"> Select Committee </h4>
        <h5 style="margin-bottom: 10px;" class="text-center">Total Committee : {{count($committees)}}</h5>
        <div class="row">
            <div class="panel-body" style="margin-top: 10px;">
                <form action="{{route('loginInfo.comm_sms')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @php($i=1)
                    <div class="row">
                       <div class="col-sm-12">
                           <div class="panel-body table-responsive">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th> Name </th>
                                    <th>Designation</th>
                                    <th>Mobile Number</th>
                                </tr>
                               @foreach($committees as $committee)
                                <tr>
                                   <td>
                                        <input class="form-check-input number" name="id[]" type="checkbox" value="{{$committee->id}}" id="defaultCheck{{$i}}">
    									<input type="hidden" name="school_id" value="{{ $committee->school_id }}">
                                        <label class="form-check-label" for="defaultCheck{{$i++}}">
                                          {{$committee->user->name}}
                                        </label>
                                    </td>
                                    <td>
                                        {{$committee->designation}}
                                    </td>
                                    <td>
                                        {{$committee->user->mobile}}
                                    </td>
                                </tr>
                                @endforeach
                                @if(count($committees)>0)
                                <tr>
                                    <td colspan="3">
                                        <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">Check All / Uncheck</label>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        </div>
                        @if(count($committees)>0)
                        <hr>

                        <div class="">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <div class="form-group">
                                        <button id="save_btn" type="submit" class="btn btn-block btn-info">Send SMS</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @endif
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        function checkNumber(){
            // Check #x
            if($("#all_check").prop('checked') == true){
                $(".number").prop( "checked", true );
            }else{
                $(".number").prop( "checked", false );
            }
        }
    </script>
@endsection
