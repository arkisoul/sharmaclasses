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
                  <strong>Success!</strong> Chapter deleted successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't delete the selected chapter, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>Subject</strong></h2>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Please Select Subject Name:</label>
                            <select name="subject" class="form-control" id="subject_select" data-object="chapter" data-base="<?php echo base_url(); ?>">
                                <option value="" disabled selected>Choose your option</option>
                                <?php foreach ($subjects as $subject): ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 hidden-md hidden-sm hidden-xs"></div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>All Chapters</strong></h2>
                    </div>
                    <div class="panel-body">
                        <table class="table bootstrap-datatable countries">
                            <thead>
                                <tr>
                                    <th colspan="4" style="text-align:center;">
                                        List of chapters in selected subject
                                    </th>
                                </tr>
                                <tr>
                                    <th>S No.</th>
                                    <th>Chapter</th>
                                    <th style="width:50%;">Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="object_list">
                                <?php if (!$chapters): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Please select a subject</td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 hidden-md hidden-sm hidden-xs"></div>
        </div>
    </section>
</section>
<!--main content end-->
