

        <div class="content-wrapper">
            <div class="row mt-3">
              <div class="col-xl-4 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body py-4">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h2 class="mb-0 extra-large-title mt-1">Order Management </h2>
                    </div>
                    <p class="mt-2">New Order</p>
                    <div class="d-lg-flex align-items-baseline justify-content-between mt-3">
                      <div class="d-flex align-items-center">
                        <div class="icon-bg-square">
                          <i class="ion ion-md-pricetag"></i>
                        </div>
                        <h1 class="text-dark font-weight-bold"><?php echo count($orders); ?></h1>
                      </div>
                    </div>
                    <a href="<?php echo base_url('user_order') ?>" class="btn btn-link text-secondary p-0 mt-4 font-weight-bold">Read more</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body py-4">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h2 class="mb-0 extra-large-title mt-1">Customer Management </h2>
                    </div>
                    <p class="mt-2">New Customers!</p>
                    <div class="d-lg-flex align-items-baseline justify-content-between mt-3">
                        <div class="d-flex align-items-center">
                          <div class="icon-bg-square">
                            <i class="ion ion-md-contacts"></i>
                          </div>
                          <h1 class="text-dark font-weight-bold"><?php echo count($register)+count($social); ?></h1>
                        </div> 
                    </div>
                    <a href="https://www.farmstop.in/admin/register_user" class="btn btn-link text-secondary p-0 mt-4 font-weight-bold">Read more</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body py-4">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h2 class="mb-0 extra-large-title mt-1">Product Management</h2>
                    </div>
                    <p class="mt-2">New Products!</p>
                    <div class="d-lg-flex align-items-baseline justify-content-between mt-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-bg-square">
                              <i class="ion ion-logo-dropbox"></i>
                            </div>
                            <h1 class="text-dark font-weight-bold"><?php echo count($products); ?></h1>
                          </div>
                    </div>
                    <a href="<?php echo base_url('view_product_variation') ?>" class="btn btn-link text-secondary p-0 mt-4 font-weight-bold">Read more</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body py-4">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h2 class="mb-0 extra-large-title mt-1">Reviews</h2>
                    </div>
                    <p class="mt-2">New Reviews!</p>
                    <div class="d-lg-flex align-items-baseline justify-content-between mt-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-bg-square">
                              <i class="ion ion-md-happy"></i>
                            </div>
                            <h1 class="text-dark font-weight-bold"><?php echo count($reviews); ?></h1>
                          </div>
                    </div>
                    <a href="<?php echo base_url('user_review') ?>" class="btn btn-link text-secondary p-0 mt-4 font-weight-bold">Read more</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body py-4">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h2 class="mb-0 extra-large-title mt-1">Testimonials</h2>
                    </div>
                    <p class="mt-2">Total Testimonials!</p>
                    <div class="d-lg-flex align-items-baseline justify-content-between mt-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-bg-square">
                              <i class="ion ion-md-contact"></i>
                            </div>
                            <h1 class="text-dark font-weight-bold"><?php echo count($testimonial); ?></h1>
                          </div>
                    </div>
                    <a href="<?php echo base_url('view_testimonial') ?>" class="btn btn-link text-secondary p-0 mt-4 font-weight-bold">Read more</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <h3 class="text-dark card-title mb-0">Sales Status <span class="card-subtitle">Performance for Online revenue </span></h3>
                            <div class="mt-md-3">
                              <a href="#" class="btn py-0 px-2">Week</a>
                              <a href="#" class="btn py-0 px-2">Month</a>
                              <a href="#" class="btn py-0 px-2">Year</a>
                              <a href="#" class="btn py-0 px-2">All</a>
                            </div>
                        </div>
                      </div>
                    </div>
                      <div class="row mt-4">
                        <div class="col-xl-6">
                          <div class="row">
                            <div class="col-sm-6">
                                <h5 class="card-subtitle-lg">Orders by Location</h5>
                                <canvas id="order-by-location"></canvas>
                                <div class="sale-status-legends">
                                  <ul>
                                    <li class="label-secondary">
                                      <div class="legend-label">North Bangalore</div>
                                      <div class="legend-data"><?php echo $north_order['total_order'] ?></div>
                                    </li>
                                    <li class="label-warning">
                                      <div class="legend-label">East Bangalore</div>
                                      <div class="legend-data"><?php echo $east_order['total_order'] ?></div>
                                    </li>
                                    <li class="label-info">
                                      <div class="legend-label">West Bangalore</div>
                                      <div class="legend-data"><?php echo $west_order['total_order'] ?></div>
                                    </li>
                                    <li class="label-primary">
                                      <div class="legend-label">South Bangalore</div>
                                      <div class="legend-data"><?php echo $south_order['total_order'] ?></div>
                                    </li>
                                    <!--<li class="label-light">
                                      <div class="legend-label">Central Bangalore</div>
                                      <div class="legend-data">₹412</div>
                                    </li>-->
                                  </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="card-subtitle-lg">Sales by Location</h5>
                                <canvas id="sale-by-location"></canvas>
                                <div class="sale-status-legends sales-location">
                                  <ul>
                                    <li class="label-secondary">
                                      <div class="legend-label">North Bangalore</div>
                                      <div class="legend-data">
                                          <?php echo number_format(($north_order['total_order']/$order_sales['total_order'])*100,2).'%'  ?>
                                      </div>
                                    </li>
                                    <li class="label-warning">
                                      <div class="legend-label">East Bangalore</div>
                                      <div class="legend-data">
                                          <?php echo number_format(($east_order['total_order']/$order_sales['total_order'])*100,2).'%'  ?>
                                      </div>
                                    </li>
                                    <li class="label-info">
                                      <div class="legend-label">West Bangalore	</div>
                                      <div class="legend-data">
                                          <?php echo number_format(($west_order['total_order']/$order_sales['total_order'])*100,2).'%'  ?>
                                          	</div>
                                    </li>
                                    <li class="label-primary">
                                      <div class="legend-label">South Bangalore</div>
                                      <div class="legend-data">
                                          <?php echo number_format(($south_order['total_order']/$order_sales['total_order'])*100,2).'%'  ?>
                                      </div>
                                    </li>
                                    <!--<li class="label-light">
                                      <div class="legend-label">Central Bangalore</div>
                                      <div class="legend-data">15%</div>
                                    </li>-->
                                  </ul>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="d-flex justify-content-between align-items-center">
                                  <h5 class="card-subtitle-lg">Revenue for Last Month</h5>
                                  <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="ion ion-md-settings settings-dropdown"></i>
                                    </a>
                                      
                                    </div>
                              </div>
                              <canvas id="revenueChart"></canvas>
                              <div class="row mt-4">
                                <div class="col-sm-4 border-right-sm">
                                  <h5 class="font-weight-medium ml-lg-2">Total Income</h5>
                                  <h3 class="text-dark font-weight-bold ml-lg-2">₹<?php echo number_format($order_sales['total_cost'],2) ?></h3>
                                </div>
                                <div class="col-sm-4 border-right-sm">
                                  <h5 class="font-weight-medium ml-lg-2">Monthly Avg</h5>
                                  <h3 class="text-dark font-weight-bold ml-lg-2">₹<?php echo number_format(($order_sales['total_cost']/$order_sales['total_order']),2) ?></h3>
                                </div>
                                <div class="col-sm-4">
                                  <h5 class="font-weight-medium ml-lg-2">Total Sales</h5>
                                  <h3 class="text-dark font-weight-bold ml-lg-2"><?php echo $order_sales['total_order'] ?></h3>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                            <h3 class="text-dark card-title">Detailed Report</h3>
                            <div class="owl-carousel owl-theme detailed-report">
                              <div class="item">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="detailed-report-wrap">
                                      <div class="title text-dark">Orders</div>
                                      <div class="text-date">
                                          06 Jan 2019
                                      </div>
                                      <div class="d-lg-flex justify-content-between mb-3">
                                        <h3 class="text-dark mb-0 font-weight-medium">3,450</h3>
                                        <div class="text-danger small">-32.00</div>
                                      </div>
                                      <canvas id="order"></canvas>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="detailed-report-wrap">
                                        <div class="title text-dark">Users</div>
                                        <div class="text-date">
                                            06 Jan 2019
                                        </div>
                                        <div class="d-lg-flex justify-content-between mb-3">
                                          <h3 class="text-dark mb-0 font-weight-medium">3,450</h3>
                                          <div class="text-success small">+25.60</div>
                                        </div>
                                        <canvas id="users"></canvas>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                      <div class="detailed-report-wrap">
                                        <div class="title text-dark">Users</div>
                                        <div class="text-date">
                                            06 Jan 2019
                                        </div>
                                        <div class="d-lg-flex justify-content-between mb-3">
                                          <h3 class="text-dark mb-0 font-weight-medium">18,390</h3>
                                          <div class="text-danger small">-2.0</div>
                                        </div>
                                        <div class="progress progress-md">
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="mt-0">
                                          <small>7,578 avg</small>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detailed-report-wrap mb-0">
                                          <div class="title text-dark">Visitors</div>
                                          <div class="text-date">
                                              06 Jan 2019
                                          </div>
                                          <div class="d-lg-flex justify-content-between mb-3">
                                            <h3 class="text-dark mb-0 font-weight-medium">23,461</h3>
                                            <div class="text-success small">+5.6</div>
                                          </div>
                                          <div class="progress progress-md">
                                              <div class="progress-bar bg-secondary" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                          <div class="mt-0">
                                            <small>6,54 avg</small>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                              </div>
                              <div class="item">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="detailed-report-wrap">
                                      <div class="title text-dark">Orders</div>
                                      <div class="text-date">
                                          06 Jan 2019
                                      </div>
                                      <div class="d-lg-flex justify-content-between mb-3">
                                        <h3 class="text-dark mb-0 font-weight-medium">3,450</h3>
                                        <div class="text-danger small">-32.00</div>
                                      </div>
                                      <canvas id="orderSlider"></canvas>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="detailed-report-wrap mb-0">
                                        <div class="title text-dark">Users</div>
                                        <div class="text-date">
                                            06 Jan 2019
                                        </div>
                                        <div class="d-lg-flex justify-content-between mb-3">
                                          <h3 class="text-dark mb-0 font-weight-medium">3,450</h3>
                                          <div class="text-success small">+25.60</div>
                                        </div>
                                        <canvas id="usersSlider"></canvas>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                      <div class="detailed-report-wrap">
                                        <div class="title text-dark">Users</div>
                                        <div class="text-date">
                                            06 Jan 2019
                                        </div>
                                        <div class="d-lg-flex justify-content-between mb-3">
                                          <h3 class="text-dark mb-0 font-weight-medium">18,390</h3>
                                          <div class="text-danger small">-2.0</div>
                                        </div>
                                        <div class="progress progress-md">
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="mt-0">
                                          <small>7,578 avg</small>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detailed-report-wrap">
                                          <div class="title text-dark">Visitors</div>
                                          <div class="text-date">
                                              06 Jan 2019
                                          </div>
                                          <div class="d-lg-flex justify-content-between mb-3">
                                            <h3 class="text-dark mb-0 font-weight-medium">23,461</h3>
                                            <div class="text-success small">+5.6</div>
                                          </div>
                                          <div class="progress progress-md">
                                              <div class="progress-bar bg-secondary" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                          <div class="mt-0">
                                            <small>6,54 avg</small>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h3 class="text-dark card-title">Sales by Time</h3>
                            <div class="row">
                              <div class="col-sm-5">
                                <div class="d-lg-flex justify-content-left">
                                    <h3 class="text-dark mb-0 font-weight-medium mr-2">6,576</h3>
                                    <div class="text-success small">+25.60</div>
                                </div>
                              </div>
                              <div class="col-sm-7">
                                  <div id="chart-legends-state-by-sale" class="chart-legends-state-by-sale"></div>
                              </div>
                            </div>
                            <canvas id="state-by-sale"></canvas>
                            <p class="text-dark mt-4 pr-lg-5">Many people sign up for affiliate programs with the hopes of making some serious money. They advertise a few </p>
                            <button type="button" class="btn btn-link btn-fw px-0 font-weight-bold mt-3 pb-0">Read more</button>
                        </div>
                        <div class="col-sm-4 flex-column">
                            <h3 class="text-dark card-title">Users From Bangalore</h3>
                            <div class="google-chart-container">
                              <div id="vmap" class="vector-map demo-vector-map-dashboard"></div>
                            </div>
                            <div>
                              <div class="d-flex justify-content-between mt-4">
                                <small>North Bangalore</small>
                                <small><?php echo $width=number_format(($user_north['total_user']/$user_all['total_user'])*100,2).'%'  ?></small>
                              </div>
                              <div class="progress progress mt-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $width ?>" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div>
                              <div class="d-flex justify-content-between mt-3">
                                <small>East Bangalore</small>
                                <small><?php echo $width=number_format(($user_east['total_user']/$user_all['total_user'])*100,2).'%'  ?></small>
                              </div>
                              <div class="progress progress mt-1">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $width ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div>
                              <div class="d-flex justify-content-between mt-3">
                                <small>West Bangalore</small>
                                <small><?php echo $width=number_format(($user_west['total_user']/$user_all['total_user'])*100,2).'%'  ?></small>
                              </div>
                              <div class="progress progress mt-1">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo $width ?>" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div>
                              <div class="d-flex justify-content-between mt-3">
                                <small>South Bangalore</small>
                                <small><?php echo $width=number_format(($user_south['total_user']/$user_all['total_user'])*100,2).'%'  ?></small>
                              </div>
                              <div class="progress progress mt-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $width ?>" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <!--<div>
                              <div class="d-flex justify-content-between mt-3">
                                <small>Central Banaglore</small>
                                <small>68%</small>
                              </div>
                              <div class="progress progress mt-1">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>-->
                           
                        </div>
                      </div>
                  </div>
                </div>
              </div>
        </div>
        </div>