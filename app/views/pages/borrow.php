    
    <div class="container transaction">
        <form method="post">
            <div align='left'>
                <label for="">Please select:</label>
                <div class="transact">
                    <select name="transact_choice" id="transact_choice" class="form-control">
                        <option value="">-- Select type --</option>
                        <option value="Document">Document</option>
                        <option value="Equipment">Equipment</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col_md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-control holder__input">
                                <input type="text" name="id" id="id" class="form-control input" placeholder="ID Number" >
                            </div>
                            <div class="form-control holder__input">
                                <input type="text" name="name" id="name" class="form-control input" placeholder="Name"  readOnly='true'>
                            </div>
                            <div class="form-control holder__input">
                                <input type="text" name="dept" id="dept" class="form-control input" placeholder="College/Department"  readOnly='true'>
                            </div>
                            <div class="form-control holder__input">
                                <input type="text" name="contact" id="contact" class="form-control input" placeholder="Contact"  readOnly='true'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-control holder__input">
                                <input type="text" name="code" id="code" class="form-control input" placeholder="Serial/Code" >
                            </div>
                            <div class="form-control holder__input">
                                <input type="text" name="model__num" id="model__num" class="form-control input" placeholder="Model Number" >
                            </div>
                            <div class="form-control holder__input">
                                <input type="text" name="doc__name" id="doc__name" class="form-control input" placeholder="Name of Document/Equipment" >
                            </div>
                            <div class="form-control holder__input">
                                <input type="text" name="desc" id="desc" class="form-control input" placeholder="Description" >
                            </div>
                            <div class="form-control holder__input">
                                <input type="text" name="quantity" id="quantity" class="form-control input" placeholder="Quantity" >
                            </div>
                        </div>
                    </div>
                    <div class="row row_br">
                        <div class="col-md-6">
                            <label for="">Date Borrowed:</label>
                            <div class="form-control holder__input">
                                <input type="date" name="dateborrowed" id="dateborrowed" class="form-control input" placeholder="Date Borrowed" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Date to be Returned:</label>
                            <div class="form-control holder__input">
                                <input type="date" name="dateToreturn" id="dateToreturn" class="form-control input" placeholder="Date To Returned" >
                            </div>
                        </div>
                    </row>
                    <!-- <div class='noted__checkbox'>
                        <h5>Noted By:</h5>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                            <label class="custom-control-label" for="defaultUnchecked">FRANCIS REY F. PADAO</label>
                        </div>
                        <p>GIS TECHNOLOGY CENTER</p>
                    </div> -->
                    <div align="center">
                        <button type="button" name="btn__borrow" id="btn__borrow" class="btn btn-primary btn__borrow"><i class="fa fa-check"></i>&nbsp; BORROW</button>
                    </div>
                    <p id="footer">&COPY; GISTECHCENTER&nbsp;-&nbsp;All Rights Reserved 2019</p>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){

            $('#id').blur(function(){
                const id_num = $('#id').val();
                const get__borrower_data = 'get__borrower_data';
                $.ajax({
                    url  : '<?php echo base_url("User/get_borrower"); ?>',
                    type : 'POST',
                    data : {
                        id_num             : id_num,
                        get__borrower_data : get__borrower_data
                    },
                    success:function(data){
                        const log_oObj = JSON.parse(data);
                        if(log_oObj.data_set == true){
                            $('#name').val(log_oObj.borrower_name);
                            $('#dept').val(log_oObj.borrower_dept);
                            $('#contact').val(log_oObj.borrower_cont);
                        }
                        else{
                            swal(
                                {
                                    title: "Invalid ID",
                                    text: log_oObj.msg,
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Yes, Register now!",
                                    cancelButtonText: "No, cancel plx!",
                                    closeOnConfirm: true,
                                    closeOnCancel: true 
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.href = '<?php echo base_url('pages/register/'); ?>';
                                    }
                                }
                            );
                        }
                    }
                });
            });

            $('#btn_continue').click(function(event){
                event.preventDefault();
                const borrow            = 'borrow_items';
                const transact_choice = $('#transact_choice').val();
                const id_num          = $('#id').val();
                const code            = $('#code').val();
                const model__num      = $('#model__num').val();
                const doc_name        = $('#doc__name').val();
                const desc            = $('#desc').val();
                const quantity        = $('#quantity').val();
                const dateborrowed    = $('#dateborrowed').val();
                const dateToreturn    = $('#dateToreturn').val();
                const uid             = $('#uid').val();
                const password        = $('#password').val();

                if(uid != '' && password != ''){
                    $.ajax({
                        url  : '<?php echo base_url("user/borrow_items"); ?>',
                        type : 'POST',
                        data : {
                            borrow          : borrow,
                            id_num          : id_num,
                            transact_choice : transact_choice,
                            code            : code,
                            model__num      : model__num,
                            doc_name        : doc_name,
                            desc            : desc,
                            quantity        : quantity,
                            dateborrowed    : dateborrowed,
                            dateToreturn    : dateToreturn,
                            uid             : uid,
                            password        : password
                        },
                        success:function(data){
                            $('#myModal').modal('hide');
                            const log_oObj = JSON.parse(data);
                            if(log_oObj.registered == true){
                                swal(
                                    {
                                        title: "Successfull",
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
                                            window.location.href = '<?php echo base_url('pages/borrow/'); ?>';
                                        }
                                    }
                                );
                            }
                            else{
                                swal(
                                {
                                    title: "No Match Found",
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
                            title: "Authentication",
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

            $('#btn__borrow').click(function(event){
                event.preventDefault();
                const transact_choice = $('#transact_choice').val();
                const id_num          = $('#id').val();
                const name            = $('#name').val();
                const department      = $('#dept').val();
                const contact         = $('#contact').val();
                const code            = $('#code').val();
                const model__num      = $('#model__num').val();
                const doc_name        = $('#doc_name').val();
                const desc            = $('#desc').val();
                const quantity        = $('#quantity').val();
                const dateborrowed    = $('#dateborrowed').val();
                const dateToreturn    = $('#dateToreturn').val();
                const uid             = $('#uid').val();
                const password        = $('#password').val();

                if(name != '' && transact_choice != '' && id_num != '' && department != '' && contact != '' 
                && code != '' && model__num != '' && doc_name != '' && desc != '' && quantity != '' 
                && dateborrowed != '' && dateToreturn != ''){
                    $('#myModal').modal('show');
                }
                else{
                    swal(
                        {
                            title: "Borrow failed",
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
        });
    </script>           

</body>
</html>