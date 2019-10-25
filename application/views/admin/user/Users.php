<div id="wrapper">
	<div id="page-wrapper">
		<div class="container-fluid">
			<!--heading-->
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-user"></i> Users
						</li>
					</ol>
				</div>	
				<div class="col-lg-6">
					<div class="table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Username</th>
									<th>Password</th>
									<th>Level</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($checking_status == 1) {
										foreach($result as $r) {
											?>
											<tr>
												<td><?php echo $r->id; ?></td>
												<td><?php echo $r->name; ?></td>
												<td><?php echo $r->username; ?></td>
												<td><?php echo $r->password; ?></td>
												<td><?php echo $r->level; ?></td>
											</tr>
											<?php
										}
									} else {
										echo '<td colspan="6" style="text-align:center;">No results found</td>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
