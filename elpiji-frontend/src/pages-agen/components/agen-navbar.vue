<template>
    <b-navbar toggleable="lg" type="dark" variant="success">
		
		<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

		<b-collapse class="container" id="nav-collapse" is-nav>
			<b-navbar-nav>
				<b-nav-item href="#/agen-dashboard">Produk</b-nav-item>
				<b-nav-item href="#/agen-order-list">
					Order List
					<b-badge variant="light">{{ cartSum }}</b-badge>
				</b-nav-item>
				<b-nav-item href="#/agen-transaksi">Daftar Transaksi</b-nav-item>
			</b-navbar-nav>

			<b-navbar-nav class="ml-auto">
				<b-button size="sm" class="my-2 my-sm-0" href="/" onclick="window.localStorage.removeItem('tknagn');">Logout</b-button>
			</b-navbar-nav>
		</b-collapse>
	</b-navbar>
</template>

<script>
import axios from 'axios'

export default {
	data() {
        return {
            dataCart: [],
			cartSum: ''
        }
    },
	methods: {
		loadDataProduk() {
			if (localStorage.getItem('tknagn') != null) {
				axios.get(process.env.API_HOST + '/api/agen-view-cart.php?nik=' + localStorage.tknagn)
				.then(response => {
					this.dataCart = response.data
					
					if(this.dataCart.pesan != 404) {
						this.cartSum = this.dataCart.length
					} else {
						this.cartSum = '0'
					}
				})
				.catch(error =>  {
					console.log(error)
				})
			} else {
				window.location.assign('#/agen-home')
        	}
		},
	},
	mounted() {
		this.loadDataProduk()
	},
}
</script>


<style scoped>
.navbar-dark .navbar-nav .nav-link {
    color: #fff;
    font-weight: bold;
}
</style>
