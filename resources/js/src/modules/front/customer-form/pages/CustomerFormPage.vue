<template>
  <div>
    <vs-row>
      <vs-col vs-offset="2" vs-type="flex" vs-justify="center" vs-align="center" vs-w="8">
          <customer-form></customer-form>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
import CustomerForm from '../components/CustomerForm'

export default {
    components: {
        CustomerForm
    }
}
</script>
