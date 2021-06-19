require('./bootstrap');

import Vue from 'vue';
import App from './vue/backend/app'
import Cat from './vue/backend/components/category/index'
import Brand from './vue/backend/components/brand/index'
import ProductColor from './vue/backend/components/product/product_color/index'
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI, { locale })


// backend ------------------------------------
const app = new Vue({
    el: '#app',
    components: {App,Cat,Brand,ProductColor}
});

// new Vue({
//     render: h => h(App)
// }).$mount("#app");

// const cat = new Vue({
//     el: '#app',
//     components: {Cat:Cat},
//     name: cat
// });