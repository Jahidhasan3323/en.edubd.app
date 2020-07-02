@extends('backEnd.master')

@section('mainTitle', 'Committee Password Reset')

@section('active_login_info', 'active')

@section('content')
<div class="panel col-md-12" style="margin-top: 15px; margin-bottom: 15px;">
    <div class="page-header">
        <h1 class="text-center text-temp">Committee Email Reset</h1>
    </div>

    @if(Session::has('errmgs'))
    @include('backEnd.includes.errors')
    @endif
    @if(Session::has('sccmgs'))
    @include('backEnd.includes.success')
    @endif
    <div class="col-md-12" style="border: 1px solid #ddd;">
        <h4 style="margin-bottom: 20px;" class="text-center">Select Institute</h4>
        <div class="row col-md-8 col-md-offset-2">
            <form action="{{route('committee_email_reset')}}" method="post">
                {{csrf_field()}}
                <div class="col-md-12 {{$errors->has('school_id') ? 'has-error' : ''}}">
                    <div class="form-group">
                        <select class="form-control" name="school_id" id="school_id">
                            @isset($school)
                                <option value="{{$school->id}}" >{{$school->user->name}}</option>
                            @endisset
                            <option value="">Select Institute</option>
                            @foreach($schools as $school)
                            <option value="{{$school->id}}">{{$school->user->name}}</option>
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
                    <br>
                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </center>
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
                <form action="{{route('committee_email_generate')}}" method="post" enctype="multipart/form-data" target="_blank">
                    {{csrf_field()}}
                    @php($i=1)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-body table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <th> Name </th>
                                        <th> ID No.</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                    </tr>
                                    @foreach($committees as $committee)
                                    <tr>
                                        <td>
                                            <input class="form-check-input number" name="id[]" type="checkbox" value="{{$committee->user_id}}" id="defaultCheck{{$i}}">
                                            <input type="hidden" name="school_id" value="{{ $committee->school_id }}">
                                            <label class="form-check-label" for="defaultCheck{{$i++}}">
                                                {{$committee->user->name}}
                                            </label>
                                        </td>
                                        <td>
                                            {{$committee->staff_id}}
                                        </td>
                                        <td>
                                            {{$committee->designation->name??''}}
                                        </td>
                                        <td>
                                            {{$committee->user->email}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if(count($committees)>0)
                                        <tr>
                                            <td colspan="3">
                                                <input id="all_check" class="form-check-input" onclick="checkNumber()" type="checkbox"> <label for="all_check">সব চেক / আনচেক</label>
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
                                            <button id="save_btn" type="submit" class="btn btn-block btn-info">Email Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')

<script type="text/javascript">
    function checkNumber() {
        // Check #x
        if ($("#all_check").prop('checked') == true) {
            $(".number").prop("checked", true);
        } else {
            $(".number").prop("checked", false);
        }
    }
</script>
@endsection
