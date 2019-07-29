<template>
<div>
    <xyz-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h4 class="card-title">Daftar Mitra Keagenan</h4>
            </div>
            <div class="col-lg-4 input-group">
                <input class="form-control mr-2" v-model="smeSearch" type="text" placeholder="Search..">
            </div>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">SIUP</th>
                        <th scope="col">Email</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(agen) in filteredList" :key="agen.nik" @click="selectAgen(agen.nik)">
                        <td>{{ agen.nik }}</td>
                        <td>{{ agen.nama }}</td>
                        <td>{{ agen.siup }}</td>
                        <td>{{ agen.email }}</td>
                        <td>{{ agen.no_telp }}</td>
                        <td>{{ agen.alamat }}</td>
                        <td>
							<b-badge v-if="agen.status == 'pending'" variant="warning">{{ agen.status }}</b-badge>
							<b-badge v-else variant="success">{{ agen.status }}</b-badge>
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
import XyzNavbar from './components/xyz-navbar'

export default {
    components: {
        XyzNavbar
    },
	data() {
        return {
            dataAgen: [],
            smeSearch: ''
        }
    },
	methods: {
		checkToken() {
			if (localStorage.getItem('tknxyz') == null) {
				window.location.assign('#/xyz-home')
			}
		},
		loadDataAgen() {
			if (localStorage.getItem('tknxyz') != null) {
				axios.get(process.env.API_HOST + '/api/xyz-view-agen.php')
				.then(response => {
					this.dataAgen = response.data
				})
				.catch(error =>  {
					console.log(error)
				})
			} else {
				window.location.assign('#/xyz-home')
        	}
		},
		selectAgen(cId) {
            return window.location.assign('#/xyz-data-agen/' + cId)
        }
	},
	mounted() {
		this.checkToken()
		this.loadDataAgen()
	},
	computed: {
        filteredList() {
            return this.dataAgen.filter(dataAgens => {
                return dataAgens.nama.toLowerCase().includes(this.smeSearch.toLowerCase())
            })
        }
    }
}
</script>

<style scoped>
tr {
    cursor: pointer;
}
</style>
