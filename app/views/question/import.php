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
                  <strong>Success!</strong> Question imported successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't import questions, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>Import Questions</strong></h2>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('question/import', array('id' => 'importQuestionForm', 'role' => 'form')); ?>
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
                            <div class="form-group">
                                <label class="btn btn-default btn-file" for="question_upload" style="width: 100%;">Upload questions</label>
                                <input name="q_file" type="file" style="display: none;" id="question_upload" />
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_submit(array('value' => 'Import', 'name' => 'submit', 'content' => 'Import', 'class' => 'btn btn-primary', 'id' => 'add-btn')); ?>
                            </div>
                        <?php echo form_close(); ?>
                        <div id="newAddPrompt">
                            <div>Would you like to import another file?</div>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="add_new();">Import New</button>
                                <button class="btn btn-warning" onclick="no_new_add('<?php echo base_url() . 'question'; ?>');">No</button>
                            </div>
                        </div>
                        <div id="upload-instructions">
                            <h2 class="text-center">Instruction to upload questions:</h2>
                            <h4>Please follow below steps in order to upload questions by excel</h4>
                            <ol>
                                <li>Prepare a question file, save data in below table format. Note: please do not include the headers.</li>
                                <li>Save the file in Unicode Text file with .txt extension.</li>
                                <li>Select test for this question.</li>
                                <li>Upload .txt file created in step 2.</li>
                                <li>If you wish to include question either in Hindi or English, please leave the fields related to other language blank.</li>
                            </ol>
                            <div id="table-format">
                                <table class="table bootstrap-datatable countries">
                                    <thead>
                                        <tr>
                                            <th>Question in Hindi</th>
                                            <th>Option 1 for Hindi</th>
                                            <th>Option 2 for Hindi</th>
                                            <th>Option 3 for Hindi</th>
                                            <th>Option 4 for Hindi</th>
                                            <th>Answer for Hindi</th>
                                            <th>Question in English</th>
                                            <th>Option 1 for English</th>
                                            <th>Option 2 for English</th>
                                            <th>Option 3 for English</th>
                                            <th>Option 4 for English</th>
                                            <th>Answer for English</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <a href="<?php echo base_url() . 'question/downloadInstructions'; ?>" target="_blank">Download Import Instructions</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
