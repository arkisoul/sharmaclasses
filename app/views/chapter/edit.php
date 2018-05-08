<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="">Home</a></li>
                    <li><i class="fa fa-file-text"></i>Chapter</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible alert-alert" role="alert" id="alertSuccess">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Success!</strong> Chapter updated successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't update chapter, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>Edit Chapter</strong></h2>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('chapter/update/' . $chapter['id'], array('id' => 'editForm', 'role' => 'form')); ?>
                            <div class="form-group">
                                <?php echo form_label('Enter Chapter Name:', 'name'); ?>
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('name', $chapter['name']); ?>" placeholder="Enter Chapter Name" id="name" autocomplete="true" autofocus="true" />
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Enter Chapter Name(Hindi):', 'name_hindi'); ?>
                                <input type="text" name="name_hindi" class="form-control" value="<?php echo set_value('name_hindi', $chapter['name_hindi']); ?>" placeholder="Enter Chapter Name in Hindi" id="name_hindi" autocomplete="true" autofocus="true" />
                                <div class="form_error"></div>
                             </div>
                            <div class="form-group">
                                <?php echo form_label('Select Subject Name'); ?>
                                <select name="subject_id" class="form-control" id="subject_id">
                                    <option value="" disabled selected>Choose your option</option>
                                    <?php foreach ($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id']; ?>" <?php if ($subject['id'] == $chapter['subject_id']): ?>
                                        selected
                                    <?php endif;?>><?php echo $subject['name']; ?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Enter Chapter Description:', 'content'); ?>
                                <textarea name="content" id="content" class="form-control" cols="30" rows="4" placeholder="Enter Chapter Content"><?php echo $chapter['content']; ?></textarea>
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
                            <div>Would you like to edit another subject?</div>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="edit_another('<?php echo base_url() . 'chapter'; ?>');">Edit</button>
                                <button class="btn btn-warning" onclick="no_another_edit('<?php echo base_url() . 'chapter'; ?>');">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
