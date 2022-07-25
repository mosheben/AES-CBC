<section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                             <li>
                                <a href="javascript:void(0)"  data-toggle="modal" data-target='#myModal'>Add Patient</a></li>
                                
 <li><a value="<?php echo htmlentities($_SESSION['id']);?>" href="#myProfile" data-toggle="modal"  id="edit_me">My Profile</a></li>
                               <li><a value="<?php echo htmlentities($_SESSION['id']);?>" href="#changePassword"  id="change_pass" data-toggle="modal" >Change Password</a></li>
                            <li><a href="logout.php">Logout</a></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
