<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="">Home</a></li>
                    <li><i class="fa fa-certificate"></i>Test</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible alert-alert" role="alert" id="alertSuccess">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Success!</strong> Test updated successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't update this new test, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>Edit Test</strong></h2>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('test/update/' . $test['id'], array('id' => 'editForm', 'role' => 'form')); ?>
                            <div class="form-group">
                                <?php echo form_label('Enter Test Name:', 'name'); ?>
                                <input type="text" class="form-control" name="name" id="name" autofocus="true" autocomplete="true" placeholder="Enter Test Name" value="<?php echo set_value('name', $test['name']); ?>" />
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Select Subject Name'); ?>
                                <select name="subject_id" class="form-control" id="subject_id">
                                    <option value="" disabled selected>Choose your option</option>
                                    <?php foreach ($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id']; ?>" <?php if ($subject['id'] == $test['subject_id']): ?>
                                        selected
                                    <?php endif;?>><?php echo $subject['name']; ?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Enter Test Duration:', 'time'); ?>
                                <input type="number" class="form-control" name="time" id="time" autocomplete="true" placeholder="Enter Test Duration in mins" value="<?php echo set_value('time', $test['time']); ?>" />
                                <div class="input-note">Note: Please enter time in only minute(integer)</div>
                                <div class="form_error"></div>
                             </div>
                            <div class="form-group">
                                <?php echo form_label('Enter No of Questions in The Test:', 'questions_num'); ?>
                                <input type="number" class="form-control" name="questions_num" id="questions_num" autocomplete="true" placeholder="Enter No of Questions" value="<?php echo set_value('questions_num', $test['questions_num']); ?>" />
                                <div class="form_error"></div>
                            </div>
                            <div class="checkbox">
                                <label class="checkbox-inline" for="is_active">
                                  <input type="checkbox" id="is_active" name="is_active" value="1" <?php if ($subject['is_active']) {echo 'checked';}?>> Is Active
                                </label>
                            </div>
                            <?php echo form_submit(array('value' => 'Edit', 'name' => 'submit', 'content' => 'Edit', 'class' => 'btn btn-primary', 'id' => 'edit-btn')); ?>
                        <?php echo form_close(); ?>
                        <div id="editPrompt">
                            <div>Would you like to edit another test?</div>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="edit_another('<?php echo base_url() . 'test'; ?>');">Edit</button>
                                <button class="btn btn-warning" onclick="no_another_edit('<?php echo base_url() . 'test'; ?>');">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
