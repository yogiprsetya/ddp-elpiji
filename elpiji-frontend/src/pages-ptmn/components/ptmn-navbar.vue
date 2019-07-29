<template>
    <b-navbar toggleable="lg" type="dark" variant="primary">
		
		<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

		<b-collapse class="container" id="nav-collapse" is-nav>
			<b-navbar-nav>
				<b-nav-item href="#/ptmn-laporan/non-supsidi">Penjualan Non-Supsidi</b-nav-item>
				<b-nav-item href="#/ptmn-laporan/supsidi">Penjualan Supsidi</b-nav-item>
			</b-navbar-nav>

			<b-navbar-nav class="ml-auto">
				<b-button size="sm" class="my-2 my-sm-0" href="/" onclick="window.localStorage.removeItem('tknptmn');">Logout</b-button>
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
