<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>
<body class="animsition">
	<div class="page-wrapper">
		
		<!-- MENU SIDEBAR -->
		<?php $this->load->view("admin/_partials/sidebar.php") ?>
		<!-- END MENU SIDEBAR -->

		<!-- PAGE CONTAINER -->
		<div class="page-container">
			<!-- HEADER DESKTOP -->
			<?php $this->load->view("admin/_partials/navbar.php") ?>

			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="section__content section__content--p30">
					<div class="container-fluid">
						<div class="card mb-3">
							<div class="card-header">
								<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

								<?php if($this->session->flashdata('success')): ?>
									<div class="alert alert-success" role="alert">
										<?php echo $this->session->flashdata('success'); ?>
									</div>
								<?php endif; ?>

								<div class="card mb-3">
									<div class="card-header">
										<table>
											<tr>
												<td width="150"><a href="<?php echo site_url('admin/spp/add')?>"><i class="fas fa-flus"></i> Tambah Data</a></td>
												<td><a href="<?php echo site_url('admin/spp/cetak') ?>"><i class="fas fa-print"></i>Cetak PDF</a></td>
											</tr>
										</table>
									</div>

									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover" id="dataTable" width="100%" cellpadding="0">
												<thead>
													<tr>
														<th>Tahun Ajaran</th>
														<th>Nominal</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($spp as $spp): ?>
														<tr>
															<td width="150">
																<?php echo $spp->tahun ?>
															</td>
															<td>
																<?php echo rupiah($spp->nominal) ?>
															</td>
															<td width="250">
																<a href="<?php echo site_url('admin/spp/edit/' .$spp->id_spp) ?>" class="btn btn-small"><i class="fas fa-edit"></i>Ubah</a>
																<a onclick="deleteConfirm('<?php echo site_url('admin/spp/delete/' .$spp->id_spp) ?>')" href="<?php echo site_url('admin/spp/delete/' .$spp->id_spp) ?>" class="btn btn-small text-danger"><i class="fas fa-trash"></i>Hapus</a>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>

										<table>
											<tr>
												<a href="<?php echo site_url('admin/spp/add') ?>"><div class="btn btn-success mr-2">Tambah</div></a>
												<a href="<?php echo site_url('admin/spp/cetak') ?>"><div class="btn btn-danger"></div>Cetak PDF</a>
											</tr>
										</table>
									</div>
								</div>
								<?php $this->load->view("admin/_partials/footer.php") ?>
							</div>
						</div>
						<!-- END MAIN CONTENT -->
						<!-- END PAGE CONTAINER -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view("admin/_partials/js.php") ?>
	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>

	<script>
		Function deleteConfirm(url){
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>

</body>
</html>