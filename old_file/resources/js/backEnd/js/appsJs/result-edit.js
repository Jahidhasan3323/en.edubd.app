/**
 * Created by Mehedi on 17-Apr-17.
 */
$(document).ready(function () {
    $('#class').on('change', function () {
        $('#success_div').fadeOut();
        $('#error_div').fadeOut();
        var Class = $('#class').val();
        var subjects = '';
        $.ajax({
            url: 'get/subjects',
            type: 'get',
            data: {'class_id': Class},
            success: function (data) {
                //console.log(data);
                for (var i = 0; i < data.length; i ++){
                    subjects = subjects + '<option value="'+data[i].id+'">'+data[i].name+' ('+data[i].code+')</option>'
                }
                $('#subject_code').html(subjects);
            }
        });

        var ClassName = Class;
        if (Class > 1){
            var ClassName = Class - 1;
        }
        if (Class == 1){
            var ClassName = 'KG';
        }
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

    $('#exitClass').on('click', function () {
        $('#success_div').fadeOut();
        $('#error_div').fadeOut();
        $('#exam_block').fadeOut(200);
        $('#show_exam').html(' ');
        $('#show_exam_input').val(' ');
        $('#class_block').fadeOut(200);
        $('#show_class').html(' ');
        $('#show_class_input').val(' ');
        $('#master_class_id').val(' ');
        $('#save').prop('disabled', true);
        $('#subject_code').html(' ');
        $('#subject_code').val(' ');
    });

    $('#result_from').on('submit', function () {
        $('#success_div').fadeOut();
        var classId = $("input[name~='show_class']").val();
        var subjectId = $("select[name~='subject_id']").val();
        var studentId = $("input[name~='student_id']").val();
        var schoolId = $("input[name~='school_id']").val();
        var marks = $("input[name~='marks']").val();
        var exam = $("input[name~='exam_type_id']").val();
        if (!classId){
            $('#error_div').fadeIn();
            $('.error').text('Please Select a Class');
            return false;
        }
        if (!exam){
            $('#error_div').fadeIn();
            $('.error').text('Please Select a Exam type');
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url : 'result/entry',
            type: 'post',
            data: {'master_class_id' : classId, 'subject_id': subjectId, 'student_id': studentId, 'marks': marks, 'school_id': schoolId, 'exam_type_id': exam},
            success: function (data) {
                //console.log(data);
                if (data == 3){
                    $('#error_div').fadeIn();
                    $('.error').text('Opps, this has already added ! You can edit now.');
                    return false;
                }

                if (data == 2){
                    $('#error_div').fadeIn();
                    $('.error').text('Please enter value for all field or student ID is incorrect.');
                    return false;
                }

                if (data == 4){
                    $('#error_div').fadeIn();
                    $('.error').text('Please check students obtained marks.');
                    return false;
                }

                if (data == 1){
                    // $("input[name~='subject_code']").val('');
                    $("input[name~='student_id']").val('');
                    $("input[name~='marks']").val('');
                    $('#success_div').fadeIn();
                    $('.success').text('Result successfully added !');
                    return false;
                }

                $('#error_div').fadeIn();
                $('.error').text('Opps, Something going wrong ! Please try again .');
            }
        });

        return false;
    });

    $("select[name~='subject_code'], input[name~='student_id'], input[name~='marks']").on('click', function () {
        $('#success_div').fadeOut();
        $('#error_div').fadeOut();
    });
});
