@extends('backEnd.master')

@section('mainTitle', 'ভিজিটর পরিবর্তন করুন')
@section('active_visitor', 'active')
@section('style')
<style type="text/css">
    .form-group {
        margin-bottom: 0;
    }
</style>
@endsection
@section('content')
    <div class="panel col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">
        <div class="page-header">
            <h1 class="text-center text-temp">ভিজিটর পরিবর্তন করুন</h1>
        </div>

        @if(Session::has('errmgs'))
            @include('backEnd.includes.errors')
        @endif
        @if(Session::has('sccmgs'))
            @include('backEnd.includes.success')
        @endif

        <div class="panel-body">
            <form id="validate" name="validate" action="{{ route('visitor.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ $visitor->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                            <label class="" for="name">ভিজিটরের নাম <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('name',$visitor->name)}}" class="form-control" type="text" name="name" id="name" placeholder="ভিজিটরের নাম লিখুন">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                            <label class="" for="mobile">ভিজিটরের মোবাইল </label>
                            <div class="">
                                <input value="{{old('mobile',$visitor->mobile)}}" class="form-control" type="number" name="mobile" id="mobile" placeholder="ভিজিটরের মোবাইল নাম্বার লিখুন">
                            </div>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{$errors->first('mobile')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('subject') ? 'has-error' : ''}}">
                            <label class="" for="designation">ভিজিটরের পদবী <span class="star">*</span></label>
                            <div class="">
                                <input value="{{old('designation',$visitor->designation)}}" class="form-control" type="text" name="designation" id="designation" placeholder="ভিজিটরের পদবী লিখুন">
                            </div>
                            @if ($errors->has('designation'))
                                <span class="help-block">
                                    <strong>{{$errors->first('designation')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('subject') ? 'has-error' : ''}}">
                            <label class="" for="visitor_type_id">ভিজিটরের ধরণ <span class="star">*</span> </label>
                            <select class="form-control" name="visitor_type_id" required>
                                <option selected value="{{ $visitor->visitor_type_id }}">{{ $visitor->visitor_type->name }}</option>
                                @foreach ($visitor_types as $visitor_type)
                                    <option value="{{ $visitor_type->id }}">{{ $visitor_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">

                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('in_time') ? 'has-error' : ''}}">
                            <label for="in_time">প্রবেশের সময়<span class="star">*</span></label>
                            <input type="time" class="form-control" id="in_time" name="in_time" value="{{ $visitor->in_time }}">
                            @if ($errors->has('in_time'))
                                <span class="help-block">
                                    <strong>{{$errors->first('in_time')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('out_time') ? 'has-error' : ''}}">
                            <label for="out_time">বের হওয়ার সময় </label>
                            <input type="time" class="form-control" id="out_time" name="out_time" value="{{ $visitor->out_time??date('h:i') }}">
                            @if ($errors->has('out_time'))
                                <span class="help-block">
                                    <strong>{{$errors->first('out_time')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('purpose') ? 'has-error' : ''}}">
                            <label for="purpose">কারণ <span class="star">*</span></label>
                            <textarea name="purpose" rows="5" class="form-control">{{ $visitor->purpose }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('note') ? 'has-error' : ''}}">
                            <label for="note">নোট </label>
                            <textarea name="note" rows="5" class="form-control">{{ $visitor->note }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{$errors->has('image') ? 'has-error' : ''}}">
                            <label for="image">ছবি আপলোড </label>
                            <div class="" style="width:110px;height:110px;border-radius:3px;">
                                <img id="image_show" src="{{ Storage::url($visitor->image??'images/no_image.jpg') }}" alt="Image" width="100" height="100">
                            </div>
                            <input type="file" name="image" id="image" accept="image/*">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{$errors->first('image')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">আপডেট করুন</button>
                        </div>
                    </div>
                </div>

            </form>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="{{asset('backEnd/css/jquery-ui.css')}}">
    <script src="{{asset('backEnd/js/jquery-ui.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image").change(function(){
                readURL(this);
            });
        });
    </script>
@endsection
