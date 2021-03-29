
    <div class="container main__page">
        <div class="row">
            <div class="col-md-12">
                <h4>EQUIPMENT</h4>
                <table class='table table-bordered table-stripe table-hover' id="tbl_equip">
                    <thead>
                        <tr>
                            <th>ID's</th>
                            <th>Name of Borrower</th>
                            <th>Date Borrow</th>
                            <th>Authorized_By</th>
                            <th>Approved_By</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody id='equipment'>
                        <?php
                            foreach ($equip as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value->ID_num; ?></td>
                                        <td><a href="<?php echo base_url('pages/details/item_borrowed/'.$value->ID_num.'/not_returned'.'/'.$value->set_field); ?> "><?php echo $value->name; ?></a></td>
                                        <td><?php echo $value->date_borrowed; ?></td>
                                        <td><?php echo $value->auth_by_uid; ?></td>
                                        <td><?php echo $value->approval_u_id; ?></td>
                                        <td style="text-transform: capitalize; font-weight: bold; letter-spacing: 0.02rem;">
                                            <?php
                                                if($value->set_field == 'approved'){
                                                    ?>
                                                        <i class="fa fa-thumbs-up" style="color: #6EAA00; font-size: 20px;"></i>
                                                    <?php
                                                }
                                                if($value->set_field == 'pending'){
                                                    ?>
                                                        <i class="fa fa-arrow-circle-up" style="color: orange; font-size: 20px;"></i>
                                                    <?php
                                                }
                                                if($value->set_field == 'denied' || $value->set_field == 'cancelled'){
                                                    ?>
                                                        <i class="fa fa-times-circle" style="color: red; font-size: 18px;"></i>
                                                    <?php
                                                }
                                                if($value->set_field == 'returned'){
                                                    ?>
                                                        <i class="fa fa-undo" style="color: #3E3EFF; font-size: 19px;"></i>
                                                    <?php
                                                }
                                            ?> 
                                            <?php echo $value->set_field; ?>
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
                            <th>Approved_By</th>
                            <th>Remarks</th>
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
                            <th>Approved_By</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody id="document">
                        <?php
                            foreach ($docs as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value->ID_num; ?></td>
                                        <td><a href="<?php echo base_url('pages/details/item_borrowed/'.$value->ID_num.'/not_returned'.'/'.$value->set_field); ?> "><?php echo $value->name; ?></a></td>
                                        <td><?php echo $value->date_borrowed; ?></td>
                                        <td><?php echo $value->auth_by_uid; ?></td>
                                        <td><?php echo $value->approval_u_id; ?></td>
                                        <td style="text-transform: capitalize; font-weight: bold; letter-spacing: 0.02rem;">
                                            <?php
                                                if($value->set_field == 'approved'){
                                                    ?>
                                                        <i class="fa fa-thumbs-up" style="color: #588800; font-size: 20px;"></i>
                                                    <?php
                                                }
                                                if($value->set_field == 'pending'){
                                                    ?>
                                                        <i class="fa fa-arrow-circle-up" style="color: orange; font-size: 20px;"></i>
                                                    <?php
                                                }
                                                if($value->set_field == 'denied' || $value->set_field == 'cancelled'){
                                                    ?>
                                                        <i class="fa fa-times" style="color: red; font-size: 18px;"></i>
                                                    <?php
                                                }
                                                if($value->set_field == 'returned'){
                                                    ?>
                                                        <i class="fa fa-undo" style="color: #3E3EFF; font-size: 18px;"></i>
                                                    <?php
                                                }
                                            ?> 
                                            <?php echo $value->set_field; ?>
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
                            <th>Approved_By</th>
                            <th>Remarks</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>          
    <script>
        $(document).ready(function(){

            $('#tbl_equip').DataTable();
            $('#tbl_docs').DataTable();

        });
    </script>       

</body>
</html> 