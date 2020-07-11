import Vue from 'vue'
import Routes from './routes'
import {store} from './store'
import NProgress from 'nprogress'
import VueRouter from 'vue-router'
import moment from 'moment-timezone'
import HelperMixin from "./mixins/HelperMixin"
import RequestMixin from "./mixins/RequestMixin"
import VueFuse from 'vue-fuse'

require('bootstrap')

window.Popper = require('popper.js').default

Vue.prototype.moment = moment

// Set the default timezone
moment.tz.setDefault(Studio.timezone)

Vue.mixin(HelperMixin)
Vue.mixin(RequestMixin)

// Prevent the production tip on Vue startup
Vue.config.productionTip = false

Vue.use(VueRouter)
Vue.use(VueFuse)

const router = new VueRouter({
    routes: Routes,
    mode: 'history',
    // base: Studio.path,
})

NProgress.configure({
    showSpinner: false,
    easing: 'ease',
    speed: 300,
})

router.beforeEach((to, from, next) => {
    // console.log(to);
    // if(to.name != 'login' && to.name != 'register' && Studio.user == null) next({name: "login"})
    // else if(to.name == 'register' && Studio.user == null) next()
    // else{
    NProgress.start()
    next()
    // }
})


const app = new Vue({
    el: '#studio',
    router,
    store,

    data: {
        avatar: Studio.avatar
    },

    mounted() {
        this.$root.$on('updateAvatar', this.updateAvatar)
    },

    methods: {
        updateAvatar(url) {
            this.$root.avatar = url
        }
    }
})

// Give the store access to the root Vue instance
store.$app = app
