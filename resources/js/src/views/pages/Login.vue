<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuesax Admin - VueJS Dashboard Admin Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row no-gutter justify-center items-center">
                        <div class="vx-col hidden lg:block lg:w-1/2">
                            <img src="@assets/images/pages/login.png" alt="login" class="mx-auto">
                        </div>
                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
                            <div class="p-8">
                                <div class="vx-card__title mb-8">
                                    <h4 class="mb-4">{{ $i18n.tc('general.login.heading') }}</h4>
                                    <p>{{ $i18n.tc('general.login.description') }}</p>
                                </div>
                                <vs-input
                                    name="email"
                                    icon="icon icon-user"
                                    icon-pack="feather"
                                    :label-placeholder="$i18n.tc('general.login.email')"
                                    v-model="email"
                                    class="w-full no-icon-border"
                                    v-validate="'required|email'"
                                    @keyup.enter="login"
                                />
                                <span class="text-danger text-sm" v-show="errors.has('email')">
                                  {{ errors.first('email') }}
                                </span>

                                <vs-input
                                    type="password"
                                    name="password"
                                    icon="icon icon-lock"
                                    icon-pack="feather"
                                    :label-placeholder="$i18n.tc('general.login.password')"
                                    v-model="password"
                                    class="w-full mt-6 mb-3 no-icon-border"
                                    v-validate="'required'"
                                    @keyup.enter="login"
                                />
                                <span class="text-danger text-sm" v-show="errors.has('password')">
                                  {{ errors.first('password') }}
                                </span>

                                <div class="flex flex-wrap justify-between my-5">
                                    <vs-checkbox v-model="checkbox_remember_me" class="mb-3">
                                      {{ $i18n.tc('general.login.remember_me') }}
                                    </vs-checkbox>
                                </div>
                                <vs-button type="border" class="float-right mb-4" @keyup.enter="login" @click="login">
                                  {{ $i18n.tc('general.login.login') }}
                                </vs-button>
                            </div>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            email: '',
            password: '',
            checkbox_remember_me: false
        }
    },
    methods: {
        login () {
          this.$validator.validateAll().then(result => {
              if (result) {
                  this.$auth.login({
                    params: {
                      email: this.email,
                      password: this.password,
                    },
                    rememberMe: this.checkbox_remember_me,
                    success: function () {},
                    error: function () {
                      this.$vs.notify({
                        title: this.$i18n.tc('general.login.notification.title'),
                        text: this.$i18n.tc('general.login.notification.text'),
                        color:'danger',
                        iconPack: 'feather',
                        icon:'icon-x-circle',
                        position:'top-right'})
                    },
                  })
              }
          })
        }
    }
}
</script>

<style lang="scss">
#page-login {
    .social-login {
        .bg-facebook {
          background-color: #1551b1;
        }
        .bg-twitter {
          background-color: #00aaff;
        }
        .bg-google {
          background-color: #4285F4;
        }
        .bg-github {
          background-color: #333;
        }
    }
}
</style>
