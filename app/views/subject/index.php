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
                  <strong>Success!</strong> Subject deleted successfully
                </div>
                <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Oh snap!</strong> We couldn't delete the selected subject, try submitting again later.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><strong>All Subject </strong></h2>
                    </div>
                    <div class="panel-body">
                        <table class="table bootstrap-datatable countries">
                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align:center;">
                                        You added below subjects
                                    </th>
                                </tr>
                                <tr>
                                    <th>S No.</th>
                                    <th>Subject</th>
                                    <th>For Study</th>
                                    <th>For Test</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $s = 1;foreach ($subjects as $subject): ?>
                                <tr id="data_<?php echo $subject['id']; ?>">
                                    <td><?php echo $s; ?></td>
                                    <td><?php echo $subject['name']; ?></td>
                                    <td>
                                        <?php if ($subject['for_test'] == '1'): ?>
                                            <i class="fa fa-check text-green"></i>
                                        <?php else: ?>
                                            <i class="fa fa-close text-red"></i>
                                        <?php endif;?>
                                    </td>
                                    <td>
                                        <?php if ($subject['for_study'] == '1'): ?>
                                           <i class="fa fa-check text-green"></i>
                                       <?php else: ?>
                                           <i class="fa fa-close text-red"></i>
                                        <?php endif;?>
                                    </td>
                                    <td><?php echo $subject['created_at']; ?></td>
                                    <td><button class="btn btn-danger" data-id="<?php echo $subject['id']; ?>" data-base="<?php echo base_url(); ?>" data-item="subject" data-action="remove" data-toggle="modal" data-target="#confirmationModal"> <i class="fa fa-trash"></i></button></a><a class="btn btn-primary" href="<?php echo base_url(); ?>subject/edit/<?php echo $subject['id']; ?>" ><i class="fa fa-pencil"></i></a></td>
                                </tr>
                                <?php $s++;endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--/col-->
            <!-- statics end -->
        </div>
    </section>
</section>
<!--main content end-->
