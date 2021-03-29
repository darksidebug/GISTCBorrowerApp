
    <div class="container-fluid register_auth">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 errors"></div>
            <form method="post">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 parent">
                        <div class="belt">
                            <div class="login_form">  
                                <div class="form-control email__holder">
                                    <input type="text" name="user_id" id="user_id" class="form-control email__input" placeholder="User ID" autofocus>
                                    <i class="fa fa-id-card"></i>
                                </div>
                                <div class="form-control name__holder">
                                    <input type="text" name="name" id="name" class="form-control name__input" placeholder="Name" autofocus>
                                    <i class="fa fa-user-circle"></i>
                                </div>
                                <div class="form-control position__holder">
                                    <select name="position" id="position" class="form-control position__select" autofocus>
                                        <option value="">Position</option>
                                        <?php
                                            if($this->session->userdata('position') == 'Admin'){
                                                ?>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Director">Director</option>
                                                    <option value="Clerk">Clerk</option>
                                                <?php
                                            }
                                            if($this->session->userdata('position') == 'Director'){
                                                ?>
                                                    <option value="Director">Director</option>
                                                    <option value="Clerk">Clerk</option>
                                                <?php
                                            }
                                            if($this->session->userdata('position') == 'Clerk'){
                                                ?>
                                                    <option value="Clerk">Clerk</option>
                                                <?php
                                            }
                                        ?> 
                                    </select>
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="form-control password__holder">
                                    <input type="password" name="password" id="password" class="form-control password__input" placeholder="Password" autofocus>
                                    <i class="fa fa-key"></i>
                                </div>
                                <div align="center">
                                    <button type="submit" name="register" id="register" class="btn__register"><i class="fa fa-edit"></i>&nbsp;REGISTER</button>
                                </div>
                            </div>
                        </div>
                        <p id="footer">&COPY; GISTECHCENTER&nbsp;-&nbsp;All Rights Reserved 2019</p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#register').click(function(event){
                event.preventDefault();
                const register_userauth = 'users_auth';
                const user_id = $('#user_id').val();
                const password = $('#password').val();
                const name = $('#name').val();
                const position = $('#position').val();
                if(user_id != '' && password != '' && name != ''){
                    $.ajax({
                        url: '<?php echo base_url("user/register_authorize"); ?>',
                        type: 'post',
                        data: {
                            user_id              : user_id,
                            password             : password,
                            name                 : name,
                            position             : position,
                            register_userauth    : register_userauth
                        },
                        success:function(data){
                            const register_oObj = JSON.parse(data);
                            if(register_oObj.allowed == 'yes'){
                                swal(
                                    {
                                        title: "Registered",
                                        text : register_oObj.msg,
                                        type : "success",
                                        showCancelButton  : false,
                                        showConfirmButton : true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText : "Ok",
                                        cancelButtonText  : "",
                                        closeOnConfirm    : true,
                                        closeOnCancel     : false 
                                    },
                                    function(isConfirm) {
                                        window.location.href = '<?php echo base_url('pages/register_auth/'); ?>';
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
                            else if(register_oObj.allowed == 'not') {
                                swal(
                                    {
                                        title: "Registration failed",
                                        text : 'Cannot register authorized personnel!',
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