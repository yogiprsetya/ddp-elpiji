<template>
	<b-container>
		<b-row class="front-desk text-center">
			<b-col cols="4">
				<h4>Login PT. XYZ</h4>
				<b-button href="#/xyz-home" target="_blank" variant="primary" size="lg">PT. XYZ</b-button>
			</b-col>
			<b-col cols="4">
				<h4>Login untuk mitra agen</h4>
				<b-button href="#/agen-home" target="_blank" variant="success" size="lg">Agen</b-button>
			</b-col>
			<b-col cols="4">
				<h4>Login Pertamina</h4>
				<b-button href="#/ptmn-home" target="_blank" variant="warning" size="lg">Login</b-button>
			</b-col>
		</b-row>
	</b-container>
</template>

<script>
export default {
	
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
		width: 100%;
	}

	button {
		margin: 0 10px
	}
</style>