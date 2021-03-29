    <div class="container pending">
        <div class="row">
            <div class="col-md-4">
            <div align='left'>
                <label for="">Please select:</label>
                <div class="month_year">
                    <select name="month_year_choice" id="month_year_choice" class="form-control">
                        <option value="">Select Month</option>
                        <option value="1">January - <?php echo date('Y'); ?></option>
                        <option value="2">February - <?php echo date('Y'); ?></option>
                        <option value="3">March - <?php echo date('Y'); ?></option>
                        <option value="4">April - <?php echo date('Y'); ?></option>
                        <option value="5">May - <?php echo date('Y'); ?></option>
                        <option value="6">June - <?php echo date('Y'); ?></option>
                        <option value="7">July - <?php echo date('Y'); ?></option>
                        <option value="8">August - <?php echo date('Y'); ?></option>
                        <option value="9">September - <?php echo date('Y'); ?></option>
                        <option value="10">October - <?php echo date('Y'); ?></option>
                        <option value="11">November - <?php echo date('Y'); ?></option>
                        <option value="12">December - <?php echo date('Y'); ?></option>
                    </select>
                </div>
            </div>
            </div>
            <div class="col-md-8"></div>
        </div>
        <div class="row">
            <input type="hidden" class="position_classification" id="position_classification" value="<?php echo $this->session->userdata('position'); ?>">
            <input type="hidden" class="user_classification" id="user_classification" value="<?php echo $this->session->userdata('username'); ?>">
            <div class="col-md-12">
                <h4>EQUIPMENT</h4>
                <table class='table table-bordered table-stripe table-hover' id="tbl_equip">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name of Borrower</th>
                            <th>Date Borrow</th>
                            <th>Authorized By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='equipment'>
                        <?php
                            foreach ($equip as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value->ID_num; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->date_borrowed; ?>
                                            <input type="hidden" class="code" name="code" id="<?php echo $value->id; ?>" value="<?php echo $value->transact_type; ?>">
                                        </td>
                                        <td><?php echo $value->auth_by_uid; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning btn__approve" id='<?php echo $value->id; ?>'><i class="fa fa-thumbs-up"></i></button>
                                            <button class="btn btn-sm btn-danger btn__cancel" id='<?php echo $value->id; ?>'><i class="fa fa-thumbs-down"></i></button>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name of Borrower</th>
                            <th>Date Borrow</th>
                            <th>Authorized By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12">
                <h4>DOCUMENTS</h4>
                <table class='table table-bordered table-stripe table-hover' id="tbl_docs">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name of Borrower</th>
                            <th>Date Borrow</th>
                            <th>Authorized By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="document">
                        <?php
                            foreach ($docs as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value->ID_num; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->date_borrowed; ?>
                                            <input type="hidden" class="code" name="code" id="<?php echo $value->id; ?>" value="<?php echo $value->transact_type; ?>">
                                        </td>
                                        <td><?php echo $value->auth_by_uid; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning btn__approve" id='<?php echo $value->id; ?>'><i class="fa fa-thumbs-up"></i></button>
                                            <button class="btn btn-sm btn-danger btn__cancel" id='<?php echo $value->id; ?>'><i class="fa fa-thumbs-down"></i></button>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name of Borrower</th>
                            <th>Date Borrow</th>
                            <th>Authorized By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>          
    <script>
        $(document).ready(function(){

            $(document).on('click', '.btn__approve', function(){
                const id       = $(this).attr('id');
                const type     = $('#'+ id).val();
                const position = $('#position_classification').val();
                const uid      = $('#user_classification').val();
                const approved = "approved";
                $.ajax({
                    url       : '<?php echo base_url("User/borrow_approval"); ?>',
                    type      : 'POST',
                    data      : {
                        id        : id,
                        type      : type,
                        uid       : uid,
                        position  : position,
                        approved  : approved
                    },
                    success:function(data){
                        const log_oObj = JSON.parse(data);
                        if(log_oObj.approved == true){
                            swal(
                                {
                                    title: "Success",
                                    text: log_oObj.msg,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "OK",
                                    cancelButtonText: "",
                                    closeOnConfirm: true,
                                    closeOnCancel: true 
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.href = '<?php echo base_url('pages/admin/approval/Equipment/Document/not_returned/pending'); ?>';
                                    }
                                }
                            );
                        }
                    }
                });
            });

            $(document).on('click', '.btn__cancel', function(){
                const id       = $(this).attr('id');
                const type     = $('#'+ id).val();
                const position = $('#position_classification').val();
                const uid      = $('#user_classification').val();
                const denied   = "denied";
                $.ajax({
                    url       : '<?php echo base_url("User/denied_approval"); ?>',
                    type      : 'POST',
                    data      : {
                        id        : id,
                        type      : type,
                        uid       : uid,
                        position  : position,
                        denied    : denied
                    },
                    success:function(data){
                        const log_oObj = JSON.parse(data);
                        if(log_oObj.approved == true){
                            swal(
                                {
                                    title: "Denied",
                                    text: log_oObj.msg,
                                    type: "info",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "OK",
                                    cancelButtonText: "",
                                    closeOnConfirm: true,
                                    closeOnCancel: true 
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.href = '<?php echo base_url('pages/admin/approval/Equipment/Document/not_returned/pending'); ?>';
                                    }
                                }
                            );
                        }
                    }
                });
            });

            $('#month_year_choice').change(function(){
                const month = $(this).val();
                const query = 'monthly';
                if(month != ""){
                    $.ajax({
                        url       : '<?php echo base_url("User/query_by_month"); ?>',
                        type      : 'POST',
                        data      : {
                            month : month,
                            query : query
                        },
                        success:function(data){
                            const log_oObj = JSON.parse(data);
                            if(log_oObj.query == true){

                                log_oObj.data.forEach(element => {

                                    if(element['transact_type'] == 'Equipment')
                                    {
                                        var html_equip = "";
                                        html_equip += '<tr>';
                                        html_equip +=     '<td>'+ element['ID_num'] +'</td>';
                                        html_equip +=     '<td>' + element['name'] +'</td>';
                                        html_equip +=     '<td>'+ element['date_borrowed'] +'</td><input type="hidden" class="code" name="code" id='+ element['id']+ ' value='+ element['transact_type'] +'>';
                                        html_equip +=     '<td>'+ element['auth_by_uid'] +'</td>'
                                        html_equip +=     '<td>';
                                        html_equip +=         '<button class="btn btn-sm btn-warning btn__approve" id='+ element['id'] +' style="margin-right: 3.5px; background-color: #df8609;"><i class="fa fa-thumbs-up"></i></button>';
                                        html_equip +=         '<button class="btn btn-sm btn-danger btn__cancel" id='+ element['id'] +'><i class="fa fa-thumbs-down"></i></button>';
                                        html_equip +=     '</td>';
                                        html_equip += '</tr>';
                                        $("#equipment").html(html_equip);
                                    }
                                    if(element['transact_type'] == 'Document')
                                    {
                                        var html_docs = "";
                                        html_docs += '<tr>';
                                        html_docs +=     '<td>'+ element['ID_num'] +'</td>';
                                        html_docs +=     '<td>'+ element['name'] +'</td>';
                                        html_docs +=     '<td>'+ element['date_borrowed'] +'</td><input type="hidden" class="code" name="code" id='+ element['id']+ ' value='+ element['transact_type'] +'>';
                                        html_docs +=     '<td>'+ element['auth_by_uid'] +'</td>'
                                        html_docs +=     '<td>';
                                        html_docs +=         '<button class="btn btn-sm btn-warning btn__approve" id='+ element['id'] +' style="margin-right: 3.5px; background-color: #df8609;"><i class="fa fa-thumbs-up"></i></button>';
                                        html_docs +=         '<button class="btn btn-sm btn-danger btn__cancel" id='+ element['id'] +'><i class="fa fa-thumbs-down"></i></button>';
                                        html_docs +=     '</td>';
                                        html_docs += '</tr>';
                                        $("#document").html(html_docs);
                                    }
                                    
                                });
                                
                            }
                            else{
                                swal(
                                    {
                                        title: "No result found !",
                                        text: 'No pending for approval.',
                                        type: "warning",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "OK",
                                        cancelButtonText: "",
                                        closeOnConfirm: true,
                                        closeOnCancel: true 
                                    }
                                );
                            }
                        }
                    });
                }
                else{
                    window.location.href = '<?php echo base_url('pages/admin/approval/Equipment/Document/not_returned/pending'); ?>';
                }
            });

            $('#tbl_equip').DataTable();
            $('#tbl_docs').DataTable();
        });
    </script>       

</body>
</html> 