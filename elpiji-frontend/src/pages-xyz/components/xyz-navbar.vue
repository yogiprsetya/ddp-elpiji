<template>
    <b-navbar toggleable="lg" type="dark" variant="primary">
		
		<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

		<b-collapse class="container" id="nav-collapse" is-nav>
			<b-navbar-nav>
				<b-nav-item href="#/xyz-dashboard">Kelola Agen</b-nav-item>
				<b-nav-item href="#/xyz-data-produk">Data Produk</b-nav-item>
				<b-nav-item href="#/xyz-data-pesanan">Daftar Pesanan</b-nav-item>
				<b-nav-item href="#/xyz-laporan-penjualan">Laporan Penjualan</b-nav-item>
			</b-navbar-nav>

			<b-navbar-nav class="ml-auto">
				<b-button size="sm" class="my-2 my-sm-0" href="/" onclick="window.localStorage.removeItem('tknxyz');">Logout</b-button>
			</b-navbar-nav>
		</b-collapse>
	</b-navbar>
</template>

<style scoped>
.navbar-dark .navbar-nav .nav-link {
    color: #fff;
    font-weight: bold;
}
</style>
