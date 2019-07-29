<template>
<div>
    <xyz-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h4 class="card-title">Daftar Produk</h4>
            </div>
            <div class="col-lg-4 input-group">
                <input class="form-control mr-2" v-model="smeSearch" type="text" placeholder="Search..">
                <b-button variant="primary" v-b-modal.modal-tambah-produk>TAMBAH</b-button>
            </div>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">SKU</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Atribut</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stock</th>
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
                            <b-button size="sm" variant="warning">Edit</b-button>
                            <b-button size="sm" v-b-modal.deleteModal variant="danger" @click="selectedClass = produk">Hapus</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <b-modal id="modal-tambah-produk" hide-footer title="Tambah produk baru">
        <b-form>
            <b-form-group label="Nama">
                <b-form-input v-model="nama" type="text" required placeholder="Nama"></b-form-input>
            </b-form-group>
            
            <b-form-group label="Atribut">
                <b-form-input v-model="atribut" type="text" required placeholder="Atribut"></b-form-input>
            </b-form-group>

            <b-form-group label="Harga">
                <b-form-input v-model="harga" type="text" required placeholder="Harga"></b-form-input>
            </b-form-group>

            <b-form-group label="Stok">
                <b-form-input v-model="stok" type="text" required placeholder="stok"></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary" @click="addProduk()">Tambah</b-button>
        </b-form>
    </b-modal>

    <b-modal ref="deleteModal" id="deleteModal" hide-footer title="Delete Classroom">
        <p>Do you really want to <b>delete</b> {{ selectedClass.nama }}  ?</p>
        <div class="mt-1 float-right">
            <b-button variant="primary" @click="deleteClass(selectedClass.sku)">Yes</b-button>
        </div>
    </b-modal>
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
		loadDataProduk() {
			if (localStorage.getItem('tknxyz') != null) {
				axios.get(process.env.API_HOST + '/api/xyz-view-produk.php')
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