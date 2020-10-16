        <div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th class="text-center">NO</th>
			<th>Nama Barang</th>
			<th>Harga Barang</th>
			<th>Stok Barang</th>
			<th colspan="2" class="text-center">Action<span class="glyphicon glyphicon-cog"></span></th>
		</tr>
		<?php
        $no = 1;
		foreach($model as $data){
		?>
			<tr>
				<td class="align-middle text-center"><?php echo $no; ?></td>
				<td class="align-middle"><?php echo $data->nama_barang; ?></td>
				<td class="align-middle"><?php echo $data->harga_barang; ?></td>
				<td class="align-middle"><?php echo $data->stok_barang; ?></td>
				<td class="align-middle text-center">
					<a href="javascript:void();" data-id="<?php echo $data->id_barang; ?>" data-toggle="modal" data-target="#form-modal" class="btn btn-success btn-form-ubah">Edit<span class="glyphicon glyphicon-pencil"></span></a>

                    <!-- Membuat sebuah textbox hidden yang akan digunakan untuk form ubah -->
        			<input type="hidden" class="nama-value" value="<?php echo $data->nama_barang; ?>">
        			<input type="hidden" class="harga-value" value="<?php echo $data->harga_barang; ?>">
        			<input type="hidden" class="stokk-value" value="<?php echo $data->stok_barang; ?>">
				</td>
				<td class="align-middle text-center">
					<a href="javascript:void();" data-id="<?php echo $data->id_barang; ?>" data-toggle="modal" data-target="#delete-modal" class="btn btn-danger btn-alert-hapus">Hapus<span class="glyphicon glyphicon-erase"></span></a>
				</td>
			</tr>
		<?php
			$no++; // Tambah 1 setiap kali looping
		}
		?>
	</table>
</div>

</body>
<script type="text/javascript" src="<?php echo base_url(). 'assets/js/bootstrap.min.js' ?>"></script>

</html>