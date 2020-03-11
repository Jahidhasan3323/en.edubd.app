/**
 * Created by Mehedi on 25-Apr-17.
 */
$(document).ready(function () {
    $('.validate').on('submit', function (event) {
        var mobile = $('#mobile').val();

          mobileValidation('mobile', 'mobileError', 1, event);

          var f_mobile_no = $('#f_mobile_no').val();
          if(f_mobile_no!=''){
            mobileValidation('f_mobile_no', 'f_mobile_Error', 1, event);
          }
          var m_mobile_no = $('#m_mobile_no').val();
          if(m_mobile_no!=''){
            mobileValidation('m_mobile_no', 'm_mobile_Error', 1, event);
          }
        
    });

    // for mobile unique check.........
    $('#mobile').on('keyup', function () {
        var data = $(this).val();
        if (data.length > 10){
            var givenTeacherMobile = data;
            $.ajax({
                url: 'teacher/MobileCheck',
                type: 'get',
                data: {'mobile': givenTeacherMobile},
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


// Here validate field name, id and class must be same. and error div id, class must be same
function mobileValidation(Vldt_field_name, errorDiv, isEmpty, event) {
    if (!validate_form(Vldt_field_name, isEmpty)){
        $('#'+errorDiv).show();
        $('.'+errorDiv).html("Please Enter the Valid Mobile Number !");
        //$('#'+Vldt_field_name).focus();
        $('#'+Vldt_field_name).keypress(function () {
            $('#'+errorDiv).hide();
        });
        $('#'+Vldt_field_name).on('click', function () {
            $('#'+errorDiv).hide();
        });
        event.preventDefault();
    }
}

function validate_form(fieldName, isEmpty)
{
    if (isEmpty){
        if( document.getElementById(fieldName).value == "" )
        {
            return false;
        }
    }

    if (document.getElementById(fieldName).value != ""){
        var mobileNumber = document.getElementById(fieldName).value;
        var pattern =/^[0]{1}[1]{1}[1,3-9]{1}[0-9]{8}$/;
        if (!pattern.test(mobileNumber))
        {
            return false;
        }
    }
    return( true );
}
