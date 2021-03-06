<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box" id="settings">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h3 class="col-xs-12">Add a new advertisement</h3>
                        <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-sm-12">
                                <label for="title">Link</label>
                                <input type="text" name="link" class="form-control" id="link" placeholder="Link">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="start">Start</label>
                                <input type="text" name="start"  id="start"
                                       class="form-control date"
                                       data-date-format="dd-mm-yyyy"
                                       placeholder="Start">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="end">End</label>
                                <input type="text" name="end"  id="end"
                                       class="form-control date"
                                       data-date-format="dd-mm-yyyy"
                                       placeholder="End">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="page">Pages</label>
                                <select id="page" name="page" class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($pages as $page) { ?>
                                        <option value="<?php echo $page; ?>"><?php echo $page; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="enabled">Enable</option>
                                    <option value="disabled" selected="">Disable</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-sm-6">
                                <label for="img">Advertisement image</label>
                                <input type="file" id="img" name="img">
                            </div>
                            <div class="clearfix"></div>
                            <div id="form-results"></div>
                            <div class="clearfix"></div>
                            <button id="submit-btn" class="btn btn-info submit-btn" style="float: left">Submit</button>
                        </form>                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->