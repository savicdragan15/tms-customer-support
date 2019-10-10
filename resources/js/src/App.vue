<!-- =========================================================================================
	File Name: App.vue
	Description: Main vue file - APP
	----------------------------------------------------------------------------------------
	Item Name: Vuesax Admin - VueJS Dashboard Admin Template
	Author: Pixinvent
	Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
	<div id="app">
    <div v-if="$auth.ready()">
      <router-view></router-view>
    </div>
	</div>
</template>

<script>
import themeConfig from '@/../themeConfig.js'
import { userService } from "./services/auth/user.service";

export default {
    watch: {
        '$store.state.theme'(val) {
            this.toggleClassInBody(val);
        }
    },
    created: function () {
        this.$http.interceptors.response.use(
          response => response,
          error => {
            const {status} = error.response;
            if (status === 401) {
              userService.logout(localStorage.getItem('token'))
            }
            return Promise.reject(error);
          }
        );
    },
    methods: {
        toggleClassInBody(className) {
            if (className == 'dark') {
                if (document.body.className.match('theme-semi-dark')) document.body.classList.remove('theme-semi-dark');
                document.body.classList.add('theme-dark');
            } else if (className == 'semi-dark') {
                if (document.body.className.match('theme-dark')) document.body.classList.remove('theme-dark');
                document.body.classList.add('theme-semi-dark');
            } else {
                if (document.body.className.match('theme-dark')) document.body.classList.remove('theme-dark');
                if (document.body.className.match('theme-semi-dark')) document.body.classList.remove('theme-semi-dark');
            }
        }
    },
    mounted() {
        this.toggleClassInBody(themeConfig.theme)
    },
}
</script>
