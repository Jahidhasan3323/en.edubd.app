/**
 * Created by Mehedi on 17-Apr-17.
 */

 $(document).ready(function(){
     
     $('#master_class_id').on('change', function (){
        var Class = $('#master_class_id').val();
        var subjects ='<option value="">...Select subject...</option>';
                $.ajax({
                    url: 'get/subjects',
                    type: 'get',
                    data: {'class_id': Class},
                    success: function (data) {
                        for (var i = 0; i < data.length; i ++){
                            subjects = subjects + '<option value="'+data[i].id+'">'+data[i].name+' ('+data[i].code+')</option>'
                        }
                        $('#subject_id').html(subjects);
                    }
                });
      });

 });

$(document).ready(function () {

    $('#result_from').on('submit', function () {
        $('#success_div').fadeOut();
        var classId = $("#master_class_id").val();
        var exam = $("#exam_type_id").val();
        var subjectId = $("#subject_id").val();
        var studentId = $("#student_id").val();
        var schoolId = $("#school_id").val();
        var marks = $("#marks").val();
        
        if (!classId){
            $('#error_div').fadeIn();
            $('.error').text('Please Select a Class');
            return false;
        }
        if(!exam){
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
                    $("#student_id").val('');
                    $("#marks").val('');
                    $('#success_div').fadeIn();
                    $('.success').text('Result successfully added !');
                    return false;
                }

                $('#error_div').fadeIn();
                $('.error').text(data);
            }
        });

        return false;
    });

    $("#subject_id, #student_id, #marks").on('click', function () {
        $('#success_div').fadeOut();
        $('#error_div').fadeOut();
    });
});
