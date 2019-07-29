import Vue from 'vue'
import Router from 'vue-router'

import Home from '@/home'
import AgenHome from '@/pages-agen/agen-home'
import AgenDashboard from '@/pages-agen/agen-dashboard'
import AgenEmailConfirmation from '@/pages-agen/agen-email-confirmation'
import AgenOrderList from '@/pages-agen/agen-order-list'
import AgenTransaksi from '@/pages-agen/agen-transaksi'

import XyzHome from '@/pages-xyz/xyz-home'
import XyzDashboard from '@/pages-xyz/xyz-dashboard'
import XyzDataAgen from '@/pages-xyz/xyz-data-agen'
import XyzDataProduk from '@/pages-xyz/xyz-data-produk'
import XyzDataPesanan from '@/pages-xyz/xyz-data-pesanan'
import xyzDataPesananDetail from '@/pages-xyz/xyz-data-pesanan-detail'
import xyzLaporanPenjualan from '@/pages-xyz/xyz-laporan-penjualan'

import PtmnHome from '@/pages-ptmn/ptmn-home'
import PtmnDashboard from '@/pages-ptmn/ptmn-dashboard'
import PtmnLaporanPenjualan from '@/pages-ptmn/ptmn-laporan-penjualan'

Vue.use(Router)

export default new Router({
  	routes: [{
		path: '/',
		name: 'Home',
		component: Home
	},{
		path: '/agen-home',
		name: 'Agen Home',
		component: AgenHome
    },{
		path: '/agen-dashboard',
		name: 'Agen Dashboard',
		component: AgenDashboard
    },{
		path: '/agen-email-confirmation/:id',
		name: 'Agen Email Confirmation',
		component: AgenEmailConfirmation
    },{
		path: '/agen-transaksi',
		name: 'Agen Transaksi',
		component: AgenTransaksi
    },{
		path: '/agen-order-list',
		name: 'Agen Order List',
		component: AgenOrderList
    },{
		path: '/xyz-home',
		name: 'Xyz Home',
		component: XyzHome
    },{
		path: '/xyz-dashboard',
		name: 'Xyz Dashboard',
		component: XyzDashboard
    },{
		path: '/xyz-data-agen/:id',
		name: 'Xyz Data Agen',
		component: XyzDataAgen
    },{
		path: '/xyz-data-produk',
		name: 'Xyz Data Produk',
		component: XyzDataProduk
    },{
		path: '/xyz-data-pesanan',
		name: 'Xyz Data Pesanan',
		component: XyzDataPesanan
    },{
		path: '/xyz-data-pesanan-detail/:id',
		name: 'xyz Data Pesanan Detail',
		component: xyzDataPesananDetail
    },{
		path: '/xyz-laporan-penjualan',
		name: 'xyz Laporan Penjualan',
		component: xyzLaporanPenjualan
    },{
		path: '/ptmn-home',
		name: 'Ptmn Home',
		component: PtmnHome
    },{
		path: '/ptmn-dashboard',
		name: 'Ptmn Dashboard',
		component: PtmnDashboard
    },{
		path: '/ptmn-laporan/:id',
		name: 'Ptmn Laporan Penjualan',
		component: PtmnLaporanPenjualan
    }]
})