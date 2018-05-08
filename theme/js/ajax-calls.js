function confirm(link) {
    $('#confirmationModal').modal('hide');
    $.ajax({
        type: "DELETE",
        url: link,
        success: after_form_submitted,
        dataType: 'json'
    });
}

$('#loginForm').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    $form = $(this);
    var action = $form.attr('action');
    //show some response on the button
    $('#login-btn', $form).each(function() {
        $btn = $(this);
        $btn.prop('type','button');
        $btn.prop('orig_label',$btn.val());
        $btn.val('Login ...');
    });

    $.ajax({
        type: "POST",
        url: action,
        data: $form.serialize(),
        success: after_login,
        dataType: 'json'
    });
});

$('#addForm').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    $form = $(this);
    var action = $form.attr('action');
    //show some response on the button
    $('#add-btn', $form).each(function() {
        $btn = $(this);
        $btn.prop('type','button');
        $btn.prop('orig_label',$btn.val());
        $btn.val('Sending ...');
    });

    $.ajax({
        type: "POST",
        url: action,
        data: $form.serialize(),
        success: after_form_submitted,
        dataType: 'json'
    });
});

$('#editForm').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    $form = $(this);
    var action = $form.attr('action');
    //show some response on the button
    $('#edit-btn', $form).each(function() {
        $btn = $(this);
        $btn.prop('type','button');
        $btn.prop('orig_label',$btn.val());
        $btn.val('Saving ...');
    });

    $.ajax({
        type: "POST",
        url: action,
        data: $form.serialize(),
        success: after_form_submitted,
        dataType: 'json'
    });
});

$('#question_img').on('change', function(event) {
    event.preventDefault();
    /* Act on the event */
    if (window.FormData === undefined) {
        alert('You are using a old browser. All features of this site would not be available.');
        return;
    }
    var input = $(this);
    var action = input.data('action');
    var label = input.prev('label');
    label.html('Uploading...');
    var file = this.files[0];
    var formData = new FormData();
    formData.append('image', file, file.name);
    $.ajax({
        url: action,
        type: 'POST',
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data){
            if (data.code === '200') {
                label.text('File Uploaded ' + data.filename);
                var inputHTML = '<input type="hidden" id="q_image" name="image" value="' + data.path + '" />'
                input.parents('.form-group').prepend(inputHTML);
                input.remove();
            } else if (data.code === '400') {
                label.text('Upload question image');
                input.siblings('.form_error').html(data.error);
            }
        }
    });
});

$('#addQuestionForm').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    $form = $(this);
    var action = $form.attr('action');
    //show some response on the button
    $('#add-btn', $form).each(function() {
        $btn = $(this);
        $btn.prop('type','button');
        $btn.prop('orig_label',$btn.val());
        $btn.val('Sending ...');
    });

    $.ajax({
        type: "POST",
        beforeSend: check_question_form,
        url: action,
        data: $form.serialize(),
        success: after_form_submitted,
        dataType: 'json'
    });
});

$('#editQuestionForm').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    $form = $(this);
    var action = $form.attr('action');
    //show some response on the button
    $('#edit-btn', $form).each(function() {
        $btn = $(this);
        $btn.prop('type','button');
        $btn.prop('orig_label',$btn.val());
        $btn.val('Saving ...');
    });

    $.ajax({
        type: "POST",
        beforeSend: check_question_form,
        url: action,
        data: $form.serialize(),
        success: after_form_submitted,
        dataType: 'json'
    });
});

$('#importQuestionForm').on('submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    if (window.FormData === undefined) {
        alert('You are using a old browser. All features of this site would not be available.');
        return;
    }
    $form = $(this);
    var action = $form.attr('action');
    var formData = new FormData(this);

    $('#add-btn', $form).each(function() {
        $btn = $(this);
        $btn.prop('type','button');
        $btn.prop('orig_label',$btn.val());
        $btn.val('Importing ...');
    });

    $.ajax({
        url: action,
        type: 'POST',
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if (data.code == '200') {
                $('#importQuestionForm').fadeOut(400);
                $('#newAddPrompt').fadeIn(400);
                $('#alertSuccess').find('strong').text('Success! ' + data.count );
                $('#alertSuccess').fadeIn(400).delay(10000).fadeOut(200)
            } else if (data.code == '400') {
                $('#alertDanger').fadeIn(400).delay(10000).fadeOut(200);
            }
            $('#add-btn', $form).each(function() {
                $btn = $(this);
                label = $btn.prop('orig_label');
                if (label) {
                    $btn.prop('type','submit' );
                    $btn.val(label);
                    $btn.prop('orig_label','');
                }
            });
        }
    });
});

function check_question_form() {
    var flag = true;
    if ($('#que_eng').val() === '' && $('#que_hindi').val() === '') {
        flag = false;
        $('#que_eng').addClass('is-invalid').parents('.form-group').find('.form_error').html('You must enter question at least either in Hindi or English.');
        $('#que_hindi').addClass('is-invalid').parents('.form-group').find('.form_error').html('You must enter question at least either in Hindi or English.');
    } else {
        if ($('#que_eng').val() !== '') {
            var engFields = $('.eng_queue');
            $.each(engFields, function(index, el) {
                if (el.value === '') {
                    if (el.id.indexOf('ans') !== -1) {
                        $(el).parents('.form-group').find('.form_error').html('Please provide answer key for the question.');
                    } else {
                        $(el).parents('.form-group').find('.form_error').html('Please provide this option for the question');
                    }
                    if (flag) {
                        flag = false;
                    }
                }
            });
        }
        if ($('#que_hindi').val() !== '') {
            var hindiFields = $('.hindi_queue');
            $.each(hindiFields, function(index, el) {
                if (el.value === '') {
                    if (el.id.indexOf('ans') !== -1) {
                        $(el).parents('.form-group').find('.form_error').html('Please provide answer key for the question.');
                    } else {
                        $(el).parents('.form-group').find('.form_error').html('Please provide this option for the question');
                    }
                    if (flag) {
                        flag = false;
                    }
                }
            });
        }
    }
    return flag;
}

$('#addForm input, #addQuestionForm input').on('keyup', function () {
    $(this).removeClass('is-invalid').addClass('is-valid');
    $(this).parents('.form-group').find('.form_error').html(" ");
});

$('#editForm input').on('keyup', function () {
    $(this).removeClass('is-invalid').addClass('is-valid');
    $(this).parents('.form-group').find('.form_error').html(" ");
});

function after_login(data) {
    $('#login-btn', $form).each(function() {
        label = $btn.prop('orig_label');
        if (label) {
            $btn.prop('type','submit');
            $btn.val(label);
            $btn.prop('orig_label','');
        }
    });
    if (data.code == '200') {
        $('#alertSuccess').fadeIn(400);
        setTimeout(function () {
            window.location.href = data.link;
        }, 4000);
    } else if(data.code == '401') {
        $.each(data.error, function(key, value) {
            $('#' + key).addClass('is-invalid');
            $('#' + key).parents('.input-group').next('.form_error').html(value);
        });
    } else {
        $('#alertDanger').fadeIn(400).delay(10000).fadeOut(200);
    }
}

function after_form_submitted(data) {
    if (data.code == '200') {
        $('#alertSuccess').fadeIn(400).delay(10000).fadeOut(200);
        if (document.getElementById('newAddPrompt')) {
            $('#addForm').slideUp(400);
            $('#addQuestionForm').slideUp(400);
            $('#newAddPrompt').slideDown(400);
            $('button#add-btn', $form).each(function() {
                $btn = $(this);
                label = $btn.prop('orig_label');
                if (label) {
                    $btn.prop('type','submit' );
                    $btn.val(label);
                    $btn.prop('orig_label','');
                }
            });
        }
        if (document.getElementById('editPrompt')) {
            $('button#edit-btn', $form).each(function() {
                $btn = $(this);
                label = $btn.prop('orig_label');
                if (label) {
                    $btn.prop('type','submit' );
                    $btn.val(label);
                    $btn.prop('orig_label','');
                }
            });
            $('#editForm').slideUp(400);
            $('#editQuestionForm').slideUp(400);
            $('#editPrompt').slideDown(400);
        }
    } else if(data.code == '202') {
        $('#alertSuccess').fadeIn(400).delay(10000).fadeOut(200);
        $('#data_' + $id).remove();
    } else if(data.code == '401') {
        $.each(data.error, function(key, value) {
            $('#' + key).addClass('is-invalid');
            $('#' + key).parents('.form-group').find('.form_error').html(value);
        });
        $('button#add-btn', $form).each(function() {
            $btn = $(this);
            label = $btn.prop('orig_label');
            if (label) {
                $btn.prop('type','submit' );
                $btn.val(label);
                $btn.prop('orig_label','');
            }
        });
        $('button#edit-btn', $form).each(function() {
            $btn = $(this);
            label = $btn.prop('orig_label');
            if (label) {
                $btn.prop('type','submit');
                $btn.val(label);
                $btn.prop('orig_label','');
            }
        });
    } else {
        $('#alertDanger').fadeIn(400).delay(10000).fadeOut(200);
    }
}

function add_new() {
    if (document.getElementById('addForm')) {
        document.getElementById('addForm').reset();
    }
    if (document.getElementById('addQuestionForm')) {
        document.getElementById('addQuestionForm').reset();
    }
    if (document.getElementById('importQuestionForm')) {
        document.getElementById('importQuestionForm').reset();
    }
    $('#newAddPrompt').fadeOut(300);
    $('#addForm').slideDown(400);
    $('#addQuestionForm').slideDown(400);
    $('#importQuestionForm').slideDown(400);
}

function no_new_add(link) {
    $('#addForm').slideDown(400);
    $('#addQuestionForm').slideDown(400);
    $('#importQuestionForm').slideDown(400);
    $('#newAddPrompt').fadeOut();
    window.location.href = link;
}

function edit_another(link) {
    $('#editPrompt').fadeOut(300);
    $('#editQuestionForm').slideDown(400);
    $('#editQu').slideDown(400);
    window.location.href = link;
}

function no_another_edit(link) {
    edit_another(link);
}

$('body').on('change', '#subject_select', function(event) {
    event.preventDefault();
    /* Act on the event */
    var $select = $(this);
    var id = $select.val();
    var base = $select.data('base');
    var obj = $select.data('object');
    var action = base + obj + '/' + id;
    if (id) {
        $.ajax({
            type: "GET",
            url: action,
            success: show_object,
            dataType: 'json'
        });
    } else {
        $select.append('<p>Please select a subject.</p>')
    }
});

$('body').on('change', '#test_select', function(event) {
    event.preventDefault();
    /* Act on the event */
    var $select = $(this);
    var id = $select.val();
    var base = $select.data('base');
    var action = base + 'question/' + id;
    if (id) {
        $.ajax({
            type: "GET",
            url: action,
            success: show_object,
            dataType: 'json'
        });
    } else {
        $select.append('<p>Please select a test.</p>')
    }
});

function show_object(data) {
    if (data.code == '200') {
        $('#object_list').html(data.objects);
    } else if (data.code == '400') {
        $('#object_list').html(data.objects);
    }
}

$('#confirmationModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var item = button.data('item'); // Extract info from data-* attributes
  var action = button.data('action');
  var baseUrl = button.data('base');
  $id = button.data('id');
  var actionUrl = baseUrl + ITEMS[item][action].method + $id;
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text(ITEMS[item][action].title);
  modal.find('.modal-body').text(ITEMS[item][action].prompt);
  modal.find('#confirm').removeAttr('onclick');
  modal.find('#confirm').attr('onClick', 'confirm(\''+ actionUrl + '\');');
})

var ITEMS = {
    'subject': {
        'remove': {
            'title': 'Delete Subject',
            'prompt': 'Are you sure, you want to delete this subject?',
            'method': 'subject/delete/'
        },
        'add': {
            'method': 'subject'
        },
    },
    'chapter': {
        'remove': {
            'title': 'Delete Chapter',
            'prompt': 'Are you sure, you want to delete this chapter?',
            'method': 'chapter/delete/'
        },
        'add': {
            'method': 'chapter'
        },
    },
    'test': {
        'remove': {
            'title': 'Delete Test',
            'prompt': 'Are you sure, you want to delete this test?',
            'method': 'test/delete/'
        },
        'add': {
            'method': 'test'
        },
    },
    'question': {
        'remove': {
            'title': 'Delete Question',
            'prompt': 'Are you sure, you want to delete this question?',
            'method': 'question/delete/'
        },
        'add': {
            'method': 'test'
        },
    }
}
