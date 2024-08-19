@extends('layout.index')
@section('data_table')
<div class="row">
						<div class="col-xl-4">
							<div class="card overflow-hidden border-top-0">
								<div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar bg-primary" style="width: 90%"></div>
								</div>
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between">
										<div class="">
											<p class="text-muted fw-semibold fs-16 mb-1">Daily average orders</p>
											<p class="text-muted mb-4">
												<span class="badge bg-success-subtle text-success">
													<i class="bi bi-graph-up-arrow me-1"></i> 1.33%
												</span>
												vs last month
											</p>
										</div>
										<div class="avatar-sm mb-4">
											<div class="avatar-title bg-primary-subtle text-primary fs-24 rounded">
												<i class="bi bi-receipt"></i>
											</div>
										</div>
									</div>
									<div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
										<h3 class="mb-0 d-flex"><i class="bi bi-currency-dollar"></i>1,226.71k </h3>
										<div class="d-flex align-items-end h-100">
											<div id="daily-orders" data-colors="#007aff"></div>
										</div>
									</div>
								</div><!-- end card-body -->
							</div><!-- end card -->
						</div><!-- end col -->

						<div class="col-xl-4">
							<div class="card overflow-hidden border-top-0">
								<div class="progress progress-sm rounded-0 bg-light" role="progressbar"
									aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar bg-dark" style="width: 40%"></div>
								</div>
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between">
										<div class="">
											<p class="text-muted fw-semibold fs-16 mb-1">Active users</p>
											<p class="text-muted mb-4"><span class="badge bg-danger-subtle text-danger"><i class="bi bi-graph-down-arrow me-1"></i> 5.27%</span> vs last
												month
											</p>
										</div>
										<div class="avatar-sm mb-4">
											<div class="avatar-title bg-dark-subtle text-dark fs-24 rounded">
												<i class="bi bi-people"></i>
											</div>
										</div>
									</div>
									<div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
										<h3 class="mb-0 d-flex"><i class="bi bi-person"></i> 1,226.71k </h3>
										<div class="d-flex align-items-end h-100">
											<div id="new-leads-chart" data-colors="#404040"></div>
										</div>
									</div>
								</div><!-- end card-body -->
							</div><!-- end card -->
						</div><!-- end col -->

						<div class="col-xl-4">
							<div class="card overflow-hidden border-top-0">
								<div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar bg-danger" style="width: 60%"></div>
								</div>
								<div class="card-body">
									<div class="d-flex align-items-center justify-content-between">
										<div class="">
											<p class="text-muted fw-semibold fs-16 mb-1">Booked Revenue</p>
											<p class="text-muted mb-4">
												<span class="badge bg-success-subtle text-success"><i
														class="bi bi-graph-up-arrow me-1"></i> 11.8%</span>
												vs last month
											</p>
										</div>
										<div class="avatar-sm mb-4">
											<div class="avatar-title bg-danger-subtle text-danger fs-24 rounded">
												<i class="bi bi-clipboard-data"></i>
											</div>
										</div>
									</div>
									<div class="d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-end">
										<h3 class="mb-0 d-flex"><i class="bi bi-currency-dollar"></i>12,029.71k </h3>
										<div class="d-flex align-items-end h-100">
											<div id="booked-revenue-chart" data-colors="#bb3939"></div>
										</div>
									</div>
								</div><!-- end card-body -->
							</div><!-- end card -->
						</div><!-- end col -->
					</div>
@endsection