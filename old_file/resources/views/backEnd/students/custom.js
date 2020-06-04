/**
 * Created by Mehedi on 18-Apr-17.
 */

$( function() {
    $( ".date" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
} );

$(document).ready(function () {
    $('.validate').on('submit', function (event) {
        if (!validate_form()){
            $('#mobileError').show();
            $('.mobileError').html("Please Enter the Mobile Number!");
            document.validate.mobile.focus();
            $('#mobile').keypress(function () {
                $('#mobileError').hide();
            })
            $('#mobile').on('click', function () {
                $('#mobileError').hide();
            });
            event.preventDefault();
        }
    });
});

function validate_form()
{
    if( document.validate.mobile.value == "" )
    {
        return false;
    }
    var mobileNumber = document.getElementById("mobile").value;
    var pattern =/^[0]{1}[1]{1}[1,5-9]{1}[0-9]{8}$/;
    if (!pattern.test(mobileNumber))
    {
        return false;
    }

    return( true );
}