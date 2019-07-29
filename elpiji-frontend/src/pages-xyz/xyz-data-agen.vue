<template>
<div>
    <xyz-navbar/>
	<section class="container p-5 card mt-5">
        <b-button style="width:100px" variant="primary" v-b-modal.appr>Kelola</b-button>
        <h4 class="card-title mt-5">Detail Mitra Keagenan</h4>
        <p><span>NIK</span>: {{ dataAgen.nik }}</p>
        <p><span>Nama</span>: {{ dataAgen.nama }}</p>
        <p><span>SIUP</span>: {{ dataAgen.siup }}</p>
        <p><span>Email</span>: {{ dataAgen.email }}</p>
        <p><span>No Telp</span>: {{ dataAgen.no_telp }}</p>
        <p><span>Alamat</span>: {{ dataAgen.alamat }}</p>
        <p><span>Status</span>: 
            <b-badge v-if="dataAgen.status == 'pending'" variant="warning">{{ dataAgen.status }}</b-badge>
			<b-badge v-else-if="dataAgen.status == 'approve'" variant="danger">{{ dataAgen.status }}</b-badge>
			<b-badge v-else variant="primary">{{ dataAgen.status }}</b-badge>
        </p>


        <b-modal id="appr" hide-footer title="Kelola Status Keagenan">
            <p v-if="tunggudong">Mohon tunggu</p>
            <b-form-radio-group v-model="status" :options="options" buttons button-variant="outline-success"></b-form-radio-group>
            <div class="float-right d-block">
                <b-button variant="primary" @click="updateProses()">SAVE</b-button>
            </div>
        </b-modal>
    </section>
</div>
</template>

<script>
import XyzNavbar from './components/xyz-navbar'
import axios from 'axios'

export default {
    components: {
        XyzNavbar
    },
	data() {
        return {
            urlParams: window.location.href.split('/'),
            dataAgen: [],
            status: '',
            nama: '',
            email: '',
            options: [{text: 'Pending', value: 'pending'},{text: 'Approve', value: 'approve'}],
            tunggudong: false
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
				axios.get(process.env.API_HOST + '/api/xyz-data-agen.php?id=' + this.urlParams[this.urlParams.length-1])
                .then(response => {
                    this.dataAgen = response.data[0]
                    this.status = this.dataAgen.status
                    this.nama = this.dataAgen.nama
                    this.email = this.dataAgen.email
                })
                .catch(error =>  {
                    console.log(error)
                })
			} else {
				window.location.assign('#/xyz-home')
        	}
		},
        emailVerification() {
            this.tunggudong = true
            let formData = new FormData();

            formData.append('email', this.email)
            formData.append('nama', this.nama)
            formData.append('link', process.env.PUBLIC_HOST + '#/agen-email-confirmation/' + this.urlParams[this.urlParams.length-1])

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/xyz-email-verification.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                console.log(response.data)
                this.tunggudong = false
                location.reload()
            })
            .catch(response => {
                console.log("error verification", response)
            })
        },
        updateProses() {
            let formData = new FormData();

            formData.append('status', this.status)
            formData.append('id', this.urlParams[this.urlParams.length-1])

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/xyz-verifikasi-agen.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                if (this.status == "approve") {
                    this.emailVerification()
                }
            })
            .catch(response => {
                console.log(response)
            })
        }
	},
	mounted() {
		this.checkToken()
		this.loadDataAgen()
	}
}
</script>

<style scoped>
    span {
        width: 100px;
        display: inline-block;
    }
</style>
