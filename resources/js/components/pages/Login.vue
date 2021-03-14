<template>
   <div class="container-login100" style="background-image: url('/admin/lte/images/bg-01.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form  class="login100-form validate-form">
				<span class="login100-form-title p-b-37">
					Login
				</span>

				<div class="wrap-input100 validate-input m-b-20"  :class="{'alert-validate': !! error.username}" data-validate="Enter username or email">
					<span v-if="checkErrUser" @click="clearErrorUser" class="btn-hide-validate"><i  class="fa fa-times-circle"></i></span>
					<input class="input100"  v-model="data.username" type="text"  placeholder="username or email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25"  :class="{'alert-validate': !! error.password}" data-validate = "Enter password">
					<span v-if="checkErrPass"  @click="clearErrorPass" class="btn-hide-validate"><i class="fa fa-times-circle"></i></span>
					<input class="input100" v-model="data.password" type="password"  placeholder="password">
					<span class="focus-input100"></span>
				</div>
				<div class="text-red-500 mb-6" v-if="generalError">
					{{ generalError }}
				</div>
				<div class="container-login100-form-btn">
					<button class="login100-form-btn" @click="onSubmit" :disabled="isLogging" :loading="isLogging">
						{{isLogging ? 'Loging.....':'Login'}}
					</button>
				</div>
			</form>

			
		</div>
	</div>
</template>
<script>
import Input from "./points/Input.vue";
export default {
	name: "Login",
	components: {Input},
	data: () => {
        return {
			isLogging : false,
			data:{
 				username: "",
            	password: "",
			},
			error: {
				
			},
			checkErrUser: false,
			checkErrPass: false,
			generalError :''
        }
	},
	methods: {
        async onSubmit() {
            this.error = {};
			if (!this.data.username.trim()){
				this.checkErrUser = true;
				this.error.username = "Username is required";
			} 
            if (!this.data.password.trim()){
				this.checkErrPass = true
				this.error.password = "Password is required";
			}
            if (Object.keys(this.error).length) return;
            try {
				this.isLogging = true;
                let uri = 'http://127.0.0.1:8000/api/auth/login';
				this.axios.post(uri, this.data).then((response) => {
					if(response.status === 200){
						this.$toast.open({
							message: response.data.msg,
							type: "success",
							duration: 2000,
							dismissible: true
						})
						this.isLogging = false;
						console.log(response.data);
						this.$store.commit('LOGIN_SUCCESS', response.data)
						this.$router.replace({path: '/home'});
					}else{
						this.$toast.open({
							message: response.data.msg,
							type: "error",
							duration: 2000,
							dismissible: true
						})
						this.isLogging = false;
					}
				})
			} catch (e) {
                this.generalError = e.response.data.error;
            }
		},
		clearErrorUser(){
			this.checkErrUser = false;
			this.error.username = "";		
		},
		clearErrorPass(){
			this.checkErrPass = false;
			this.error.password = "";		
		}
    }
}
</script>