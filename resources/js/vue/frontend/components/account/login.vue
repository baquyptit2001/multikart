<template>
    <span>
        <head-top/>
        <div id="content" class="main-content-wrapper">
            <div class="page-content-inner">
                <div class="container">
                    <div class="row pt--75 pt-md--55 pt-sm--35 pb--80 pb-md--60 pb-sm--40">
                        <div class="col-md-6 mb-sm--30">
                            <div class="login-box">
                                <h4 class="mb--35 mb-sm--20">Login</h4>
                                <form class="form form--login">
                                    <div class="form__group mb--20">
                                        <label class="form__label form__label--2" for="username_email">Username or email
                                            address <span class="required">*</span></label>
                                        <input type="text" class="form__input form__input--3" id="username_email"
                                            name="username_email">
                                    </div>
                                    <div class="form__group mb--20">
                                        <label class="form__label form__label--2" for="password">Password <span
                                                class="required">*</span></label>
                                        <input type="password" class="form__input form__input--3" id="password"
                                            name="password">
                                    </div>
                                    <div class="d-flex align-items-center mb--20">
                                        <div class="form__group">
                                            <input type="submit" value="Log in" class="btn btn-submit btn-style-1">
                                        </div>
                                        <div class="form__group">
                                            <label class="form__label checkbox-label" for="store_session">
                                                <input type="checkbox" name="store_session" id="store_session">
                                                <span>Remember me</span>
                                            </label>
                                        </div>
                                    </div>
                                    <a class="forgot-pass" href="#">Lost your password?</a>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="register-box">
                                <h4 class="mb--35 mb-sm--20">Register</h4>
                                <form class="form form--login">
                                    <div class="form__group mb--20">
                                        <label class="form__label form__label--2" for="email">Email address <span
                                                class="required">*</span></label>
                                        <input type="email" class="form__input form__input--3" id="email" name="email">
                                    </div>
                                    <div class="form__group mb--20">
                                        <label class="form__label form__label--2" for="password">Password <span
                                                class="required">*</span></label>
                                        <input type="password" class="form__input form__input--3" id="password"
                                            name="password">
                                    </div>
                                    <p class="privacy-text mb--20">Your personal data will be used to support your
                                        experience throughout this website, to manage access to your account, and for
                                        other purposes described in our privacy policy.</p>
                                    <div class="form__group">
                                        <input type="submit" value="Register" class="btn btn-submit btn-style-1">
                                    </div>
                                </form>
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
    </span>
</template>

<script>

import footBot from '../footer.vue'
import headTop from '../header.vue'
import modalPro from '../modal.vue'
import modalSearch from '../search.vue'
import cartSide from '../cart.vue'
import sideMenu from '../side.vue'

export default {
    components:{
        footBot,
        headTop,
        modalPro,
        modalSearch,
        cartSide,
        sideMenu,
    },
}
</script>