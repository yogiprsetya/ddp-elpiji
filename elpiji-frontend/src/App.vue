<template>
	<main>
		<router-view/>
	</main>
</template>

<script>
export default {
}
</script>

<style>
	@font-face {
		font-family: 'Nunito Sans';
		font-style: normal;
		font-weight: 400;
		src: local('Nunito Sans Regular'), local('NunitoSans-Regular'), url('../static/fonts/nunitosans.woff2') format('woff2');
		unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
	}

	@font-face {
		font-family: 'Nunito Sans';
		font-style: normal;
		font-weight: 600;
		src: local('Nunito Sans SemiBold'), local('NunitoSans-SemiBold'), url('../static/fonts/nunitosans-semibold.woff2') format('woff2');
		unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
	}

	body {
		margin: 0;
		font-family: 'Nunito Sans', sans-serif;
		font-size: 1rem;
		color: #222233;
		background: #fff;
	}

	img {
		max-width: 100%;
	}

	h1, h2 {
		margin: 0
	}

	hr {
        border: solid medium #ddd;
        border-width: 1px 0 0;
        clear: both;
        margin: 22px 0 21px;
        height: 0;
    }
</style>