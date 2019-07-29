<template>
	<b-container>
		<b-row class="front-desk">
			<b-button variant="primary" size="lg" v-b-modal.modal-login>Login</b-button>
			<b-button variant="success" size="lg" v-b-modal.modal-reg>Registrasi</b-button>
		</b-row>
		<p>user: yogiprazz@ymail.com</p>
		<p>pass: 555</p>

		<b-modal id="modal-login" hide-footer title="Login untuk Agen">
			<b-form>
                <b-form-group label="Email">
                    <b-form-input v-model="email" type="text" required placeholder="Email"></b-form-input>
                </b-form-group>

                <b-form-group label="Password">
                    <b-form-input v-model="katasandi" type="password" required placeholder="Password"></b-form-input>
                </b-form-group>

                <b-button type="submit" variant="primary" @click="login()">Masuk</b-button>
            </b-form>
		</b-modal>

		<b-modal id="modal-reg" hide-footer title="Pendaftaran Mitra Keagenan">
			<b-badge variant="success" v-if="bisaDaftar">Tunggu Email Verifikasi dari PT. XYZ</b-badge>
			<b-form>
				<b-row>
					<b-col md="3">NIK</b-col>
					<b-col md="9">
						<b-form-input v-model="nik" type="text" required placeholder="Nomor Induk Kependudukan"></b-form-input>
					</b-col>
                </b-row>

				<b-row>
					<b-col md="3">Nama</b-col>
					<b-col md="9">
						<b-form-input v-model="nama" type="text" required placeholder="Nama Sesuai KTP"></b-form-input>
					</b-col>
                </b-row>

				<b-row>
					<b-col md="3">SIUP</b-col>
					<b-col md="9">
						<b-form-input v-model="siup" type="text" required placeholder="Surat Izin Usaha Perdagangan"></b-form-input>
					</b-col>
                </b-row>

				<b-row>
					<b-col md="3">Email</b-col>
					<b-col md="9">
						<b-form-input v-model="email" type="text" required placeholder="Email aktif"></b-form-input>
					</b-col>
                </b-row>

				<b-row>
					<b-col md="3">No Telpon</b-col>
					<b-col md="9">
						<b-form-input v-model="no_telp" type="text" required placeholder="No Telpon"></b-form-input>
					</b-col>
                </b-row>

				<b-row>
					<b-col md="3">Alamat</b-col>
					<b-col md="9">
						<b-form-input v-model="alamat" type="text" required placeholder="Alamat Usaha"></b-form-input>
					</b-col>
                </b-row>

				<b-row>
					<b-col md="3">Password</b-col>
					<b-col md="9">
						<b-form-input v-model="katasandi" type="password" required placeholder="Password"></b-form-input>
					</b-col>
                </b-row>

                <b-button type="submit" variant="primary" @click="daftar()">DAFTAR</b-button>
            </b-form>
		</b-modal>
	</b-container>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			bisaDaftar: false,
			nik: '',
			nama: '',
			siup: '',
			email: '',
			no_telp: '',
			alamat: '',
            katasandi: ''
		}
    },
    mounted() {
		if (localStorage.getItem('tknagn') != null) {
			window.location.assign('#/agen-dashboard')
		}
	},
	methods : {
        login(){
            let formData = new FormData();

            formData.append('email', this.email)
            formData.append('katasandi', this.katasandi)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/agen-login.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                localStorage.tknagn = response.data[0].nik
                if (response.data[0].nik) {
                    window.location = "#/agen-dashboard"
                }
            })
            .catch(response => {
                console.log(response)
            })
		},
		daftar() {
            let formData = new FormData();

            formData.append('nik', this.nik)
            formData.append('nama', this.nama)
            formData.append('siup', this.siup)
            formData.append('email', this.email)
            formData.append('no_telp', this.no_telp)
            formData.append('alamat', this.alamat)
            formData.append('katasandi', this.katasandi)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/agen-registrasi.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
				this.bisaDaftar = true
				console.log(response.data)
            })
            .catch(response => {
                console.log(response)
            })
        }
    }
}
</script>

<style scoped>
	.container {
		height: 500px;
		position: relative;
	}

	.front-desk {
		margin: 0;
		position: absolute;
		top: 50%;
		left: 50%;
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	}

	button {
		margin: 0 10px
	}

	.row {
		margin-bottom: 15px;
	}
</style>
