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
                        <th scope="col">ID ORDER</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(produk) in dataProduk" :key="produk.faktur" @click="selectJobs(produk.id_order_item)">
                        <td>{{ produk.id_order_item }}</td>
                        <td>{{ produk.tanggal }}</td>
                        <td>
                            <b-badge v-if="produk.status == 'pending payment'" variant="danger">{{ produk.status }}</b-badge>
                            <b-badge v-else-if="produk.status == 'dibayar'" variant="success">{{ produk.status }}</b-badge>
                            <b-badge v-else variant="primary">{{ produk.status }}</b-badge>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
</template>

<script>
import axios from 'axios'
import XyzNavbar from './components/agen-navbar'

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
			if (localStorage.getItem('tknagn') == null) {
				window.location.assign('#/agen-home')
			}
		},
        selectJobs(cId) {
            return window.location.assign('#/xyz-transaksi-detail/' + cId)
        },
		loadDataProduk() {
			if (localStorage.getItem('tknagn') != null) {
				axios.get(process.env.API_HOST + '/api/agen-transaksi.php?nik=' + localStorage.tknagn)
				.then(response => {
					this.dataProduk = response.data
				})
				.catch(error =>  {
					console.log(error)
				})
			} else {
				window.location.assign('#/agen-home')
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
