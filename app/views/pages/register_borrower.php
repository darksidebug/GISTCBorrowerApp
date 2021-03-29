
    <div class="container-fluid banners">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 errors">
                <p>
                    <?php echo validation_errors(); ?>
                </p>
            </div>
            <form id="form_register">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 parent">
                        <div class="belt">
                            <div class="registration_form">   
                                <div class="form-control email__holder">
                                    <input type="text" name="id" id="id" class="form-control email__input" placeholder="School ID" required>
                                    <i class="fa fa-id-card"></i>
                                </div>
                                <div class="form-control password__holder">
                                    <input type="text" name="name" id="name" class="form-control password__input" placeholder="Name" required>
                                    <i class="fa fa-user-circle"></i>
                                </div>
                                <div class="form-control cfm_password__holder">
                                    <input type="text" name="dept" id="dept" class="form-control cfm_password__input" required placeholder="College/Department">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="form-control contact__holder">
                                    <input type="text" name="contact" id="contact" class="form-control contact__input" required placeholder="Contact No.">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div align="center">
                                    <button type="submit" name="register" id="register" class="btn__register"><i class="fa fa-edit"></i>&nbsp;REGISTER</button>
                                </div>
                            </div>
                        </div>
                        <p id="footer">&copy; GISTECHCENTER&nbsp;-&nbsp;All Rights Reserved 2019</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    
    <script>
        $(document).ready(function(event){

            $('#register').click(function(event){
                event.preventDefault();
                var id = $('#id').val();
                var name = $('#name').val();
                var dept = $('#dept').val();
                var contact = $('#contact').val();
                const register = 'register';
                if(id != "" && name != "" && dept != "" && contact != ""){
                    $.ajax({
                        url: '<?php echo base_url("user/register"); ?>',
                        type: 'post',
                        data: {
                            id           : id,
                            name         : name,
                            contact      : contact,
                            dept         : dept,
                            register     : register
                        },
                        success:function(data){
                            const register_oObj = JSON.parse(data);
                            if(register_oObj.allowed == 'yes'){
                                swal(
                                    {
                                        title: "Registered",
                                        text : register_oObj.msg,
                                        type : "warning",
                                        showCancelButton  : false,
                                        showConfirmButton : true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText : "Ok",
                                        cancelButtonText  : "",
                                        closeOnConfirm    : true,
                                        closeOnCancel     : false 
                                    },
                                    function(isConfirm) {
                                        window.location.href = '<?php echo base_url('pages/borrow/'); ?>';
                                    }
                                );
                            }
                            else if(register_oObj.allowed == 'no'){
                                swal(
                                    {
                                        title: "Registration failed",
                                        text : register_oObj.msg,
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
                            else{
                                swal(
                                    {
                                        title: "Registration failed",
                                        text : register_oObj.msg,
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
                            title: "Registration failed",
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