<template>
	
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form @submit="formSubmit">
                        

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" v-model="email" required autocomplete="email" autofocus>


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" v-model="password" required autocomplete="current-password">


                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                            	    <button class="btn btn-success">Submit</button>

                                <!-- <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button> -->

                                <!-- @if (Route::has('password.request')) -->
                                    <!-- <a class="btn btn-link" href="#">
                                        {{ __('Forgot Your Password?') }}
                                    </a> -->
                                <!-- @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
// import axios from "axios";
    export default {
        mounted() {
            // console.log('Login Component mounted.')
            axios.post("http://127.0.0.1:8000/api/getAllImages?id=1").then(response => console.log(response))
        },
        data() {
            return {
              email: '',
              password: '',
            };
        },
		methods :{
			formSubmit(e){
				e.preventDefault();
				let currentObj = this;

				this.axios.post('http://127.0.0.1:8000/api/login',{
					email:$("#email").val(),
					password:$("#password").val()

				}).then(function(response){
					currentObj.output = response
					console.log(currentObj.output = response)
				})	
			}

		}
    }
</script>