<template>
<div>
    <xyz-navbar/>

	<section class="container p-5 card mt-5">
        <b-button style="width:170px" variant="primary" v-b-modal.appr>Update Pesanan</b-button>
        <h4 class="card-title mt-5">Data Pesanan</h4>
        <p><span>Tanggal</span>: {{ dataAgen[0][0] }}</p>
        <p><span>Nama</span>: {{ dataAgen[0][1] }}</p>
        <p><span>No Telp</span>: {{ dataAgen[0][2] }}</p>
        <p><span>Alamat</span>: {{ dataAgen[0][3] }}</p>
        <p><span>Pembayaran</span>: 
            <b-badge v-if="dataAgen[0][9] == 'pending payment'" variant="danger">{{ dataAgen[0][9] }}</b-badge>
			<b-badge v-else-if="dataAgen[0][9] == 'dibayar'" variant="success">{{ dataAgen[0][9] }}</b-badge>
			<b-badge v-else variant="primary">{{ dataAgen[0][9] }}</b-badge>
        </p>

        <hr>

        <h5>Daftar barang:</h5>

        <table border="1">
            <tr>
                <td width="130">Nama Barang</td>
                <td width="100">Harga</td>
                <td width="50">QTY</td>
                <td width="100">Total</td>
            </tr>
            <tr v-for="produk in dataAgen" :key="produk">
                <td>{{ produk[5] }}</td>
                <td>{{ produk[6] }}</td>
                <td>{{ produk[7] }}</td>
                <td>{{ produk[8] }}</td>
            </tr>
        </table>


        <b-modal id="appr" hide-footer title="Kelola Status Keagenan">
            <b-form-radio-group v-model="status" :options="options" buttons button-variant="outline-success"></b-form-radio-group>
            <div class="float-right d-block">
                <b-button variant="primary" @click="updateProses()">SAVE</b-button>
            </div>
        </b-modal>
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
            urlParams: window.location.href.split('/'),
            dataAgen: [],
            status: '',
            options: [{text: 'Dibayar', value: 'dibayar'},{text: 'Pending Payment', value: 'pending payment'}]
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
				axios.get(process.env.API_HOST + '/api/xyz-data-pesanan.php?id=' + this.urlParams[this.urlParams.length-1])
                .then(response => {
                    this.dataAgen = response.data
                    console.log(this.dataAgen)
                })
                .catch(error =>  {
                    console.log(error)
                })
			} else {
				window.location.assign('#/xyz-home')
        	}
		},
        updateProses() {
            let formData = new FormData();

            formData.append('status', this.status)
            formData.append('id', this.urlParams[this.urlParams.length-1])

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/xyz-update-status.php',
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
