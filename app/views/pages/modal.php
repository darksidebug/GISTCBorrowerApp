<!-- Modal -->
<div id='myModal' class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Enter User Authentication Key:</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-control email__holder">
                        <input type="text" name="uid" id="uid" class="form-control email__input" placeholder="User ID" autofocus>
                        <i class="fa fa-id-card"></i>
                    </div>
                    <div class="form-control password__holder">
                        <input type="password" name="password" id="password" class="form-control password__input" placeholder="Password" autofocus>
                        <i class="fa fa-key"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_dismiss" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;CLOSE</button>
                    <button type="button" class="btn btn-primary btn_continue" id="btn_continue"><i class="fa fa-arrow-right"></i>&nbsp;CONTINUE</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->