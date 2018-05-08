<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="">Home</a></li>
                    <li><i class="fa fa-question"></i>Question</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible alert-alert" role="alert" id="alertSuccess">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Success!</strong> Question added successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't add this new question, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>Add Question</strong></h2>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('question/new', array('id' => 'addQuestionForm', 'role' => 'form', 'class' => 'row')); ?>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <?php echo form_label('Select Test Name', 'test_id'); ?>
                                    <select name="test_id" class="form-control" id="test_id">
                                        <option value="" disabled selected>Choose your option</option>
                                        <?php foreach ($tests as $test): ?>
                                        <option value="<?php echo $test['id']; ?>"><?php echo $test['name']; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <div class="form_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Question Details In Hindi</h4>
                                <div class="form-group">
                                    <?php echo form_label('Enter Question:', 'que_hindi'); ?>
                                    <input type="text" class="form-control que_queue", id="que_hindi" name="que_hindi" placeholder="Enter Question in Hindi" autocomplete="true" autofocus="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 1:', 'opt1_hindi'); ?>
                                    <input type="text" class="form-control hindi_queue", id="opt1_hindi" name="opt1_hindi" placeholder="Enter Option 1" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 2:', 'opt2_hindi'); ?>
                                    <input type="text" class="form-control hindi_queue", id="opt2_hindi" name="opt2_hindi" placeholder="Enter Option 2" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 3:', 'opt3_hindi'); ?>
                                    <input type="text" class="form-control hindi_queue", id="opt3_hindi" name="opt3_hindi" placeholder="Enter Option 3" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 4:', 'opt4_hindi'); ?>
                                    <input type="text" class="form-control hindi_queue", id="opt4_hindi" name="opt4_hindi" placeholder="Enter Option 4" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Answer:', 'ans_hindi'); ?>
                                    <input type="text" class="form-control hindi_queue", id="ans_hindi" name="ans_hindi" placeholder="Enter Answer" autocomplete="true">
                                    <div class="input-note">Note: Please enter correct option number i.e. 1, 2, 3 or 4</div>
                                    <div class="form_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Question Details In English</h4>
                                <div class="form-group">
                                    <?php echo form_label('Enter Question:', 'que_eng'); ?>
                                    <input type="text" class="form-control que_queue", id="que_eng" name="que_eng" placeholder="Enter Question in English" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 1:', 'opt1_eng'); ?>
                                    <input type="text" class="form-control eng_queue", id="opt1_eng" name="opt1_eng" placeholder="Enter Option 1" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 2:', 'opt2_eng'); ?>
                                    <input type="text" class="form-control eng_queue", id="opt2_eng" name="opt2_eng" placeholder="Enter Option 2" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 3:', 'opt3_eng'); ?>
                                    <input type="text" class="form-control eng_queue", id="opt3_eng" name="opt3_eng" placeholder="Enter Option 3" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Option 4:', 'opt4_eng'); ?>
                                    <input type="text" class="form-control eng_queue", id="opt4_eng" name="opt4_eng" placeholder="Enter Option 4" autocomplete="true">
                                    <div class="form_error"></div>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('Enter Answer:', 'ans_eng'); ?>
                                    <input type="text" class="form-control eng_queue", id="ans_eng" name="ans_eng" placeholder="Enter Answer" autocomplete="true">
                                    <div class="input-note">Note: Please enter correct option number i.e. 1, 2, 3 or 4</div>
                                    <div class="form_error"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 30px;">
                                    <div class="form-group">
                                        <label class="btn btn-default btn-file" for="question_img" style="width: 100%;">Upload question image</label>
                                        <input name="image" type="file" style="display: none;" id="question_img" data-action="<?php echo base_url(); ?>question/imgUpload" />
                                        <div class="input-note">Upload question image (if any)</div>
                                        <div class="form_error"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label class="checkbox-inline" for="is_active">
                                          <input type="checkbox" id="is_active" name="is_active" value="1" checked> Is Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <?php echo form_submit(array('value' => 'Add', 'name' => 'submit', 'content' => 'Add', 'class' => 'btn btn-primary', 'id' => 'add-btn')); ?>
                            </div>
                        <?php echo form_close(); ?>
                        <div id="newAddPrompt">
                            <div>Would you like to add another question?</div>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="add_new();">Add New</button>
                                <button class="btn btn-warning" onclick="no_new_add('<?php echo base_url() . 'question'; ?>');">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
