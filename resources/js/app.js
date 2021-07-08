require('./bootstrap');

import Vue from 'vue';
import App from './vue/backend/app'
import Cat from './vue/backend/components/category/index'
import Brand from './vue/backend/components/brand/index'
import ProductColor from './vue/backend/components/product/product_color/index'
import ProductSize from './vue/backend/components/product/product_size/index'
import Product from './vue/backend/components/product/index'
import Home from './vue/frontend/home'
import Login from './vue/frontend/components/account/login'
import Account from './vue/frontend/components/account/account'
import Forgot from './vue/frontend/components/account/forgot'
import Reset from './vue/frontend/components/account/reset'
import productDetail from './vue/frontend/components/product/detail'
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';


Vue.use(ElementUI, { locale })


// backend ------------------------------------
const app = new Vue({
    el: '#app',
    components: {App,Cat,Brand,ProductColor,ProductSize,Product,Home,Login,Forgot,Reset,Account,productDetail}
});

// new Vue({
//     render: h => h(App)
// }).$mount("#app");

// const cat = new Vue({
//     el: '#app',
//     components: {Cat:Cat},
//     name: cat
// });