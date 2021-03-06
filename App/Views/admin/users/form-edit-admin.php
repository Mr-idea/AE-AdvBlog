<div class="modal fade" id="edit-user-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit <i><?php echo $name; ?></i></h4>
                <image src='<?php echo $img; ?>' style="height: 50px; width: 50px; border-radius: 100%" alt=''>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action; ?>" class="form-modal form" method="POST" enctype="multipart/form-data">
                    <?php if ($id === $admin) { ?>
                        <div class="form-group col-sm-6">
                            <label for="username">Username</label>
                            <input type="text" name="name" class="form-control" id="username" placeholder="Username" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control"
                                   name="email" placeholder="someone@example.com"
                                   value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="pass">Password</label>
                            <input type="password" id="pass" class="form-control" name="pass" placeholder="Choose a password">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="re-pass">Confirm Password</label>
                            <input type="password" id="re-pass" class="form-control" name="re-pass" placeholder="Re-Type password">
                        </div>
                    <?php } else { ?>
                        <div class="form-group col-sm-6">
                            <label>Email</label>
                            <input type="text" class="form-control disabled" disabled="disabled"
                                   value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="status">Status</label>
                            <?php
                            if ($status == 'disabled') {
                                ?>
                                <span style="color:red">Disabled</span>
                                <?php
                            }
                            ?>
                            <select id="status" class="form-control" name="status">
                                <option value="enabled" <?php
                                if ($status == 'enabled') {
                                    echo 'selected=""';
                                }
                                ?>>Enable</option>
                                <option value="disabled"  <?php
                                if ($status == 'disabled') {
                                    echo 'selected=""';
                                }
                                ?>>Disable</option>
                            </select>
                        </div>
                    <?php } if ($id === $admin) { ?>
                        <div class="form-group col-sm-6">
                            <label for="img">Profile photo</label>
                            <input type="file" id="img" name="img">
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <div id="form-results"></div>
                    <div class="clearfix"></div>                    <button id="submit-btn" class="btn btn-info submit-btn">Submit</button>
                    <input type="hidden" name="code" value="<?php echo $code; ?>" >
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>