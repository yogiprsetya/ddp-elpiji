<template>
<div>
    <xyz-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h4 class="card-title">Laporan Penjualan</h4>
            </div>
            <table class="table mt-5">
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
import XyzNavbar from './components/ptmn-navbar'

export default {
    components: {
        XyzNavbar
    },
	data() {
        return {
            dataProduk: [],
            urlParams: window.location.href.split('/'),
        }
    },
	methods: {
		checkToken() {
			if (localStorage.getItem('tknptmn') == null) {
				window.location.assign('#/ptmn-home')
			}
		},
		loadDataProduk() {
			if (localStorage.getItem('tknptmn') != null) {
				axios.get(process.env.API_HOST + '/api/ptmn-laporan-penjualan.php?atribut=' + this.urlParams[this.urlParams.length-1])
				.then(response => {
                    this.dataProduk = response.data
                    console.log(response.data)
                    console.log(process.env.API_HOST + '/api/ptmn-laporan-penjualan.php?atribut=' + this.urlParams[this.urlParams.length-1])
				})
				.catch(error =>  {
					console.log(error)
				})
			} else {
				window.location.assign('#/ptmn-home')
        	}
        },
        alwaysReload() {
                location.reload()
        }
	},
	mounted() {
        // this.alwaysReload()
		this.checkToken()
        this.loadDataProduk()
    },
    watch:{
        $route (to, from){
            this.alwaysReload()
        }
    }
}
</script>