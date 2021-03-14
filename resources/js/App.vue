<template>
	<div class="wrapper">
		<app-header v-if="this.$store.state.Auth.isLoggedIn"></app-header>
		<app-aside v-if="this.$store.state.Auth.isLoggedIn"></app-aside>
        <router-view></router-view>
		<app-footer v-if="this.$store.state.Auth.isLoggedIn"></app-footer>
	</div>
</template>

<script>
	import AppHeader from "./components/header/Header";
	import AppAside from "./components/aside/Aside";
	import AppFooter from "./components/footer/Footer";

	export default {
		name: "App",
		data(){
			return{
				token: '',
				isLoggedIn : false,
			}
		},
		components: {
			AppHeader,
			AppAside,
			AppFooter,
		}
	}
</script>