<template>
    <div>
        <head-top/>
        <div class="breadcrumb-area bg--white-6 breadcrumb-bg-1 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Forgot Password</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="https://demo.hasthemes.com/airi-preview/airi/index.html">Home</a></li>
                            <li class="current"><span>Forgot Password</span></li>
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
                                <h4 class="mb--35 mb-sm--20">Forgot Password</h4>
                                <div class="form__group mb--20">
                                    <label class="form__label form__label--2" for="username_email">Email<span class="required">*</span></label>
                                    <input type="text" class="form__input form__input--3" id="username_email" name="username_email" v-model="email">
                                </div>
                                <div class="d-flex align-items-center mb--20">
                                    <div class="form__group">
                                        <input type="submit" value="Submit" @click="forgot()" class="btn btn-submit btn-style-1">
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
            email:'',
        }
    },
    methods:{
        forgot(){
            axios.post('http://localhost:8000/api/forgot',{
                email: this.email
            })
            .then(response=>{
                Notification.closeAll();
                this.$notify({
                    title: 'Thành công',
                    message: 'Mail phục hồi mật khẩu đã được gửi !',
                    type: 'success'
                });
            })
            .catch(error=>{
                Notification.closeAll();
                this.$notify({
                    title: 'Không thành công',
                    message: error.response.data.errors.email[0],
                    type: 'warning',
                    duration: 100000000000
                });
            })
        }
    }
}
</script>