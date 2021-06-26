<template>
    <div>
        <head-top/>
        <div class="breadcrumb-area bg--white-6 breadcrumb-bg-1 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Login &amp; Register</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="https://demo.hasthemes.com/airi-preview/airi/index.html">Home</a></li>
                            <li class="current"><span>Login Register</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="main-content-wrapper">
            <div class="page-content-inner">
                <div class="container">
                    <div class="row pt--75 pt-md--55 pt-sm--35 pb--80 pb-md--60 pb-sm--40">
                        <div class="col-md-6 mb-sm--30">
                            <div class="login-box">
                                <h4 class="mb--35 mb-sm--20">Login</h4>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="username_email">Username<span class="required">*</span></label>
                                    <input type="text" class="form__input form__input--3" id="username_email"
                                        name="username_email" v-model="login.user_name">
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="password">Password <span
                                            class="required">*</span></label>
                                    <input type="password" class="form__input form__input--3"
                                        name="password" v-model="login.password">
                                </div>
                                <div class="d-flex align-items-center mb--20">
                                    <div class="form__group">
                                        <input type="submit" value="Log in" @click="loginForm()" class="btn btn-submit btn-style-1">
                                    </div>
                                    <div class="form__group">
                                        <label class="form__label checkbox-label" for="store_session">
                                            <input type="checkbox" name="store_session" id="store_session">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                </div>
                                <a class="forgot-pass" href="#">Lost your password?</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="register-box">
                                <h4 class="mb--35 mb-sm--20">Register</h4>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="email">Username<span
                                            class="required">*</span></label>
                                    <input type="text" class="form__input form__input--3" name="email" v-model="register.user_name">
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="email">Email<span
                                            class="required">*</span></label>
                                    <input type="email" class="form__input form__input--3" name="email" v-model="register.email">
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="password">Password <span
                                            class="required">*</span></label>
                                    <input type="password" class="form__input form__input--3"
                                        name="password" v-model="register.password">
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="password">Password Confirmation<span
                                            class="required">*</span></label>
                                    <input type="password" class="form__input form__input--3"
                                        name="password" v-model="register.password_confirmation">
                                </div>
                                <p class="privacy-text mb--20">Your personal data will be used to support your
                                    experience throughout this website, to manage access to your account, and for
                                    other purposes described in our privacy policy.</p>
                                <div class="form__group">
                                    <input type="submit" value="Register" @click="registerForm()" class="btn btn-submit btn-style-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <foot-bot/>
        <modal-pro/>
        <modal-search/>
        <cart-side/>
        <side-menu/>
    </div>
</template>

<script>

import footBot from '../footer.vue'
import headTop from '../headerPage.vue'
import modalPro from '../modal.vue'
import modalSearch from '../search.vue'
import cartSide from '../cart.vue'
import sideMenu from '../side.vue'
import { Notification } from 'element-ui';

export default {
    components:{
        footBot,
        headTop,
        modalPro,
        modalSearch,
        cartSide,
        sideMenu,
    },
    data: function(){
        return {
            login:{
                user_name:'',
                password:''
            },
            register:{
                user_name:'',
                password:'',
                password_confirmation:'',
                email:''
            },
            user:[],
            token:''
        }
    },
    methods:{
        loginForm(){
            axios.post('http://localhost:8000/api/login',{
                user_name: this.login.user_name,
                password: this.login.password
            })
            .then(response=>{
                if(response.status == 201){
                    this.$notify({
                        title: 'Thành công',
                        message: 'Đăng nhập thành công',
                        type: 'success'
                    });
                    localStorage.setItem("id", response.data.user.id);
                    localStorage.setItem("display_name", response.data.user.user_name);
                    localStorage.setItem("token", response.data.token);
                    window.location.replace("http://localhost:8000/");
                }
            })
            .catch(error=>{
                console.log(error.response.data.message);
                if(error.response.data.message == 'Tài khoản hoặc mật khẩu không đúng !'){
                    this.$notify({
                        title: 'Warning',
                        message: error.response.data.message,
                        type: 'warning',
                        duration: 100000000000,
                    });
                }else
                if(error.response.data.errors.user_name){
                    this.$notify({
                        title: 'Warning',
                        message: error.response.data.errors.user_name[0],
                        type: 'warning',
                        duration: 100000000000,
                    });
                }else if(error.response.data.errors.password){
                    this.$notify({
                        title: 'Warning',
                        message: error.response.data.errors.password[0],
                        type: 'warning',
                        duration: 100000000000
                    });
                }
            })
        },
        registerForm(){
            axios.post('http://localhost:8000/api/register',{
                email: this.register.email,
                user_name: this.register.user_name,
                password: this.register.password,
                password_confirmation: this.register.password_confirmation
            })
            .then(response=>{
                if(response.status == 201){
                    // this.item.name = "";
                    // this.$emit('reloadlist');
                    this.$notify({
                        title: 'Thành công',
                        message: 'Đăng ký thành công',
                        type: 'success'
                    });
                    console.log(response.data);
                    // this.user = response.data.user;
                    // this.token = response.data.token;
                    // console.log(this.user);
                    localStorage.clear();
                    localStorage.setItem("id", response.data.user.id);
                    localStorage.setItem("display_name", response.data.user.user_name);
                    localStorage.setItem("token", response.data.token);
                    window.history.back();
                }else{
                    alert(1);
                }
            })
            .catch(error=>{
                console.log(error.response);
                Notification.closeAll();
                if(error.response.data.errors.user_name){
                    this.$notify({
                        title: 'Warning',
                        message: error.response.data.errors.user_name[0],
                        type: 'warning',
                        duration: 100000000000,
                    });
                }else if(error.response.data.errors.email){
                    this.$notify({
                        title: 'Warning',
                        message: error.response.data.errors.email[0],
                        type: 'warning',
                        duration: 100000000000
                    });
                }else if(error.response.data.errors.password){
                    this.$notify({
                        title: 'Warning',
                        message: error.response.data.errors.password[0],
                        type: 'warning',
                        duration: 100000000000
                    });
                }
            })
        }
    },
    created(){
        if(localStorage.getItem('token')){
            window.location.replace("http://localhost:8000/");
        }
    }
}
</script>