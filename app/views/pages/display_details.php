    <div class="container reports" style="">
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
            <div class="col-md-12">
                <table class="table table-bordered table-stripe table-hover" id='report_details'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Borrower_Name</th>
                            <th>Type</th>
                            <th>Item_Code</th>
                            <th>Item_Name</th>
                            <th>Date_Borrowed</th>
                            <th>Date_Returned</th>
                            <th>Quantity</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody id="details">
                        <?php
                            if(!empty($data)){
                                foreach ($data as $key) {
                                    ?>
                                        <tr>
                                            <td><?php echo $key->id; ?></td>
                                            <td><?php echo $key->name; ?></td>
                                            <td><?php echo $key->transact_type; ?></td>
                                            <td><?php echo $key->code; ?></td>
                                            <td><?php echo $key->item_name; ?></td>
                                            <td><?php echo $key->date_borrowed; ?></td>
                                            <td><?php echo $key->date_returned; ?></td>         
                                            <td><?php echo $key->quantity; ?></td>
                                            <td style="text-transform: capitalize;">
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
                                        </tr>
                                    <?php
                                }
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Borrower_Name</th>
                            <th>Type</th>
                            <th>Item_Code</th>
                            <th>Item_Name</th>
                            <th>Date_Borrowed</th>
                            <th>Date_Returned</th>
                            <th>Quantity</th>
                            <th>Remarks</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
    </div>
    </div>
    <script>
        $(document).ready(function(){

            $('#month_year_choice').change(function(){
                const month = $(this).val();
                const by_month = 'monthly';
                if(month != ""){
                    $.ajax({
                        url       : '<?php echo base_url("User/monthly"); ?>',
                        type      : 'POST',
                        data      : {
                            month    : month,
                            by_month : by_month
                        },
                        success:function(data){
                            const log_oObj = JSON.parse(data);
                            if(log_oObj.query == true){
                                var html_equip = "";
                                log_oObj.data.forEach(element => {
                                    html_equip += '<tr>';
                                    html_equip +=     '<td>'+ element['id'] +'</td>';
                                    html_equip +=     '<td>' + element['name'] +'</td>';
                                    html_equip +=     '<td>' + element['transact_type'] +'</td>';
                                    html_equip +=     '<td>' + element['code'] +'</td>';
                                    html_equip +=     '<td>' + element['item_name'] +'</td>';
                                    html_equip +=     '<td>'+ element['date_borrowed'] +'</td>';
                                    html_equip +=     '<td>'+ element['date_returned'] +'</td>'
                                    html_equip +=     '<td>'+ element['quantity'] +'</td>';
                                    html_equip +=     '<td style="text-transform: capitalize;">'+ element['set_field'] +'</td>';
                                    html_equip += '</tr>';
                                });
                                $("#details").html(html_equip);
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
                    window.location.href = '<?php echo base_url('pages/reports/display_details/'); ?>';
                }
            });

            $('#report_details').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            } );

        });
    </script> 
</body>
</html> 