<div style=" margin-bottom: 10px;" class="col-sm-8 col-sm-offset-2 alert-success">
    <p style="padding-bottom: 10px; padding-top: 10px" class="text-center text-success">{{Session::get('sccmgs')}}</p>
</div>

<?php

Session::forget('sccmgs');
?>