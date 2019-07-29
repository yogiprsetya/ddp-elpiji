<template>
<div>
    <xyz-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h4 class="card-title">Laporan Penjualan</h4>
            </div>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Atribut</th>
                        <th scope="col">Harga</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(produk) in dataProduk" :key="produk.faktur">
                        <td>{{ produk.id_order_item }}</td>
                        <td>{{ produk.nama }}</td>
                        <td>{{ produk.atribut }}</td>
                        <td>{{ produk.harga }}</td>
                        <td>{{ produk.qty }}</td>
                        <td>{{ produk.total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
</template>

<script>
import axios from 'axios'
import XyzNavbar from './components/xyz-navbar'

export default {
    components: {
        XyzNavbar
    },
	data() {
        return {
            dataProduk: [],
        }
    },
	methods: {
		checkToken() {
			if (localStorage.getItem('tknxyz') == null) {
				window.location.assign('#/xyz-home')
			}
		},
		loadDataProduk() {
			if (localStorage.getItem('tknxyz') != null) {
				axios.get(process.env.API_HOST + '/api/xyz-laporan-penjualan.php')
				.then(response => {
                    this.dataProduk = response.data
				})
				.catch(error =>  {
					console.log(error)
				})
			} else {
				window.location.assign('#/xyz-home')
        	}
		},
	},
	mounted() {
		this.checkToken()
		this.loadDataProduk()
	}
}
</script>