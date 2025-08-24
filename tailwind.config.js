module.exports = {
	content: [
		'./**/*.php',
		'./resources/**/*.php',
		'./resources/**/*.js',
		'./resources/**/*.css',
		'./woocommerce/**/*.php',
		'./woocommerce/single-product/**/*.php',
		'./woocommerce/single-product/*.php',
		'./woocommerce/single-product/praliny.php'
	],
	theme: {
		extend: {
			fontFamily: {
				didot: ['DidoDidot', 'serif'],
			},
			maxWidth: {
				'content': '1280px',
			},
		},
	},
	safelist: [
		'sm:top-[175px]',
		'md:top-[236px]',
		'top-[173px]', // if used via JS
	],
	plugins: [],
}
