<?php

/* @var $this yii\web\View */
use app\models\Orders;
$this->title = 'База Аренда Лесов 2.0';

?>
<br><br>
			<div class="animated fadeIn">
				<div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-primary">
                                <div class="card-block p-b-0">
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
									<?$today = date("Y-m-d");?>
                                    <h4 class="m-b-0"><?=Orders::GetOrdersCount( $today )?></h4>
                                    <p>Заказов сегодня</p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                    <canvas id="card-chart1" class="chart" height="140" width="440" style="display: block; width: 220px; height: 70px;"></canvas>
                                </div>
                            </div>
							
							
                        </div>
                        <!--/col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-info">
                                <div class="card-block p-b-0">
                                    <button type="button" class="btn btn-transparent active p-a-0 pull-right">
                                        <i class="icon-location-pin"></i>
                                    </button>
                                    <h4 class="m-b-0">9.823</h4>
                                    <p>Выручка сегодня</p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                    <canvas id="card-chart2" class="chart" height="140" width="440" style="display: block; width: 220px; height: 70px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-warning">
                                <div class="card-block p-b-0">
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                    <h4 class="m-b-0">9.823</h4>
                                    <p>Members online</p>
                                </div>
                                <div class="chart-wrapper" style="height:70px;"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                    <canvas id="card-chart3" class="chart" height="140" width="504" style="display: block; width: 252px; height: 70px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-danger">
                                <div class="card-block p-b-0">
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                    <h4 class="m-b-0">9.823</h4>
                                    <p>Members online</p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                    <canvas id="card-chart4" class="chart" height="140" width="440" style="display: block; width: 220px; height: 70px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/col-->
                    </div>
					
					
					<div class="card">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-5">
                                    <h4 class="card-title">Traffic</h4>
                                    <div class="small text-muted" style="margin-top:-10px;">November 2015</div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="btn-toolbar pull-right" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group" data-toggle="buttons" aria-label="First group">
                                            <label class="btn btn-outline-secondary active">
                                                <input type="radio" name="options" id="option1"> Day
                                            </label>
                                            <label class="btn btn-outline-secondary">
                                                <input type="radio" name="options" id="option2" checked=""> Month
                                            </label>
                                            <label class="btn btn-outline-secondary">
                                                <input type="radio" name="options" id="option3"> Year
                                            </label>
                                        </div>
                                        <div class="btn-group hidden-sm-down" role="group" aria-label="Second group">
                                            <button type="button" class="btn btn-primary"><i class="icon-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-wrapper" style="height:300px;margin-top:40px;"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                                <canvas id="main-chart" height="600" width="2128" style="display: block; width: 1064px; height: 300px;"></canvas>
                            </div>
                        </div>
                        <div class="card-footer">
                            <ul>
                                <li>
                                    <div class="text-muted">Visits</div>
                                    <strong>29.703 Users (40%)</strong>
                                    <progress class="progress progress-xs progress-success" value="40" max="100">40%</progress>
                                </li>
                                <li class="hidden-sm-down">
                                    <div class="text-muted">Unique</div>
                                    <strong>24.093 Unique Users (20%)</strong>
                                    <progress class="progress progress-xs progress-info" value="20" max="100">20%</progress>
                                </li>
                                <li>
                                    <div class="text-muted">Pageviews</div>
                                    <strong>78.706 Views (60%)</strong>
                                    <progress class="progress progress-xs progress-warning" value="60" max="100">60%</progress>
                                </li>
                                <li class="hidden-sm-down">
                                    <div class="text-muted">New Users</div>
                                    <strong>22.123 Users (80%)</strong>
                                    <progress class="progress progress-xs progress-danger" value="80" max="100">80%</progress>
                                </li>
                                <li class="hidden-sm-down">
                                    <div class="text-muted">Bounce Rate</div>
                                    <strong>40.15%</strong>
                                    <progress class="progress progress-xs progress-primary" value="40" max="100">40%</progress>
                                </li>
                            </ul>
                        </div>
                    </div>
				</div>