<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="">Home</a></li>
                    <li><i class="fa fa-book"></i>Subject</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible alert-alert" role="alert" id="alertSuccess">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Success!</strong> Subject updated successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't update this subject, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>Edit Subject</strong></h2>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo base_url() . 'subject/update/' . $subject['id']; ?>" role="form" id="editForm" method="POST">
                            <div class="form-group">
                                <?php echo form_label('Enter Subject Name:', 'name'); ?>
                                <input type="text" name="name" class="form-control" placeholder="Enter Subject Name" value="<?php echo set_value('name', $subject['name']); ?>" id="name" autofocus autocomplete>
                                <div class="form_error"></div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Enter Subject Name(Hindi):', 'name_hindi'); ?>
                                <input type="text" name="name_hindi" class="form-control" placeholder="Enter Subject Name in Hindi" value="<?php echo set_value('name_hindi', $subject['name_hindi']); ?>" id="name_hindi" autocomplete>
                                <div class="form_error"></div>
                             </div>
                            <div class="form-group">
                                <div><?php echo form_label('Select Subject Category'); ?></div>
                                <label class="checkbox-inline" for="for_study">
                                  <input type="checkbox" id="for_study" name="for_study" value="1" <?php if ($subject['for_study']) {echo 'checked';}?>> For Study
                                </label>
                                <label class="checkbox-inline" for="for_test">
                                  <input type="checkbox" id="for_test" name="for_test" value="1" <?php if ($subject['for_test']) {echo 'checked';}?>> For Test
                                </label>
                                <label class="checkbox-inline" for="is_active">
                                  <input type="checkbox" id="is_active" name="is_active" value="1" <?php if ($subject['is_active']) {echo 'checked';}?>> Is Active
                                </label>
                            </div>
                            <?php echo form_submit(array('value' => 'Edit', 'name' => 'submit', 'content' => 'Edit', 'class' => 'btn btn-primary', 'id' => 'edit-btn')); ?>
                        <?php echo form_close(); ?>
                        <div id="editPrompt">
                            <div>Would you like to edit another subject?</div>
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="edit_another('<?php echo base_url() . 'subject'; ?>');">Edit</button>
                                <button class="btn btn-warning" onclick="no_another_edit('<?php echo base_url() . 'subject'; ?>');">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
