
<!DOCTYPE html>
<html>
<head>
    <title>ID Card</title>
    <style type="text/css">
    * {-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; } body {font-family:'verdana'; } .column {float: left; width: 22.5%; padding: 1px; padding-left: 16px; padding-right: 4px; padding-top: 0px; } .row:after {content: ""; display: table; clear: both; } .id-card-holder {width: 225px; padding: 4px; background-color: #1f1f1f; border-radius: 5px; position: relative; } .id-card {background-color: #fff; width: 217px; height: 329.80px; padding: 10px; border-radius: 10px; text-align: center; box-shadow: 0 0 1.5px 0px #b9b9b9; } .header{text-align: center; } .header .website{font-size: 8px; } .photo img {width: 92px; height: 89px; } h2 {font-size: 15px; margin: 5px 0; } h3 {font-size: 12px; margin: 2.5px 0; font-weight: 300; } .qr-code img {width: 50px; } p {font-size: 5px; margin: 2px; } hr{margin: 0
    }
    
    @media print
    {
        div{
            page-break-inside: avoid;
        }
    } 
                
    </style>
</head>
<body>
    <div class="row">
    @if(isset($staffs))
        @foreach($staffs as $staff)
        <div>
            <div class="column">
                <div class="id-card-holder">
                    <div class="id-card">
                        <div class="header">
                               <img src="{{Storage::url($staff->school->logo)}}" height="30px" width="30px">
                                <h3>{{$staff->school->user->name}}<br>
                                    <span class="website">{{$staff->school->website}}</span>
                                </h3>
                        </div>
                        <h3 style="background:#423636;color:#fff;font-weight: bold;">{{$staff->user->group->name.' ID'}}</h3>
                        <div class="photo">
                            <img src="{{Storage::url($staff->photo)}}">
                        </div>
                        <h3>{{$staff->user->name}}</h3> 
                        <hr>
                        <h3>{{$staff->designation->name}}</h3>
                        <hr>
                        <h3>আইডি নং {{$staff->staff_id}}</h3>
                        <hr>
                        <h3>রক্ত : {{$staff->blood_group}}</h3>
                        <hr>
                        <p><img src="{{Storage::url($staff->school->signature_p)}}" width="98px" height="20px"></p>
                          @if(in_array("3", $school_type_ids))
                          <p>অধ্যক্ষের স্বাক্ষর:</p>
                          @else
                          <p>প্রধান শিক্ষকের স্বাক্ষর:</p>
                          @endif
                    </div>
                </div>
  </div>
            <div class="column">
              <div class="id-card-holder">
                <div class="id-card">
                  <hr>
                  <p>এই কার্ডটি এই প্রতিষ্ঠানের সম্পত্তি। তাই, দয়া করে প্রদত্ত ঠিকানায় কার্ডটি পাঠান, যদি অন্যথায় এটি পাওয়া যায়।</p>
                  <hr>
                  <p>{{$staff->school->address}} <p>
                  <hr>
                     {!!QrCode::size(145)->generate($staff->staff_id)!!}
                  <hr>
                     <p><img src="{{Storage::url('images')}}/figure.jpg" width="100px" height="40px"></p>
                  <hr>
                  <p>প্রদানের তারিখ : {{date('d-m-Y')}}, মেয়াদ শেষ : {{'31-12-'.(date('Y')+1)}}<p>
                  <hr>
                  <p>Powered By @Ehsan Software</p>
                  <p>www.worldehsan.org | infoehsansoftware@gmail.com</p>
                  <hr>
                  <div class="qr-code">
                  <table align="center" style="margin-top: 3px;">
                  <tr><td>
                  {!!DNS1D::getBarcodeHTML($staff->staff_id, "C128",1,35)!!}
                  </td></tr>
                  </table>
                  </div>        
                </div>
              </div>
  </div>
        </div>
        @endforeach
    @else
     <div class="column">
            <div class="id-card-holder">
                <div class="id-card">
                    <div class="header">
                           <img src="{{Storage::url($staff->school->logo)}}" height="30px" width="30px">
                            <h3>{{$staff->school->user->name}}<br>
                                <span class="website">{{$staff->school->website}}</span>
                            </h3>
                    </div>
                    <h3 style="background:#423636;color:#fff;font-weight: bold;">{{$staff->user->group->name.' ID'}}</h3>
                    <div class="photo">
                        <img src="{{Storage::url($staff->photo)}}">
                    </div>
                    <h3>{{$staff->user->name}}</h3> 
                    <hr>
                    <h3>{{$staff->designation->name}}</h3>
                    <hr>
                    <h3>আইডি নং {{$staff->staff_id}}</h3>
                    <hr>
                    <h3>রক্ত : {{$staff->blood_group}}</h3>
                    <hr>
                    <p><img src="{{Storage::url($staff->school->signature_p)}}" width="98px" height="20px"></p>
                      @if(in_array("3", $school_type_ids))
                      <p>অধ্যক্ষের স্বাক্ষর:</p>
                      @else
                      <p>প্রধান শিক্ষকের স্বাক্ষর:</p>
                      @endif
                </div>
            </div>
        </div>
        <div class="column">
          <div class="id-card-holder">
            <div class="id-card">
              <hr>
              <p>এই কার্ডটি এই প্রতিষ্ঠানের সম্পত্তি। তাই, দয়া করে প্রদত্ত ঠিকানায় কার্ডটি পাঠান, যদি অন্যথায় এটি পাওয়া যায়।</p>
              <hr>
              <p>{{$staff->school->address}} <p>
              <hr>
                 {!!QrCode::size(145)->generate($staff->staff_id)!!}
              <hr>
                 <p><img src="{{Storage::url('images')}}/figure.jpg" width="100px" height="40px"></p>
              <hr>
              <p>প্রদানের তারিখ : {{date('d-m-Y')}}, মেয়াদ শেষ : {{'31-12-'.(date('Y')+1)}}<p>
              <hr>
              <p>Powered By @Ehsan Software</p>
              <p>www.worldehsan.org | infoehsansoftware@gmail.com</p>
              <hr>
              <div class="qr-code">
              <table align="center" style="margin-top: 3px;">
                <tr><td>
              {!!DNS1D::getBarcodeHTML($staff->staff_id, "C128",1,35)!!}
              </td></tr>
              </table>
              </div>        
            </div>
          </div>
        </div>
    @endif
    </div>
     

</body>
</html>