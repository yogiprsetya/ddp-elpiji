<template>
<div>
    <agen-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <div class="col-lg-8">
                <h4 class="card-title">Daftar PO</h4>
            </div>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Atribut</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(produk) in dataCart" :key="produk.sku">
                        <td>{{ produk.nama }}</td>
                        <td>{{ produk.atribut }}</td>
                        <td>{{ produk.harga }}</td>
                        <td>{{ produk.qty }}</td>
                        <td>{{ produk.total }}</td>
                        
                    </tr>
                    <tr>
                        <td class="text-center" colspan="4"><strong>Grand Total:</strong></td>
                        <td><strong>{{ grandTotal }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="5">
                            <b-button v-b-modal.bayar variant="primary" @click="selectedClass = dataCart">BAYAR</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <b-modal id="bayar" hide-footer title="Pembayaran">
        <p>Lakukan pembayaran sejumlah <b>Rp. {{ grandTotal }}</b> daftar rekening berikut:</p>
        
        <div class="mt-1 float-right">
            <b-button variant="primary" @click="bayar(selectedClass)">Yes</b-button>
        </div>
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
            dataCart: [],
            selectedClass: '',
            grandTotal: 0
        }
    },
	methods: {
		loadDataProduk() {
			if (localStorage.getItem('tknagn') != null) {
				axios.get(process.env.API_HOST + '/api/agen-view-cart-detail.php?nik=' + localStorage.tknagn)
				.then(response => {
					this.dataCart = response.data

                    for (var i = 0; i < this.dataCart.length; i++) {
                        this.grandTotal += parseInt(this.dataCart[i].total);
                    }
				})
				.catch(error =>  {
					console.log(error)
				})
			} else {
				window.location.assign('#/agen-home')
        	}
		},
        bayar() {
            var calon_id = (Math.floor(Math.random() * 10) + 1) + new Date().getTime() + (Math.floor(Math.random() * 10) + 1)
            let tunggu = 0

            for (var i = 0; i < this.selectedClass.length; i++) {
                tunggu++
                
                var formData = new FormData();
                formData.append('ids', calon_id)
                formData.append('nik', localStorage.tknagn)
                formData.append('sku', this.selectedClass[i].sku)
                formData.append('qty', this.selectedClass[i].qty)
                formData.append('harga', this.selectedClass[i].harga)
                formData.append('total', this.selectedClass[i].harga * this.selectedClass[i].qty)

                axios({
                    method: 'post',
                    url: process.env.API_HOST + '/api/agen-bayar.php',
                    data: formData,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                })
                .then(response => {
                    
                })
                .catch(response => {
                    console.log(response)
                })
            }
            if (tunggu == this.selectedClass.length) {
                var formData = new FormData();
                formData.append('ids', calon_id)
                formData.append('nik', localStorage.tknagn)
                axios({
                    method: 'post',
                    url: process.env.API_HOST + '/api/agen-simpan-pembelian.php',
                    data: formData,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                })
                .then(response => {
                    location.reload()
                })
                .catch(response => {console.log(response)})
            }
        }
	},
	mounted() {
		this.loadDataProduk()
	},
}
</script>