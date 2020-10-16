
<h1>Data Barang</h1>
<?php echo "Tanggal : ".date('d-m-Y');?>

<p></p>
<div class="row">
        <div class="col-sm-12 mt-4">
            <div class="table-responsive mb-4">
                <table border="1px;" id="example" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Barang</td>
                        <td>Harga Barang</td>
                        <td>Stok Barang</td>
                    </tr>
                </thead>
                <tbody>
                <?php  
                    foreach($model as $data){
                ?>
                    <tr>
                        <td class="align-middle text-center"><?php echo $data->id_barang; ?></td>
                        <td class="align-middle"><?php echo $data->nama_barang; ?></td>
                        <td class="align-middle"><?php echo $data->harga_barang; ?></td>
                        <td class="align-middle"><?php echo $data->stok_barang; ?></td>
                    </tr>
                        <?php 
                        }
                        ?>
                </tbody>
            </table>
         </div>
    </div>
</div>