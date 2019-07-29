<template>
<div>
    <agen-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h4 class="card-title">Daftar Produk</h4>
            </div>
            <div class="col-lg-4 input-group">
                <input class="form-control mr-2" v-model="smeSearch" type="text" placeholder="Search..">
            </div>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">SKU</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Atribut</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stock Tersedia</th>
                        <th scope="col" width="130px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(produk) in filteredList" :key="produk.sku">
                        <td>{{ produk.sku }}</td>
                        <td>{{ produk.nama }}</td>
                        <td>{{ produk.atribut }}</td>
                        <td>{{ produk.harga }}</td>
                        <td>{{ produk.stok }}</td>
                        <td>
                            <b-button size="sm" v-b-modal.addCart variant="danger" @click="selectedClass = produk">Order Now</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

	<b-modal id="addCart" hide-footer title="Jumlah Pemesanan">
        <b-form>
            <b-form-group label="Masukan Quantity">
                <b-form-input v-model="qty" type="text" required placeholder="QTY"></b-form-input>
            </b-form-group>

            <b-button variant="primary" @click="addCart(selectedClass)">Masukan Cart</b-button>
        </b-form>
    </b-modal>
</div>
</template>

<script>
import axios from 'axios'
import AgenNavbar from './components/agen-navbar'

export default {
    components: {
        AgenNavbar
    },
	data() {
        return {
			urlParams: window.location.href.split('/'),
            dataProduk: [],
            selectedClass: '',
            smeSearch: '',
            qty: '',
            total: ''
        }
    },
	methods: {
		checkToken() {
			if (localStorage.getItem('tknagn') == null) {
				window.location.assign('#/agen-home')
			}
		},
		loadDataProduk() {
			if (localStorage.getItem('tknagn') != null) {
				axios.get(process.env.API_HOST + '/api/xyz-view-produk.php')
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
		addCart() {
			let formData = new FormData();

            formData.append('nik', localStorage.tknagn)
            formData.append('sku', this.selectedClass.sku)
            formData.append('qty', this.qty)
            formData.append('harga', this.selectedClass.harga)
            formData.append('total', this.selectedClass.harga * this.qty)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/agen-add-cart.php',
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
	},
	computed: {
        filteredList() {
            return this.dataProduk.filter(dataProduks => {
                return dataProduks.nama.toLowerCase().includes(this.smeSearch.toLowerCase())
            })
        }
    }
}
</script>