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
                  <strong>Success!</strong> Test added successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't add this new test, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>Add Test</strong></h2>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('test/new', array('id' => 'addForm', 'role' => 'form')); ?>
                            <div class="form-group">
                                <?php echo form_label('Enter Test Name:', 'name'); ?>
                                <?php echo form_input('name', '', array('class' => 'form-control', 'placeholder' => 'Enter Test Name', 'id' => 'name', 'autofocus' => 'TRUE', 'autocomplete' => 'TRUE')); ?>
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Select Subject Name'); ?>
                                <select name="subject_id" class="form-control" id="subject_id">
                                    <option value="" disabled selected>Choose your option</option>
                                    <?php foreach ($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Enter Test Duration:', 'time'); ?>
                                <?php echo form_input('time', '', array('class' => 'form-control', 'type' => 'number', 'placeholder' => 'Enter Test Duration in mins', 'id' => 'time', 'autocomplete' => 'TRUE')); ?>
                                <div class="input-note">Note: Please enter time in only minute(integer)</div>
                                <div class="form_error"></div>
                             </div>
                            <div class="form-group">
                                <?php echo form_label('Enter No of Questions in The Test:', 'questions_num'); ?>
                                <?php echo form_input('questions_num', '', array('class' => 'form-control', 'placeholder' => 'Enter No of Questions', 'type' => 'number', 'id' => 'questions_num', 'autocomplete' => 'TRUE')); ?>
                                <div class="form_error"></div>
                            </div>
                            <div class="checkbox">
                                <label class="checkbox-inline" for="is_active">
                                  <input type="checkbox" id="is_active" name="is_active" value="1" checked> Is Active
                                </label>
                            </div>
                            <?php echo form_submit(array('value' => 'Add', 'name' => 'submit', 'content' => 'Add', 'class' => 'btn btn-primary', 'id' => 'add-btn')); ?>
                        <?php echo form_close(); ?>
                        <div id="newAddPrompt">
                            <div>Would you like to add another test?</div>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="add_new();">Add New</button>
                                <button class="btn btn-warning" onclick="no_new_add('<?php echo base_url() . 'test'; ?>');">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
