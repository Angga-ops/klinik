<?php

	$module	= @$_GET['module'];

	if ($module=='home'){

	include "modul/mod_home/home.php";

	}

	elseif ($module=='lab_inap'){

		include "modul/lab_inap/lab.php";
	
		}

	elseif ($module=='admin_rs'){

		include "modul/mod_adminrs/adminrs.php";
	
		}
	

	elseif ($module=='resep_jalan'){

		include "modul/mod_kasir_apotek/resep_jalan.php";
	
		}

	elseif ($module=='bayar_lab'){

		include "modul/mod_kasir_lab/bayar_lab.php";
	
		}

	elseif ($module=='rujuk_inap'){

		include "modul/rawat_inap/rujuk.php";
	
		}

	elseif ($module=='jadwal_perawat'){

		include "modul/nurse/nurse.php";
	
		}

	elseif ($module=='poliklinik'){

		include "modul/poliklinik/poli.php";
	
		}

	elseif ($module=='lab_treatment'){

		include "modul/mod_kasir_lab/treatment.php";
	
		}

	elseif ($module=='obat_inap_detail'){

		include "modul/apotek_inap/apotek_detail_obat.php";
	
		}

		elseif ($module=='apotek_inap_detail'){

			include "modul/apotek_inap/apotek_detail.php";
		
			}

	elseif ($module=='apotek_inap'){

		include "modul/apotek_inap/apotek.php";
	
		}

	elseif ($module=='visit_treatment'){

		include "modul/visit_treatment/pasca_treatment.php";
	
		}

	elseif ($module=='rawat_inap'){

		include "modul/rawat_inap/inap.php";
	
		}
			
	elseif ($module=='history_kasir_lama'){

		include "modul/history_kasir_lama/history.php";
	
		}

	elseif ($module=='kasir_lama'){

		include "modul/mod_kasir_lama/kasir.php";
	
		}

		
		elseif ($module=='kategori_biaya_edit'){

			include "modul/kategori_biaya/biaya_edit.php";
		
			}	

	elseif ($module=='kategori_biaya_add'){

		include "modul/kategori_biaya/biaya_add.php";
	
		}

	elseif ($module=='kategori_biaya'){

		include "modul/kategori_biaya/biaya.php";
	
		}
	
	elseif ($module=='tambah_dr_ganti'){

		include "modul/dr_praktek/drganti_add.php";
	
		}

	elseif ($module=='dr_ganti'){

		include "modul/dr_praktek/dr_ganti.php";
	
		}

	elseif ($module=='jadwal_dokter'){

		include "modul/dr_praktek/dr_praktek.php";
	
		}

		elseif ($module=='tambah_jadwal_dokter'){

			include "modul/dr_praktek/jadwal_add.php";
		
			}

	elseif ($module=='kasir_apotek'){

		include "modul/mod_kasir_apotek/kasir_apotek.php";
	
		}

		elseif ($module=='kasir_lab'){

			include "modul/mod_kasir_lab/kasir_lab.php";
		
			}

			elseif ($module=='apotek_antrian'){

				include "modul/mod_kasir_apotek/apotek_antrian.php";
			
				}

				elseif ($module=='resep'){

					include "modul/mod_kasir_apotek/resep.php";
				
					}

					elseif ($module=='bayar_obat'){

						include "modul/mod_kasir_apotek/bayar_obat.php";
					
						}
	
	
	elseif ($module=='bonus'){

		include "modul/bonus/bonus.php";
	
		}

		elseif ($module=='data_bonus'){

			include "modul/data_bonus/data.php";
		
			}	
			
				elseif ($module=='prstock_detail'){

				include "modul/prarilis/stock_detail.php";
			
				}	

			elseif ($module=='prarilis_stock'){

				include "modul/prarilis/stock.php";
			
				}	
				elseif ($module=='prerelease'){

				include "modul/prarilis/prarilis.php";
			
				}	
				
					elseif ($module=='prarilis_pth'){

					include "modul/prarilis_pt/pth_a.php";
								
					}	

					elseif ($module=='pth'){

						include "modul/prarilis_pt/pth.php";
									
						}	

				elseif ($module=='prarilis_pt'){

					include "modul/prarilis_pt/pt.php";
								
					}			
					
					elseif ($module=='harian_produk'){
						include "modul/lap_harian_produk/harian_produk.php";
					}	

elseif ($module=='trf_out'){

	include "modul/kliniktrf/trf_out.php";
				
	}	


	elseif ($module=='trf_in'){

		include "modul/kliniktrf/trf_in.php";
					
		}	

	elseif ($module=='penjualan_h'){

		include "modul/penjualan_h/h.php";
	
		}	

		elseif ($module=='penjualan_ha'){

			include "modul/penjualan_h/ha.php";
		
			}		
			
		elseif ($module=='retur'){

				include "modul/retur/retur.php";
			
				}			

	// Bagian Admin

	elseif ($module=='grafik_treatment'){

	include "modul/grafik_treatment/grafik_treatment.php";

	}
	elseif ($module=='lap_netbrutcab'){
	include "modul/lap_netbrutcab/lap_netbrutcab.php";
	}
	elseif ($module=='lap_inkaso'){
	include "modul/lap_inkaso/lap_inkaso.php";
	}
	elseif ($module=='sortir_pekerjaan'){
	include "modul/kategori_pelanggan/sortir_pekerjaan.php";
	}
	elseif ($module=='sortir_tgllahir'){
	include "modul/kategori_pelanggan/sortir_tgllahir.php";
	}
	elseif ($module=='bc_rekap'){
		include "modul/broadcast_new/export.php";
		}
	elseif ($module=='broadcast_new'){
		include "modul/broadcast_new/new.php";
		}
	elseif ($module=='bc_nominal'){
	include "modul/broadcast_nominal/bc_nominal.php";
	}elseif ($module=='bc_perawatan'){
	include "modul/broadcast_treatment/bc_treatment.php";
	}
	
	elseif ($module=='pembayaran_kredit'){
	include "modul/pembayaran_kredit/pembayaran_kredit.php";
	}
	elseif ($module=='bc_pekerjaan'){
	include "modul/broadcast_pekerjaan/broadcast_pekerjaan.php";
	}
	elseif ($module=='pekerjaan'){
	include "modul/pekerjaan/pekerjaan.php";
	}

	elseif ($module=='grafik_produk'){

	include "modul/grafik_produk/grafik_produk.php";

	}

	elseif ($module=='laporan_perfaktur'){

	include "modul/laporan_perfaktur/laporan_perfaktur.php";

	}

	elseif ($module=='laporan_cabang_perfaktur'){

	include "modul/laporan_perfaktur_cabang/laporan_perfaktur.php";

	}

	elseif ($module=='kritik_saran'){

	include "modul/kritik_saran/kritik_saran.php";

	}

	elseif ($module=='laporan_krisar'){

	include "modul/laporan_krisar/laporan_krisar.php";

	}

	elseif ($module=='krisar_admin'){

	include "modul/laporan_krisar/laporan_krisar.php";

	}

	elseif ($module=='pengeluaran_cabang'){

	include "modul/pengeluaran_cabang/pengeluaran_cabang.php";

	}

	elseif ($module=='lap_netbrut'){

	include "modul/lap_netbrut/lap_netbrut.php";

	}

	elseif ($module=='laporan_bersih'){

	include "modul/laporan_bersih/laporan_bersih.php";

	}

	elseif ($module=='pendapatan_harian'){

	include "modul/pendapatan_harian/pendapatan_harian.php";

	}

	elseif ($module=='broadcast'){

	include "modul/broadcast/broadcast.php";

	}

	elseif ($module=='kategori_pelanggan'){

	include "modul/kategori_pelanggan/kategori_pelanggan.php";

	}

	elseif ($module=='terapkan_pelanggan'){

	include "modul/kategori_pelanggan/terapkan_pelanggan.php";

	}

	elseif ($module=='pendapatan_treatment'){

	include "modul/pendapatan_treatment/pendapatan_harian.php";

	}

	elseif ($module=='rekening'){

	include "modul/rekening/rekening_list.php";

	}

	elseif ($module=='rek_cabang'){

	include "modul/rek_cabang/rekening_list.php";

	}

	elseif ($module=='setuser_cabang'){

	include "modul/setuser_cabang/setuser_cabang.php";

	}

	elseif ($module=='dokter_treatment'){

	include "modul/dokter_treatment/dokter_treatment.php";

	}

	elseif ($module=='dokter_dafpro'){

	include "modul/dokter_produk/produk_list.php";

	}

	elseif ($module=='dokter_cabang'){

	include "modul/dokter_cabang/dokter_cabang.php";

	}

	elseif ($module=='pelayanan_cabang'){

	include "modul/pelayanan_cabang/pelayanan_list.php";

	}

	elseif ($module=='stok_cabang'){

	include "modul/stok_cabang/stok_list.php";

	}

	elseif ($module=='produk'){

	include "modul/produk/produk.php";

	}

	elseif ($module=='kategori'){

	include "modul/kategori/kategori.php";

	}

	elseif ($module=='data_dokter'){

	include "modul/data_dokter/data_dokter.php";

	}

	elseif ($module=='data_karyawan'){

	include "modul/data_karyawan/data_karyawan.php";

	}

	elseif ($module=='pengeluaran'){

	include "modul/pengeluaran/pengeluaran.php";

	}

	elseif ($module=='suplier'){

	include "modul/suplier/suplier.php";

	}

	elseif ($module=='pengiriman'){

	include "modul/pengiriman/pengiriman.php";

	}

	// Bagian Admin

	elseif ($module=='data_satuan'){

	include "modul/data_satuan/data_satuan.php";

	}

	// Bagian Admin

	elseif ($module=='lap_kedo'){

	include "modul/kehadiran_dok/kehadiran_dok.php";

	}

	elseif ($module=='lap_penjualan_pro'){

	include "modul/lap_penjualan/lap_penjualan.php";

	}

	elseif ($module=='lap_pengiriman_pro'){

	include "modul/lap_pengiriman/lap_pengiriman.php";

	}

	elseif ($module=='lap_pel'){

	include "modul/laporan_pelanggan/laporan_pelanggan.php";

	}

	// Bagian Admin

	elseif ($module=='druangan'){

	include "modul/druangan/druangan.php";

	}

	// Bagian Admin

	elseif ($module=='treatment'){

	include "modul/treatment/treatment.php";

	}

	// Bagian Admin

	elseif ($module=='data_pasien'){

	include "modul/data_pasien/data_pasien.php";

	}

	// Bagian Admin

	elseif ($module=='data_user'){

	include "modul/laporan/data_user.php";

	}

	// Bagian Admin

	elseif ($module=='cabang'){

	include "modul/cabang/cabang.php";

	}

	// Bagian Option

	elseif ($module=='option'){

	include "modul/mod_option/option.php"; 

	}

	// Bagian Header

	elseif ($module=='header'){

	include "modul/mod_header/header.php";

	}

	// Bagian User

	elseif ($module=='profil'){

	include "modul/mod_profil/profil.php";

	}

	// Bagian Modul

	elseif ($module=='modul'){

	include "modul/mod_modul/modul.php";

	}

	// Bagian Templates

	elseif ($module=='templates'){

	include "modul/mod_templates/templates.php";

	}

	// Bagian Identitas Website

	elseif ($module=='identitas'){

	include "modul/mod_identitas/identitas.php";

	}	

	//bagian backup database

	elseif ($module=='database') {

	include "modul/mod_database/database.php";

	}

	// Data User

	elseif ($module=='user'){

	include "modul/mod_user/user.php";

	}

	//bagian hak akses users

	elseif ($module=='log'){

	include "modul/mod_log/log.php";

	}

	//bagian data pasien

	elseif ($module=='pasien') {

	include "modul/mod_pasien/pasien.php";

	}	

	elseif ($module=='pendaftarbaru'){

	include "modul/mod_pendaftarbaru/pendaftarbaru.php";

	}

	//Data Antrian 

	elseif ($module=='data_antrian'){

	include "modul/mod_data_antrian/data_antrian.php";

	}

	//Antrian Rawat Jalan

	elseif ($module=='antrian_rwtjln'){

	include "modul/mod_antrian_rwtjln/antrian_rwtjln.php";

	}

	//Antrian Rawat Inap

	elseif ($module=='antrian_rwtinap'){

	include "modul/mod_antrian_rwtinap/antrian_rwtinap.php";

	}

	//Antrian Rawat IGD

	elseif ($module=='antrian_igd'){

	include "modul/mod_antrian_igd/antrian_igd.php";

	}

	//Data Perawatan

	elseif ($module=='data_perawatan'){

	include "modul/mod_data_perawatan/data_perawatan.php";

	}

	//Data Rawat Jalan

	elseif ($module=='pemeriksaan_rj'){

	include "modul/mod_data_pemeriksaan/pemeriksaan_rj.php";

	}

	//Data Rawat Inap

	elseif ($module=='pemeriksaan_ri'){

	include "modul/mod_data_pemeriksaan/pemeriksaan_ri.php";

	}

	//Data IGD

	elseif ($module=='pemeriksaan_igd'){

	include "modul/mod_data_pemeriksaan/pemeriksaan_igd.php";

	}

	//Data Lab

	elseif ($module=='pemeriksaan_lab'){

	include "modul/mod_data_pemeriksaan/pemeriksaan_lab.php";

	}

	//Data Rontgen

	elseif ($module=='pemeriksaan_ron'){

	include "modul/mod_data_pemeriksaan/pemeriksaan_ron.php";

	}

	//Data Transaksi

	elseif ($module=='data_transaksi'){

	include "modul/mod_data_transaksi/data_transaksi.php";

	}

	//Data Jenis Rungan

	elseif ($module=='jenis_ruangan'){

	include "modul/mod_jenis_ruangan/data_jenis_ruangan.php";

	}

	//Data Rungan

	elseif ($module=='kamar'){

	include "modul/mod_kamar/kamar.php";

	}

	/*Data Mitra*/

	elseif ($module=='data_mitra'){

	include "modul/mod_data_mitra/data_mitra.php";

	}

	/*Data Tagihan*/

	elseif ($module=='data_tagihan'){

	include "modul/mod_data_tagihan/data_tagihan.php";

	}

	/*Data Tagihan*/

	elseif ($module=='data_pembayaran'){

	include "modul/mod_data_pembayaran/data_pembayaran.php";

	}

	/*Pengeluaran Jenis*/

	elseif ($module=='pengeluaran_jenis'){

	include "modul/mod_pengeluaran_jenis/pengeluaran_jenis.php";

	}

	/* ==========================KEUAANGAN===========================*/

	/*Pengeluaran Operasional*/

	elseif ($module=='pengeluaran_pop'){

	include "modul/mod_pengeluaran_op/pengeluaran_op.php";

	}

	/*Riwayat Perawatan*/

	elseif ($module=='riwayat_perawatan'){

	include "modul/mod_riwayat/riwayat_perawatan.php";

	}

	/*View Pemeriksaan*/

	elseif ($module=='view_pemeriksaan'){

	include "modul/mod_data_pemeriksaan/view_pemeriksaan.php";

	}

	/*View Pemeriksaan Lab*/

	elseif ($module=='view_pemeriksaan_lab'){

	include "modul/mod_data_pemeriksaan/view_pemeriksaan_lab.php";

	}

	/*View Pemeriksaan Rontgen*/

	elseif ($module=='view_pemeriksaan_ron'){

	include "modul/mod_data_pemeriksaan/view_pemeriksaan_ron.php";

	}

	/*Pembayaran*/

	elseif ($module=='pembayaran'){

	include "modul/mod_pembayaran/pembayaran.php";

	}

	/*Keuangan*/

	elseif ($module=='keuangan'){

	include "modul/mod_keuangan/keuangan.php";

	}

	/*View Keuangan*/

	elseif ($module=='view_keuangan'){

	include "modul/mod_keuangan/view_keuangan.php";

	}

	/*Pemasukan*/

	elseif ($module=='pemasukan'){

	include "modul/mod_pemasukan/pemasukan.php";

	}

	/*View Pemasukan*/

	elseif ($module=='view_pemasukan'){

	include "modul/mod_pemasukan/view_pemasukan.php";

	}

	/*Pengeluaran*/

	elseif ($module=='pengeluaran'){

	include "modul/mod_pengeluaran/pengeluaran.php";

	}

	/*View Pengeluaran*/

	elseif ($module=='view_pengeluaran'){

	include "modul/mod_pengeluaran/view_pengeluaran.php";

	}

	/*View Detail Pengeluaran*/

	elseif ($module=='det_pengeluaran'){

	include "modul/mod_pengeluaran/view_det_pengeluaran.php";

	}

	/*View Kas*/

	elseif ($module=='kas'){

	include "modul/mod_kas/kas.php";

	}

	/*View Obat Masuk*/

	elseif ($module=='view_om'){

	include "modul/mod_obat_masuk/view_obat_masuk.php";

	}

	/*Laporan Rawat Jalan*/

	elseif ($module=='lap_rj'){

	include "modul/mod_lap/lap_rwt_jln.php";

	}

	elseif ($module=='lap_ri'){

	include "modul/mod_lap/lap_rwt_inap.php";

	}

	elseif ($module=='lap_igd'){

	include "modul/mod_lap/lap_igd.php";

	}

	/*Laporan Pemeriksaan Pasien*/

	elseif ($module=='lap_pem'){

	include "modul/mod_lap/lap_pemeriksaan.php";

	}

	/*Laporan Uji Lab*/

	elseif ($module=='lap_lab'){

	include "modul/mod_lap/lap_lab.php";

	}

	/*Laporan Rontgen*/

	elseif ($module=='lap_ron'){

	include "modul/mod_lap/lap_ron.php";

	}

	/*Laporan Pembayaran Tagihan*/

	elseif ($module=='lap_pem_tag'){

	include "modul/mod_lap/lap_pem_tag.php";

	}

	/*Laporan Pembayaran Resep*/

	elseif ($module=='lap_pem_rsp'){

	include "modul/mod_lap/lap_pem_rsp.php";

	}

	/*Laporan Pembayaran Resep*/

	elseif ($module=='jenis_tindakan'){

	include "modul/mod_jenis_tindakan/data_jenis_tindakan.php";

	}

	/*Penjualan Obat*/

	elseif ($module=='penjualan_obat'){

	include "modul/mod_penjualan_obat/jualobat.php";

	}

	/* Setting Menu */

	elseif ($module=='set_menu'){

	include "modul/mod_set_menu/set_menu.php";

	}

	/* Sub Menu */

	elseif ($module=='sub_menu'){

	include "modul/mod_sub_menu/sub_menu.php";

	}

	/* Menu Sub */

	elseif ($module=='menu_sub'){

	include "modul/mod_menu_sub/menu_sub.php";

	}

	/* Jenis User */

	elseif ($module=='jenis_user'){

	include "modul/mod_jenis_user/jenis_user.php";

	}

	/* Jenis User */

	elseif ($module=='rd'){

	include "modul/mod_lap/lap_rd.php";

	}

	/* Jenis User */

	elseif ($module=='identitas'){

	include "modul/mod_identitas/indetitas.php";

	}

	/* Jenis User */

	elseif ($module=='pembayaran_po'){

	include "modul/mod_penjualan_obat/data_po.php";

	}

	/* Jenis User */

	elseif ($module=='tunggakan'){

	include "modul/mod_tunggakan/tunggakan.php";

	}

	/* Jenis User */

	elseif ($module=='pelunasan'){

	include "modul/mod_tunggakan/pelunasan.php";

	}

	/* Jenis User */

	elseif ($module=='jenis_bayar'){

	include "modul/mod_jenis_bayar/jenis_bayar.php";

	}

	elseif ($module=='kasir'){

	include "modul/mod_kasir/kasir.php";

	}

	elseif ($module=='perawatan'){

	include "modul/perawatan/perawatan.php";

	}

	elseif ($module=='history_p'){

	include "modul/history_perawatan/history_perawatan.php";

	}

	elseif ($module=='history_transaksi'){

	include "modul/history_transaksi/history_transaksi.php";

	}

	elseif ($module=='history_pasien'){

	include "modul/history_pasien/history_pasien.php";

	}

	elseif ($module=='pembayaran_ks'){

	include "modul/pembayaran_ks/pembayaran_ks.php";

	}

	elseif ($module=='pembelian_k'){

	include "modul/pembelian_k/pembelian_k.php";

	}

	elseif ($module=='pembelian_t'){

	include "modul/pembelian_t/pembelian_t.php";

	}

	elseif ($module=='lap_pempro'){

	include "modul/lap_pembelian/history_beli_t.php";

	}

	elseif ($module=='dokter'){

	include "modul/data_dokter/data_dokter.php";

	}

	elseif ($module=='karyawan'){

	include "modul/data_karyawan/data_karyawan.php";

	}

	elseif ($module=='gudang'){

	include "modul/gudang/gudang_list.php";

	}

	elseif ($module=='barang_masuk'){

	include "modul/mod_barang_masuk/barang_masuk.php";

	}

	elseif ($module=='barang_keluar'){

	include "modul/mod_barang_keluar/barang_keluar.php";

	}

	elseif ($module=='lap_stock'){

	include "modul/laporan_stok/laporan_stok.php";

	}

	elseif ($module=='penerimaan'){

	include "modul/penerimaan/penerimaan.php";

	}

	elseif ($module=='reture'){

	include "modul/reture/reture.php";

	}

	elseif ($module=='reture_produk'){

	include "modul/reture_produk/reture_produk.php";

	}

	elseif ($module=='gudang_cabang'){

	include "modul/gudang_cabang/gudang_list.php";

	}

	elseif ($module=='pasien_baru'){

	include "modul/pasien_baru/pasien_baru.php";

	}

	elseif ($module=='pasca_treatment'){

	include "modul/pasca_treatment/pasca_treatment.php";

	}

	elseif ($module=='lap_transaksi'){

	include "modul/lap_transaksi/lap_transaksi.php";

	}

	elseif ($module=='history_pc'){
	include "modul/history_pc/history_pc.php";
	}
	
	
	elseif ($module=='history_pcp'){
		include "modul/history_pcp/history_pcp.php";
		}

	elseif ($module=='set_print'){
	include "modul/set_print/set_print.php";
	}

	elseif ($module=='lr'){
	include "modul/mod_lr/lr.php";
	}

	elseif ($module=='neraca'){
	include "modul/mod_neraca/neraca.php";
	}

	elseif ($module=='piutang'){
	include "modul/mod_piutang/piutang.php";
	}

	elseif ($module=='rutin'){
	include "modul/mod_rutin/rutin.php";
	}

	else if ($module=='asuransi'){

	include "modul/mod_asuransi/asuransi.php";

	}

	else if ($module=='antrian'){

	include "modul/history_antrian/history_antrian.php";

	}

	// Apabila modul tidak ditemukan

	else {

?>

	<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>

<?php

	}

?>