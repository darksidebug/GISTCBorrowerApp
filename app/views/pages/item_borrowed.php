    
        <div class="container return">
            <?php
                foreach ($info as $key) {
                    ?>
                        <input type="hidden" name="id" id="id" value='<?php echo $key->ID_num ?>'>
                    <?php
                }
            ?>
            <input type="hidden" name="return" id="return" value='return_items'>
            <div align='left' id="info">
                <label for="" id="borrower_name">Borrower name:
                    <span>
                        <?php
                            foreach ($info as $key) {
                                echo $key->name;
                            }
                            
                        ?>
                    </span>
                </label></br>
                <label for="" id="borrower_dept">College/Dept:
                    <span>
                        <?php
                            foreach ($info as $key) {
                                echo $key->dept;
                            }
                            
                        ?>
                    </span>
                </label></br>
                <label for="" id="borrower_contact">Contact:
                    <span>
                        <?php
                            foreach ($info as $key) {
                                echo $key->contact;
                            }
                            
                        ?>
                    </span>
                </label>
            </div>
            <div align='left' id='date'>
                <label for="">Please select date returned:</label>
                <div class="date">
                    <input type="date" name="dateReturned" id="dateReturned" class="form-control">
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover" id="table__borrowed_items">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Type</th>
                        <th>Item/Docs Borrowed</th>
                        <th>Serial/Code</th>
                        <th>Date_Borrowed</th>
                        <th>Date_To_Returned</th>
                        <th>Quantity</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="borrower">
                    <?php
                        if(!empty($data)){
                            foreach ($data as $key) {
                                ?>
                                    <tr>
                                        <td><?php echo $key->id; ?><input type="hidden" class="id" name="code" id="<?php echo $key->id ?>" value=''></td>
                                        <td><?php echo $key->transact_type; ?><input type="hidden" class="transact_type" name="code" id="<?php echo $key->transact_type ?>" value=''></td>
                                        <td><a href="<?php echo base_url('pages/details/borrow_detail/'.$key->ID_num.'/not_returned'.'/'.$key->set_field); ?> "><?php echo $key->item_name; ?></a></td>
                                        <td><?php echo $key->code; ?><input type="hidden" class="code" name="code" id="<?php echo $key->code ?>" value=''></td>
                                        <td><?php echo $key->date_borrowed; ?></td>
                                        <td><?php echo $key->date_to_returned; ?></td>         
                                        <td><?php echo $key->quantity; ?></td>
                                        <td style="text-transform: capitalize; font-weight: bold; letter-spacing: 0.02rem;">
                                            <?php
                                                if($key->set_field == 'approved'){
                                                    ?>
                                                        <i class="fa fa-thumbs-up" style="color: #6EAA00; font-size: 20px;"></i>
                                                    <?php
                                                }
                                                if($key->set_field == 'pending'){
                                                    ?>
                                                        <i class="fa fa-arrow-circle-up" style="color: orange; font-size: 20px;"></i>
                                                    <?php
                                                }
                                                if($key->set_field == 'returned'){
                                                    ?>
                                                        <i class="fa fa-undo" style="color: #3E3EFF; font-size: 18px;"></i>
                                                    <?php
                                                }
                                                if($key->set_field == 'denied' || $key->set_field == 'cancelled'){
                                                    ?>
                                                        <i class="fa fa-times-circle" style="color: red; font-size: 18px;"></i>
                                                    <?php
                                                }
                                            ?>
                                            <?php echo $key->set_field; ?></td>
                                        <td>
                                            <?php
                                                if($key->set_field == 'approved' && $key->set_onOff_history == 'On'){
                                                    ?>
                                                        <button class="btn btn-warning btn-sm btn__return" id="<?php echo $key->ID_num ?>"><i class="fa fa-undo"></i></button>
                                                    <?php
                                                }
                                                if($key->set_field == 'pending' && $key->set_onOff_history == 'On'){
                                                    ?>
                                                        <button class="btn btn-danger btn-sm btn__cancel" id="<?php echo $key->ID_num ?>"><i class="fa fa-times"></i></button>
                                                    <?php
                                                }
                                            ?> 
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Item Type</th>
                        <th>Item/Docs Borrowed</th>
                        <th>Serial/Code</th>
                        <th>Date_Borrowed</th>
                        <th>Date_To_Returned</th>
                        <th>Quantity</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <p id="footer">&COPY; GISTECHCENTER&nbsp;-&nbsp;All Rights Reserved 2019</p>
        </div>
        <script>
            $(document).ready(function(){

                $('.btn__return').click(function(){
                    const dateReturn      = $('#dateReturned').val();
                    if(dateReturn != ""){
                        swal(
                            {
                                title: "Confirm",
                                text : 'Are you sure you want to continue?',
                                type : "warning",
                                showCancelButton  : true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText : "Ok, Continue!",
                                cancelButtonText  : "No, Cancel plx!",
                                closeOnConfirm    : true,
                                closeOnCancel     : true 
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    $('#myModal').modal('show');
                                }
                            }
                        );
                    }
                    else{
                        swal(
                            {
                                title: "Empty field",
                                text : 'Please select date!',
                                type : "warning",
                                showCancelButton  : false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText : "Ok",
                                cancelButtonText  : "",
                                closeOnConfirm    : true,
                                closeOnCancel     : false 
                            }
                        );
                    }
                });

                $('.btn__cancel').click(function(){
                        const dateReturn      = $('#dateReturned').val();
                        if(dateReturn != ""){
                            swal(
                                {
                                    title: "Confirm",
                                    text : 'Are you sure you want to continue?',
                                    type : "warning",
                                    showCancelButton  : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "Ok, Continue!",
                                    cancelButtonText  : "No, Cancel plx!",
                                    closeOnConfirm    : true,
                                    closeOnCancel     : true 
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        $('#myModal_cancel').modal('show');
                                    }
                                }
                            );
                        }
                        else{
                            swal(
                                {
                                    title: "Empty field",
                                    text : 'Please select date!',
                                    type : "warning",
                                    showCancelButton  : false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText : "Ok",
                                    cancelButtonText  : "",
                                    closeOnConfirm    : true,
                                    closeOnCancel     : false 
                                }
                            );
                        }
                });

                $('#btn_continue').click(function(){
                    const id_num          = $('#id').val();
                    const dateReturn      = $('#dateReturned').val();
                    const uid             = $('#uid').val();
                    const password        = $('#password').val();
                    const returned        = $('#return').val();
                    const code            = $('.code').attr('id');
                    const id              = $('.id').attr('id');
                    const transact_type   = $('.transact_type').attr('id');

                    if(uid != '' && password != ''){
                        $.ajax({
                            url  : '<?php echo base_url("user/return_items"); ?>',
                            type : 'POST',
                            data : {
                                returned        : returned,
                                id_num          : id_num,
                                code            : code,
                                dateReturn      : dateReturn,
                                uid             : uid,
                                password        : password,
                                id              : id,
                                transact_type   : transact_type
                            },
                            success:function(data){
                                $('#myModal').modal('hide');
                                const log_oObj = JSON.parse(data);
                                if(log_oObj.returned == true){
                                    swal(
                                        {
                                            title: "Returned successfull",
                                            text : log_oObj.msg,
                                            type : "success",
                                            showCancelButton  : false,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText : "Ok",
                                            cancelButtonText  : "",
                                            closeOnConfirm    : true,
                                            closeOnCancel     : false 
                                        },
                                        function(isConfirm) {
                                            if (isConfirm) {
                                                window.location.href = '<?php echo base_url('pages/main/main_page/Equipment/Document/not_returned'); ?>';
                                            }
                                        }
                                    );
                                }
                                else{
                                    swal(
                                        {
                                            title: "Returned failed",
                                            text : log_oObj.msg,
                                            type : "error",
                                            showCancelButton  : false,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText : "Ok",
                                            cancelButtonText  : "",
                                            closeOnConfirm    : true,
                                            closeOnCancel     : false 
                                        }
                                    );
                                }
                            }
                        });
                    }
                    else{
                        swal(
                            {
                                title: "Authentication failed",
                                text : 'All fields are required!',
                                type : "warning",
                                showCancelButton  : false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText : "Ok",
                                cancelButtonText  : "",
                                closeOnConfirm    : true,
                                closeOnCancel     : false 
                            }
                        );
                    }
                });

                $('#btn_continue_cancel').click(function(){
                    const id_num          = $('#id').val();
                    const dateReturn      = $('#dateReturned').val();
                    const uid             = $('#uid_cancel').val();
                    const password        = $('#uid_password').val();
                    const cancelled       = 'cancel';
                    const code            = $('.code').attr('id');
                    const id              = $('.id').attr('id');
                    const transact_type   = $('.transact_type').attr('id');

                    if(uid != '' && password != ''){
                        $.ajax({
                            url  : '<?php echo base_url("user/cancel_items"); ?>',
                            type : 'POST',
                            data : {
                                cancelled       : cancelled,
                                id_num          : id_num,
                                code            : code,
                                dateReturn      : dateReturn,
                                uid             : uid,
                                password        : password,
                                id              : id,
                                transact_type   : transact_type
                            },
                            success:function(data){
                                $('#myModal').modal('hide');
                                const log_oObj = JSON.parse(data);
                                if(log_oObj.returned == true){
                                    swal(
                                        {
                                            title: "Cancel successfull",
                                            text : log_oObj.msg,
                                            type : "success",
                                            showCancelButton  : false,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText : "Ok",
                                            cancelButtonText  : "",
                                            closeOnConfirm    : true,
                                            closeOnCancel     : false 
                                        },
                                        function(isConfirm) {
                                            if (isConfirm) {
                                                window.location.href = '<?php echo base_url('pages/main/main_page/Equipment/Document/not_returned'); ?>';
                                            }
                                        }
                                    );
                                }
                                else{
                                    swal(
                                        {
                                            title: "Cancel failed",
                                            text : log_oObj.msg,
                                            type : "error",
                                            showCancelButton  : false,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText : "Ok",
                                            cancelButtonText  : "",
                                            closeOnConfirm    : true,
                                            closeOnCancel     : false 
                                        }
                                    );
                                }
                            }
                        });
                    }
                    else{
                        swal(
                            {
                                title: "Authentication failed",
                                text : 'All fields are required!',
                                type : "warning",
                                showCancelButton  : false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText : "Ok",
                                cancelButtonText  : "",
                                closeOnConfirm    : true,
                                closeOnCancel     : false 
                            }
                        );
                    }
                });

                $('#table__borrowed_items').DataTable();
            });
        </script>
    </body>
</html>