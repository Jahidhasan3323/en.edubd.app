/**
 * Created by Mehedi on 25-Apr-17.
 */
$(document).ready(function () {
    $('#validate').on('submit', function (event) {
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

    // mobile check.........
    $('#mobile').on('keyup', function () {
        var data = $(this).val();
        if (data.length > 10){
            var givenSchoolMobile = data;
            $.ajax({
                url: 'school/MobileCheck',
                type: 'get',
                data: {'mobile': givenSchoolMobile},
                success: function (data) {
                    if (data == 1){
                        $('#mobileError').show();
                        $('.mobileError').text('Opps, this mobile no already been taken !');
                    }
                    if (data == 0){
                        $('#mobileError').hide(1000);
                    }
                }
            });
        }
        $('#mobileError').hide(1000);
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