<template>
<div>
    <xyz-navbar/>
	<section class="container p-5 card mt-5">
        <div class="row no-gutters">
            <h3>Welcome, Pertamina!</h3>
        </div>
    </section>
</div>
</template>

<script>
import XyzNavbar from './components/ptmn-navbar'

export default {
    components: {
        XyzNavbar
    },
	methods: {
		checkToken() {
			if (localStorage.getItem('tknptmn') == null) {
				window.location.assign('#/ptmn-home')
			}
		},
	},
	mounted() {
		this.checkToken()
	}
}
</script>