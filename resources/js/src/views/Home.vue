<template>
  <div>
    <div class="vx-row">
      <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
        <vx-card>
          <vs-button class="mb-10" color="primary" type="filled" @click="getUser">Get User</vs-button>
          <p>{{ $auth.user().permissions }}</p>
        </vx-card>
      </div>
    </div>
  </div>
</template>

<script>
import { userService } from './../services/auth/user.service'

export default {
    data() {
        return {
          user: {},
          switch1: false
        }
    },
    methods: {
        getUser () {
          this.user = {}
            userService.getCurrentUserFromServer()
              .then(res => {
                this.user = res.data.data
              })
        },
      logout () {
          this.$auth.logout()
      }
    }
}
</script>
