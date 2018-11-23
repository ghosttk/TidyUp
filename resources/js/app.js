
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

const i18n = new VueI18n({
  locale: 'zh-CN',  // 语言标识, 通过切换locale的值来实现语言切换,this.$i18n.locale 
  messages: {
   'zh-CN': require('./assets/lang/zh'),  // 中文语言包
   'en-US': require('./assets/lang/en')  // 英文语言包
  }
})


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('Hello', require('./components/Hello.vue'));

const app = new Vue({
    el: '#app',
    i18n
});
