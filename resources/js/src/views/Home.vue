<template>
  <div>

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
