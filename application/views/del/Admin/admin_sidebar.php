            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            <?php

                            $result = $model2->getDetails($this->session->uid);
                            $inst_tbl = $model3->getInstitute($result['inst_tbl_id']);

                            ?>

                                <img src="<?php echo base_url('uploads/admin/'.$inst_tbl['image']) ?>" height="50" width="50" style="border-radius:50%">
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('add_product') ?>"><i class="fa fa-edit fa-fw"></i>Add Product</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('view_product') ?>"><i class="fa fa-edit fa-fw"></i>View Product</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('pages_seo_sem') ?>"><i class="fa fa-edit fa-fw"></i>Pages SEO</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('product_inventory') ?>"><i class="fa fa-edit fa-fw"></i>Product Inventory</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('product_inventory_report') ?>"><i class="fa fa-edit fa-fw"></i>Product Inventory Report</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('product_variation') ?>"><i class="fa fa-edit fa-fw"></i>Product Variation</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('view_product_variation') ?>"><i class="fa fa-edit fa-fw"></i>View Product Variation</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('moderator') ?>"><i class="fa fa-edit fa-fw"></i>Moderator</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('view_moderator') ?>"><i class="fa fa-edit fa-fw"></i>View Moderator</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('blogger') ?>"><i class="fa fa-edit fa-fw"></i>Blogger</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('view_blogger') ?>"><i class="fa fa-edit fa-fw"></i>View Blogger</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('operation_manager') ?>"><i class="fa fa-edit fa-fw"></i>Operation Manager</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('view_operation_manager') ?>"><i class="fa fa-edit fa-fw"></i>View Operation Manager</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('time_slot') ?>"><i class="fa fa-edit fa-fw"></i>Timeslot</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('view_class') ?>"><i class="fa fa-edit fa-fw"></i>Class</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('subject') ?>"><i class="fa fa-edit fa-fw"></i>Subject</a>
                        </li>
                        
                        
                        <li>
                            <a href="<?php echo base_url('student') ?>"><i class="fa fa-edit fa-fw"></i>Student</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('view_student') ?>"><i class="fa fa-edit fa-fw"></i>View Student</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('student_update') ?>"><i class="fa fa-edit fa-fw"></i>Update Student</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('inactive_student') ?>"><i class="fa fa-edit fa-fw"></i>Inactive Student</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('teacher') ?>"><i class="fa fa-edit fa-fw"></i>Teacher</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url('view_teacher') ?>"><i class="fa fa-edit fa-fw"></i>View Teacher</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('teacher_update') ?>"><i class="fa fa-edit fa-fw"></i>Update Teacher</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('inactive_teacher') ?>"><i class="fa fa-edit fa-fw"></i>Inactive Teacher</a>
                        </li>
                       <li>
                            <a href="<?php echo base_url('search_teacher') ?>"><i class="fa fa-edit fa-fw"></i>Search Teacher</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('allocate_student') ?>"><i class="fa fa-edit fa-fw"></i>Allocate Student</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('allocate_teacher') ?>"><i class="fa fa-edit fa-fw"></i>Allocate Teacher</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('change_teacher') ?>"><i class="fa fa-edit fa-fw"></i>Change Teacher</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('teacher_salary') ?>"><i class="fa fa-edit fa-fw"></i>Teacher Salary</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('teacher_salary_report') ?>"><i class="fa fa-edit fa-fw"></i>Teacher Salary Report</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('submit_student_fees') ?>"><i class="fa fa-edit fa-fw"></i>Submit Student Fees</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('student_fees_report') ?>"><i class="fa fa-edit fa-fw"></i>Student Fees Report</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('student_fee_receipt') ?>"><i class="fa fa-edit fa-fw"></i>Student Fee Receipt</a>
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