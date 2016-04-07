<?php 
include("html/mainheader.html");
include("html/menu.html");
?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			
				<!-- four-grids -->
				<div class="row four-grids">
					<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
									<i class="fa fa-book"></i>
								</div>
							</div>
							<div class="grid-right">
								<h3>Patients <span>enregistrés</span></h3>
								<p>452</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
									<i class="fa fa-rocket"></i>
								</div>
							</div>
							<div class="grid-right">
								<h3>Nouveau <span>projets</span></h3>
								<p>22</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
									<i class="fa fa-bar-chart"></i>
								</div>
							</div>
							<div class="grid-right">
								<h3>Notre <span>status</span></h3>
								<p>125</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="col-md-3 ticket-grid">
						<div class="tickets">
							<div class="grid-left">
								<div class="book-icon">
									<i class="fa fa-user"></i>
								</div>
							</div>
							<div class="grid-right">
								<h3>Membres <span>connectés</span></h3>
								<p>6</p>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!-- //four-grids -->
				<!--row-->
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-widget">
							<div class="panel-title">
							  Candlestick colors
							  <ul class="panel-tools">
								<li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
								<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
								<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
							  </ul>
							</div>
							<div class="panel-body">
								<!-- candlestick -->
								<div class="candlestick">
									<script type="text/javascript">
									  // Generate data
									  
									  var data = [];
									  
									  var time = new Date('Dec 1, 2013 12:00').valueOf();
									  
									  var h = Math.floor(Math.random() * 100);
									  var l = h - Math.floor(Math.random() * 20);
									  var o = h - Math.floor(Math.random() * (h - l));
									  var c = h - Math.floor(Math.random() * (h - l));

									  var v = Math.floor(Math.random() * 1000);
									  
									  for (var i = 0; i < 30; i++) {
										data.push([time, o, h, l, c, v]);
										h += Math.floor(Math.random() * 10 - 5);
										l = h - Math.floor(Math.random() * 20);
										o = h - Math.floor(Math.random() * (h - l));
										c = h - Math.floor(Math.random() * (h - l));
										v += Math.floor(Math.random() * 100 - 50);
										time += 30 * 60000; // Add 30 minutes
									  }
									</script>
									<div id="example-8"></div>
									
									<script type="text/javascript">
									  $(function() {
										$('#example-8').jqCandlestick({
										  data: data,
										  theme: 'light',
										  yAxis: [{
											height: 7, // 7 / (7 + 3)
										  }, {
											height: 3, // 3 / (7 + 3)
										  }],
										  series: [{
											type: 'candlestick',
											upStroke: '#0C0',
											downStroke: '#C00',
											downColor: 'rgba(255, 0, 0, 0.4)',
										  }, {
											type: 'column',
											name: 'VOLUME',
											yAxis: 1,
											stroke: '#00C',
											color: 'rgba(0, 0, 255, 0.5)',
										  }],
										});
									  });
									</script>
								</div>
								<!-- //candlestick -->
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="panel panel-widget">
							<div class="panel-title">
							  Lines and points
							  <ul class="panel-tools">
								<li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
								<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
								<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
							  </ul>
							</div>
							<div class="panel-body">
								<div class="lines-points">
									<div id="example-4"></div>
									<script type="text/javascript">
									  $(function() {
										$('#example-4').jqCandlestick({
										  data: data,
										  theme: 'light',
										  series: [{
											type: 'line',
										  }, {
											type: 'point',
										  }],
										});
									  });
									</script>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!--//row-->
				<!--row-->
				<div class="row">
					<div class="col-md-7">
						<div class="panel panel-widget">
							<div class="panel-title">
							  Real Time Updates
							  <ul class="panel-tools">
								<li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
								<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
								<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
							  </ul>
							</div>
							<div class="panel-body">
								<div class="demo-container">
									<div id="placeholder" class="demo-placeholder"></div>
								</div>
								<p>Time between updates: <input id="updateInterval" type="text" value="" style="text-align: right; width:5em"> milliseconds</p>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="panel panel-widget">
							<div class="panel-title">
							  Error Bars
							  <ul class="panel-tools">
								<li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
								<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
								<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
							  </ul>
							</div>
							<div class="panel-body">
								<div class="demo-container">
									<div id="placeholder1" class="demo-placeholder"></div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="clearfix"> </div>
				</div>
				<!--//row-->
				<!--row-->
				<div class="row">
					<div class="col-md-5 program-grid">
						<div class="panel panel-widget">
							<div class="panel-title">
							  Programming Skills
							  <ul class="panel-tools">
								<li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
								<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
								<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
							  </ul>
							</div>
							<div class="panel-body">
								<div class="chart-skills">
									<div class="skills-holder" id="canvas-holder">
										<canvas id="chart-area" width="500" height="500"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7 monthly-grid">
						<div class="panel panel-widget">
							<div class="panel-title">
							  Monthly Status Report
							  <ul class="panel-tools">
								<li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
								<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
								<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
							  </ul>
							</div>
							<div class="panel-body">
								<!-- status -->
								<div class="contain">	
									<div class="gantt"></div>
								</div>
								<!-- status -->
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!--//row-->
			</div>
		</div>
<?php include("html/mainfooter.html");?>