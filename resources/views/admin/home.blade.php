@extends('layouts.admin-app')

@section('content')

    <div class="contentpanel">

        <div class="row">

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-success panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-user.png" alt="" />
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">Visits Today</small>
                                    <h1>900k+</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Pages / Visit</small>
                                    <h4>7.80</h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label">% New Visits</small>
                                    <h4>76.43%</h4>
                                </div>
                            </div><!-- row -->
                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-danger panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-document.png" alt="" />
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">% Unique Visitors</small>
                                    <h1>54.40%</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <small class="stat-label">Avg. Visit Duration</small>
                            <h4>01:80:22</h4>

                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-primary panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-document.png" alt="" />
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">Page Views</small>
                                    <h1>300k+</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <small class="stat-label">% Bounce Rate</small>
                            <h4>34.23%</h4>

                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-dark panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="/templateDemo/images/is-money.png" alt="" />
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">Today's Earnings</small>
                                    <h1>$655</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4>$32,322</h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label">Last Month</small>
                                    <h4>$503,000</h4>
                                </div>
                            </div><!-- row -->

                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->
        </div><!-- row -->

        <div class="row">
            <div class="col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5 class="subtitle mb5">Network Performance</h5>
                                <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
                                <div id="basicflot" style="width: 100%; height: 300px; margin-bottom: 20px"></div>
                            </div><!-- col-sm-8 -->
                            <div class="col-sm-4">
                                <h5 class="subtitle mb5">Server Status</h5>
                                <p class="mb15">Summary of the status of your server.</p>

                                <span class="sublabel">CPU Usage (40.05 - 32 cpus)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-primary"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Memory Usage (32.2%)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 32%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Disk Usage (82.2%)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 82%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Databases (63/100)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 63%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Domains (2/10)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Email Account (13/50)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 26%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->


                            </div><!-- col-sm-4 -->
                        </div><!-- row -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-9 -->

            <div class="col-sm-4 col-md-3">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5 class="subtitle mb5">Most Browser Used</h5>
                        <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
                        <div id="donut-chart2" class="ex-donut-chart"></div>
                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-3 -->

        </div><!-- row -->

        <div class="row">

            <div class="col-sm-7">

                <div class="table-responsive">
                    <table class="table table-bordered mb30">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->

            </div><!-- col-sm-7 -->

            <div class="col-sm-5">

                <div class="panel panel-success">
                    <div class="panel-heading padding5">
                        <div id="line-chart" class="ex-line-chart"></div>
                    </div>
                    <div class="panel-body">
                        <div class="tinystat pull-left">
                            <div id="sparkline" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Average Sales</span>
                                <h4>$630,201</h4>
                            </div>
                        </div><!-- tinystat -->
                        <div class="tinystat pull-right">
                            <div id="sparkline2" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Total Sales</span>
                                <h4>$139,201</h4>
                            </div>
                        </div><!-- tinystat -->
                    </div>
                </div><!-- panel -->

            </div><!-- col-sm-6 -->
        </div><!-- row -->

        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default widget-photoday">
                    <div class="panel-body">
                        <a href="" class="photoday"><img src="/templateDemo/images/photos/photo1.png" alt="" /></a>
                        <div class="photo-details">
                            <h4 class="photo-title">Strawhat In The Beach</h4>
                            <small class="text-muted"><i class="fa fa-map-marker"></i> San Franciso, California, USA</small>
                            <small>By: <a href="">ThemePixels</a></small>
                        </div><!-- photo-details -->
                        <ul class="photo-meta">
                            <li><span><i class="fa fa-eye"></i> 32,102</span></li>
                            <li><a href="#"><i class="fa fa-heart"></i> 1,003</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 52</a></li>
                        </ul>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-4">
                <div class="panel panel-default panel-alt widget-messaging">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-edit"><i class="fa fa-edit"></i></a>
                        </div><!-- panel-btns -->
                        <h3 class="panel-title">Messaging</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li>
                                <small class="pull-right">Dec 10</small>
                                <h4 class="sender">Jennier Lawrence</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 9</small>
                                <h4 class="sender">Marsha Mellow</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 9</small>
                                <h4 class="sender">Holly Golightly</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 10</small>
                                <h4 class="sender">Jennier Lawrence</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                            <li>
                                <small class="pull-right">Dec 9</small>
                                <h4 class="sender">Marsha Mellow</h4>
                                <small>Lorem ipsum dolor sit amet...</small>
                            </li>
                        </ul>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-4">
                <div class="panel panel-dark panel-alt widget-quick-status-post">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">&times;</a>
                            <a href="" class="minimize">&minus;</a>
                        </div><!-- panel-btns -->
                        <h3 class="panel-title">Quick Status Post</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#post-status" data-toggle="tab"><i class="fa fa-pencil"></i> <strong>Status</strong></a></li>
                            <li><a href="#post-photo" data-toggle="tab"><i class="fa fa-picture-o"></i> <strong>Photo</strong></a></li>
                            <li><a href="#post-checkin" data-toggle="tab"><i class="fa fa-map-marker"></i> <strong>Check-In</strong></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="post-status" class="tab-pane active">
                                <input type="text" class="form-control" placeholder="What's your status?" />
                            </div>
                            <div id="post-photo" class="tab-pane">
                                <input type="text" class="form-control" placeholder="Choose photo" />
                            </div>
                            <div id="post-checkin" class="tab-pane">
                                <input type="text" class="form-control" placeholder="Search location" />
                            </div>
                            <button class="btn btn-primary btn-block mt10">Submit Post</button>
                        </div><!-- tab-content -->

                    </div><!-- panel-body -->
                </div><!-- panel -->

                <div class="mb20"></div>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-warning panel-alt widget-today">
                            <div class="panel-heading text-center">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <div class="panel-body text-center">
                                <h3 class="today">Fri, Dec 13</h3>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>

                    <div class="col-xs-6">
                        <div class="panel panel-danger panel-alt widget-time">
                            <div class="panel-heading text-center">
                                <i class="glyphicon glyphicon-time"></i>
                            </div>
                            <div class="panel-body text-center">
                                <h3 class="today">4:50AM PST</h3>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                </div>
            </div><!-- col-sm-6 -->

        </div>

    </div><!-- contentpanel -->

    </div><!-- mainpanel -->

    <div class="rightpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
            <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
            <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
            <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="rp-alluser">
                <h5 class="sidebartitle">Online Users</h5>
                <ul class="chatuserlist">
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/userprofile.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Los Angeles, CA</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user1.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <span class="pull-right badge badge-danger">2</span>
                                <strong>Zaham Sindilmaca</strong>
                                <small>San Francisco, CA</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user2.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Bangkok, Thailand</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user3.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user4.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div><!-- media -->
                    </li>
                </ul>

                <div class="mb30"></div>

                <h5 class="sidebartitle">Offline Users</h5>
                <ul class="chatuserlist">
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user5.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Los Angeles, CA</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user2.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Zaham Sindilmaca</strong>
                                <small>San Francisco, CA</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user3.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Bangkok, Thailand</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user4.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user5.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user4.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user5.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div><!-- media -->
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="rp-favorites">
                <h5 class="sidebartitle">Favorites</h5>
                <ul class="chatuserlist">
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user2.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Los Angeles, CA</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user1.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Zaham Sindilmaca</strong>
                                <small>San Francisco, CA</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user3.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Bangkok, Thailand</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user4.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user5.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div><!-- media -->
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="rp-history">
                <h5 class="sidebartitle">History</h5>
                <ul class="chatuserlist">
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user4.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Hi hello, ctc?... would you mind if I go to your...</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user2.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Zaham Sindilmaca</strong>
                                <small>This is to inform you that your product that we...</small>
                            </div>
                        </div><!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="/templateDemo/images/photos/user3.png" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Are you willing to have a long term relat...</small>
                            </div>
                        </div><!-- media -->
                    </li>
                </ul>
            </div>
            <div class="tab-pane pane-settings" id="rp-settings">

                <h5 class="sidebartitle mb20">Settings</h5>
                <div class="form-group">
                    <label class="col-xs-8 control-label">Show Offline Users</label>
                    <div class="col-xs-4 control-label">
                        <div class="toggle toggle-success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-8 control-label">Enable History</label>
                    <div class="col-xs-4 control-label">
                        <div class="toggle toggle-success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-8 control-label">Show Full Name</label>
                    <div class="col-xs-4 control-label">
                        <div class="toggle-chat1 toggle-success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-8 control-label">Show Location</label>
                    <div class="col-xs-4 control-label">
                        <div class="toggle toggle-success"></div>
                    </div>
                </div>

            </div><!-- tab-pane -->

        </div><!-- tab-content -->
    </div><!-- rightpanel -->


@endsection
