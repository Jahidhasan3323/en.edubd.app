/**
 * Created by Mehedi on 17-Apr-17.
 */
$(document).ready(function () {
    $('#class_btn').on('click', function () {
        $('#success_div').fadeOut();
        $('#error_div').fadeOut();
        var Class = $('#class').val();
        // var subjects = '';
        // $.ajax({
        //     url: 'get/subjects',
        //     type: 'get',
        //     data: {'class_id': Class},
        //     success: function (data) {
        //         //console.log(data);
        //         for (var i = 0; i < data.length; i ++){
        //             subjects = subjects + '<option value="'+data[i].id+'">'+data[i].name+' ('+data[i].code+')</option>'
        //         }
        //         $('#subject_code').html(subjects);
        //     }
        // });
        //
        var ClassName = Class;
        
        $('#class_block').fadeIn(300);
        $('#show_class').html('Class - ' + ClassName);
        $('#show_class_input').val(Class);
        $('#save').prop('disabled', false);

    });

    $('#exam_btn').on('click', function () {
        $('#success_div').fadeOut();
        $('#error_div').fadeOut();
        var exam = $('#exam_type').val();
        var examName = $('#exam_type option[value='+exam+']').text();
        $('#exam_block').fadeIn(300);
        $('#show_exam').html(examName);
        $('#show_exam_input').val(exam);
        $('#save').prop('disabled', false);
    });

    // $('#exitClass').on('click', function () {
    //     $('#success_div').fadeOut();
    //     $('#error_div').fadeOut();
    //     $('#exam_block').fadeOut(200);
    //     $('#show_exam').html(' ');
    //     $('#show_exam_input').val(' ');
    //     $('#class_block').fadeOut(200);
    //     $('#show_class').html(' ');
    //     $('#show_class_input').val(' ');
    //     $('#master_class_id').val(' ');
    //     $('#save').prop('disabled', true);
    //     $('#subject_code').html(' ');
    //     $('#subject_code').val(' ');
    // });

    $("select[name~='subject_code']").on('click', function () {
        $('#success_div').fadeOut();
        $('#error_div').fadeOut();
    });
});
