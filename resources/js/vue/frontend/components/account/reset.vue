<template>
    <div>
        <head-top/>
        <div class="breadcrumb-area bg--white-6 breadcrumb-bg-1 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Reset Password</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="https://demo.hasthemes.com/airi-preview/airi/index.html">Home</a></li>
                            <li class="current"><span>Reset Password</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="main-content-wrapper">
            <div class="page-content-inner">
                <div class="container">
                    <div class="row pt--75 pt-md--55 pt-sm--35 pb--80 pb-md--60 pb-sm--40 justify-content-center">
                        <div class="col-md-6 mb-sm--30">
                            <div class="login-box">
                                <h4 class="mb--35 mb-sm--20">Reset Password</h4>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="username_email">Password<span class="required">*</span></label>
                                    <input type="password" class="form__input form__input--3"
                                        name="username_email" v-model="password">
                                </div>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="username_email">Password Confirmation<span class="required">*</span></label>
                                    <input type="password" class="form__input form__input--3" id="username_email"
                                        name="username_email" v-model="password_confirmation">
                                </div>
                                <div class="d-flex align-items-center mb--20">
                                    <div class="form__group">
                                        <input type="submit" value="Submit" @click="resetPass()" class="btn btn-submit btn-style-1">
                                    </div>
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
    props:{
        token: '',
    },
    components:{
        footBot,
        headTop,
        modalPro,
        modalSearch,
        cartSide,
        sideMenu,
    },
    data: function(){
        return{
            password:'',
            password_confirmation:'',
            email: '',
            token:''
        }
    },
    methods:{
        parseURLParams() {
            var url = window.location.href;
            var queryStart = url.indexOf("?") + 1,
                queryEnd   = url.indexOf("#") + 1 || url.length + 1,
                query = url.slice(queryStart, queryEnd - 1),
                pairs = query.replace(/\+/g, " ").split("&"),
                parms = {}, i, n, v, nv;

            if (query === url || query === "") return;

            for (i = 0; i < pairs.length; i++) {
                nv = pairs[i].split("=", 2);
                n = decodeURIComponent(nv[0]);
                v = decodeURIComponent(nv[1]);

                if (!parms.hasOwnProperty(n)) parms[n] = [];
                parms[n].push(nv.length === 2 ? v : null);
            }
            queryStart = url.indexOf('reset/')+6;
            queryEnd = url.indexOf('?');
            var token = '';
            for(var i = queryStart;i<queryEnd;i++)
                token+=url[i];
            this.token = token;
            this.email = parms.email[0];
        },
        resetPass(){
            axios.post('http://localhost:8000/api/reset/'+this.token,{
                password: this.password,
                password_confirmation: this.password_confirmation,
                email: this.email,
                token: this.token
            })
            .then(response=>{
                if(response.status == 200){
                    // this.item.name = "";
                    // this.$emit('reloadlist');
                    this.addCateForm = false;
                    this.$notify({
                        title: 'Thành công',
                        message: 'Thay đổi mật khẩu thành công',
                        type: 'success'
                    });
                    window.location.replace("http://localhost:8000/account/login-register");
                }
            })
            .catch(error=>{
                this.$notify({
                    title: 'Không thành công',
                    message: 'Xảy ra lỗi',
                    type: 'danger'
                });
            })
        }
    },
    created(){
        this.parseURLParams();
    }
}
</script>