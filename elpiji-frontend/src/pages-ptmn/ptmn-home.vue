<template>
	<b-container>
		<b-row class="front-desk">
			<b-button variant="primary" size="lg" v-b-modal.modal-login>Login</b-button>
		</b-row>
		<p>user: ptmn@admin.com</p>
		<p>pass: admin</p>

		<b-modal id="modal-login" hide-footer title="Login untuk Pertamina">
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
	</b-container>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			email: '',
            katasandi: ''
		}
    },
	methods : {
        login(){
            let formData = new FormData();

            formData.append('email', this.email)
            formData.append('katasandi', this.katasandi)

            axios({
                method: 'post',
                url: process.env.API_HOST + '/api/ptmn-login.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                localStorage.tknptmn = response.data[0].id_user
                if (response.data[0].id_user) {
                    window.location = "#/ptmn-dashboard"
				}
				console.log(response.data)
            })
            .catch(response => {
                console.log(response)
            })
        },
        checkToken() {
			if (localStorage.getItem('tknptmn') != null) {
				window.location.assign('#/ptmn-dashboard')
			}
		}
    },
    mounted() {
		this.checkToken()
	},
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
</style>