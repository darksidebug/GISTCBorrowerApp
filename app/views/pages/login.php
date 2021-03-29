
    <div class="container-fluid login">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 errors"></div>
            <form method="post">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 parent">
                        <div class="belt">
                            <div class="login_form">  
                                <div class="form-control email__holder">
                                    <input type="text" name="email" id="email" class="form-control email__input" placeholder="Email/User ID" autofocus>
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="form-control password__holder">
                                    <input type="password" name="password" id="password" class="form-control password__input" placeholder="Password" autofocus>
                                    <i class="fa fa-key"></i>
                                </div>
                                <div align="center">
                                    <button type="submit" name="login" id="login" class="btn__register login"><i class="fa fa-lock"></i>&nbsp; LOGIN</button>
                                </div>
                                <div class="forgot" align="center">
                                    <a href="#">Forget password?</a>
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
            $('#login').click(function(event){
                event.preventDefault();
                const login = 'users';
                const email = $('#email').val();
                const password = $('#password').val();
                if(email != '' && password != ''){
                    $.ajax({
                        url: '<?php echo base_url("User/login"); ?>',
                        type: 'POST',
                        data: {
                            email    : email,
                            password : password,
                            login    : login
                        },
                        success:function(data){
                            const log_oObj = JSON.parse(data);
                            if(log_oObj.logged_in == true){
                                if(log_oObj.position == 'Admin' || log_oObj.position == 'Director' || log_oObj.position == 'In-charge'){
                                    window.location.href = '<?php echo base_url('pages/admin/approval/Equipment/Document/not_returned/pending'); ?>';
                                }
                                else{
                                    window.location.href = '<?php echo base_url('pages/main/main_page/Equipment/Document/'); ?>';
                                }
                            }
                            else{
                                swal(
                                    {
                                        title: "Authentication invalid",
                                        text : 'No match found!',
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
                            title: "Authentication invalid",
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