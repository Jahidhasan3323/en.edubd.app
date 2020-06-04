/**
 * Created by Mehedi on 25-Apr-17.
 */
$(document).ready(function () {
    $('#group_class_id').on('change', function () {
        var master_class_id = $('#master_class_id').val();
        var group_class_id = $(this).val();
            var option = '<option value="">... Select a subject ...</option>';
            $.ajax({
                url : 'getsubject',
                type: 'get',
                data: {
                       'master_class_id' : master_class_id,
                       'group_class_id' : group_class_id,
                      },
                success: function (data) {
                    if (data.length){
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].id +'">' + data[i].subject_name + '</option>';
                        }
                        $('#ca_subject_id').html(option);
                    }else {
                        var option1 = '<option>No subject found.</option>';
                        $('#ca_subject_id').html(option1);
                    }
                }
            });
    });
});