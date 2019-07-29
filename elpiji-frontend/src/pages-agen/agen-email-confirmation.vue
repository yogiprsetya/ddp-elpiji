<template>
	<b-container>
		<b-row>
			<b-col class="text-center mt-5">
				<b-badge variant="success" class="mb-3 mt-5" v-show="notice" size="lg">Akun berhasil di validasi!</b-badge>
				<br>
				<b-button variant="primary" size="lg" href="#/agen-home">Login</b-button>
			</b-col>
		</b-row>
	</b-container>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
            urlParams: window.location.href.split('/'),
			notice: false,
			nik: ''
		}
    },
    mounted() {
		this.login()
	},
	methods : {
        login() {
            let formData = new FormData();

            formData.append('nik', this.urlParams[this.urlParams.length-1])

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/agen-email-confirmation.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                this.notice = true
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
	}

	button {
		margin: 0 10px
	}

	.badge.badge-success {
		font-size: 2rem;
	}
</style>
