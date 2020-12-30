            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <?php

                            $result = $model2->getDetails($this->session->uid);

                            $inst_tbl = $model2->getTeachersBySubjects($result['inst_tbl_id']);
                            
                            ?>

                                <img src="<?php echo base_url('uploads/teacher/'.$inst_tbl[0]['image']) ?>" height="50" width="50" style="border-radius:50%">
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url('teacher/dashboard') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        
                        
                        <li>
                            <a href="<?php echo base_url('teacher/submit_attendence') ?>"><i class="fa fa-edit fa-fw"></i>Submit Attendence</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('teacher/teaching_schedule') ?>"><i class="fa fa-edit fa-fw"></i>Teaching Schedule</a>
                        </li>
                       
                        <!--<li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        
                                    </ul>
                                
                                </li>
                            </ul>
                            
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Blank Page</a>
                                </li>
                                <li>
                                    <a href="#">Login Page</a>
                                </li>
                            </ul>
                            
                        </li>-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>