<template>
<div>
    <xyz-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h4 class="card-title">Daftar Pesanan</h4>
            </div>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Atribut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(produk) in dataProduk" :key="produk.faktur" @click="selectJobs(produk.id_order_item)">
                        <td>{{ produk.id_order_item }}</td>
                        <td>{{ produk.tanggal }}</td>
                        <td>{{ produk.status }}</td>
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
            selectedClass: '',
            smeSearch: '',
            nama: '',
            atribut: '',
            harga: 0,
            stok: 0
        }
    },
	methods: {
		checkToken() {
			if (localStorage.getItem('tknxyz') == null) {
				window.location.assign('#/xyz-home')
			}
		},
        selectJobs(cId) {
            return window.location.assign('#/xyz-data-pesanan-detail/' + cId)
        },
		loadDataProduk() {
			if (localStorage.getItem('tknxyz') != null) {
				axios.get(process.env.API_HOST + '/api/xyz-view-pesanan.php')
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
        addProduk() {
            let formData = new FormData();

            formData.append('nama', this.nama)
            formData.append('atribut', this.atribut)
            formData.append('harga', this.harga)
            formData.append('stok', this.stok)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/xyz-create-produk.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                location.reload()
            })
            .catch(response => {
                console.log(response)
            })
        },
        deleteClass(sku){
            let formData = new FormData();

            formData.append('sku', sku)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/xyz-delete-produk.php?sku=' + sku,
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                location.reload()
            })
            .catch(response => {
                console.log(response)
            })
        }
	},
	mounted() {
		this.checkToken()
		this.loadDataProduk()
	}
}
</script>

<style scoped>
tr td {
    cursor: pointer;
}
</style>
