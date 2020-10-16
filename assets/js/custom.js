var id = 0

$(document).ready(function(){
	$('#loading-simpan, #loading-ubah, #pesan-sukses, #pesan-error').hide()

	// Fungsi ini akan dipanggil ketika tombol edit diklik
	$('#view').on('click', '.btn-form-ubah', function(){
    id = $(this).data('id') 
    $('#btn-simpan').hide() 
    $('#btn-ubah').show()
    
    // Set judul modal dialog menjadi Form Ubah Data
    $('#modal-title').html('Form Ubah data')
	var tr = $(this).closest('tr') 
	
    var nama = tr.find('.nama-value').val()  // Ambil nama dari input type hidden
    var harga = tr.find('.harga-value').val() 
    var stok = tr.find('.stokk-value').val() 
	
    $('#nama').val(nama) 
    $('#harga').val(harga)
    $('#stokk').val(stok) 
  })
	
	// Fungsi ini akan dipanggil ketika tombol hapus diklik
  $('#view').on('click', '.btn-alert-hapus', function(){ 	
    id = $(this).data('id')
  })

	$('#btn-tambah').click(function(){     // Ketika tombol tambah diklik
		$('#btn-simpan').show() // Munculkan tombol Simpan

		$('#btn-ubah').hide()  // Sembunyikan tombol Ubah

		$('#modal-title').html('Form Simpan Data')

	})

	$('#btn-simpan').click(function(){
		$('#loading-simpan').show() // Munculkan loading simpan

		$.ajax({
			url: base_url + 'homepage/simpan',
			type: 'POST',
			data: $("#form-modal form").serialize(),  // Ambil semua data yang ada didalam tag form
			dataType: 'json',
			beforeSend: function(e) {
				if (e && e.overrideMimeType) {
					e.overrideMimeType('application/jsoncharset=UTF-8')
				}
			},
			success: function(response){   // Ketika proses pengiriman berhasil
				$('#loading-simpan').hide()

				if (response.status == 'sukses') {  // Jika Statusnya = sukses
					$('#view').html(response.html)


					/*
					* Ambil pesan suksesnya dan set ke div pesan-sukses
					* Lalu munculkan div pesan-sukes nya
					* Setelah 10 detik, sembunyikan kembali pesan suksesnya
					*/

					$('#pesan-sukses').html(response.pesan).fadeIn().delay(10000).fadeOut()

					$('#form-modal').modal('hide')
				}else{ // Jika statusnya = gagal
					/*
					* Ambil pesan errornya dan set ke div pesan-error
					* Lalu munculkan div pesan-error nya
					*/
					$('#pesan-error').html(response.pesan).show()
				}
			}
		})
	})

	$('#btn-ubah').click(function(){ // Ketika tombol ubah di klik
	    $('#loading-ubah').show() // Munculkan loading ubah
	    
	    $.ajax({
	      url: base_url + 'homepage/ubah/' + id, // URL tujuan
	      type: 'POST', // Tentukan type nya POST atau GET
	      data: $("#form-modal form").serialize(), // Ambil semua data yang ada didalam tag form
	      dataType: 'json',
	      beforeSend: function(e) {
	        if(e && e.overrideMimeType) {
	          e.overrideMimeType('application/jsoncharset=UTF-8')
	        }
	      },
	      success: function(response){ // Ketika proses pengiriman berhasil
	        $('#loading-ubah').hide() // Sembunyikan loading ubah
		        if(response.status == 'sukses'){ // Jika Statusnya = sukses
		          // Ganti isi dari div view dengan view yang diambil dari proses_ubah.php
		          $('#view').html(response.html)
		          /*
		          * Ambil pesan suksesnya dan set ke div pesan-sukses
		          * Lalu munculkan div pesan-sukes nya
		          * Setelah 10 detik, sembunyikan kembali pesan suksesnya
		          */
		          $('#pesan-sukses').html(response.pesan).fadeIn().delay(10000).fadeOut()
		          $('#form-modal').modal('hide') // Close / Tutup Modal Dialog
		        }else{ // Jika statusnya = gagal
		          /*
		          * Ambil pesan errornya dan set ke div pesan-error
		          * Lalu munculkan div pesan-error nya
		          */
		          $('#pesan-error').html(response.pesan).show()
		        }
	        }
	    })
	})
	
    $('#btn-hapus').click(function(){ // Ketika tombol hapus di klik
    $('#loading-hapus').show() // Munculkan loading hapus
    $.ajax({
      url: base_url + 'homepage/hapus/' + id, // URL tujuan
      type: 'GET', // Tentukan type nya POST atau GET
      dataType: 'json',
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType('application/jsoncharset=UTF-8')
        }
      },
      success: function(response){ // Ketika proses pengiriman berhasil
        $('#loading-hapus').hide() // Sembunyikan loading hapus
        // Ganti isi dari div view dengan view yang diambil dari proses_hapus.php
        $('#view').html(response.html)
        /*
        * Ambil pesan suksesnya dan set ke div pesan-sukses
        * Lalu munculkan div pesan-sukes nya
        * Setelah 10 detik, sembunyikan kembali pesan suksesnya
        */
        $('#pesan-sukses').html(response.pesan).fadeIn().delay(10000).fadeOut()
        $('#delete-modal').modal('hide') // Close / Tutup Modal Dialog
      }
    })
  })
    $('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup
    $('#form-modal input, #form-modal select, #form-modal textarea').val('') // Clear inputan menjadi kosong
  })
})