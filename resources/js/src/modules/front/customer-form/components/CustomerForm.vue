<template>
  <vx-card title="TMS Customer Support Service Form">
      <div class="vx-row mb-6">
          <div class="vx-col w-full">
              <vs-input
                      name="name"
                      class="w-full"
                      label-placeholder="Name *"
                      v-model="form.name"
                      v-validate="'required'" />
              <span class="text-danger text-sm" v-show="errors.has('name')">
                {{ errors.first('name') }}
              </span>
          </div>
      </div>
      <div class="vx-row mb-3">
          <div class="vx-col w-full">
              <vs-radio v-model="form.gender" vs-name="gender" vs-value="male">Male</vs-radio>
              <vs-radio v-model="form.gender" vs-name="gender" vs-value="female">Female</vs-radio>
          </div>
      </div>
      <div class="vx-row mb-6">
          <div class="vx-col w-full">
              <vs-input
                      name="phone_number"
                      class="w-full"
                      label-placeholder="Phone number *"
                      v-model="form.phone_number"
                      v-validate="'required'" />
              <span class="text-danger text-sm" v-show="errors.has('phone_number')">
              {{ errors.first('phone_number') }}
            </span>
          </div>
      </div>
      <div class="vx-row mb-6">
          <div class="vx-col w-full">
              <vs-input
                      name="email"
                      class="w-full"
                      label-placeholder="Email"
                      v-model="form.email"
                      v-validate="'email'" />
              <span class="text-danger text-sm" v-show="errors.has('email')">
              {{ errors.first('email') }}
            </span>
          </div>
      </div>
      <div class="vx-row mb-6">
          <div class="vx-col w-full">
              <vs-input class="w-full" label-placeholder="Order number" v-model="form.order_number" />
          </div>
      </div>
      <div class="vx-row mb-6">
          <div class="vx-col w-full description">
              <vs-textarea
                      name="description"
                      label="Description *"
                      v-model="form.description"
                      v-validate="'required'" />
              <span class="text-danger text-sm" v-show="errors.has('description')">
                {{ errors.first('description') }}
              </span>
          </div>
      </div>
      <div class="vx-row mb-6" v-if="isSupportOpen">
          <div class="vx-col w-full">
              <flat-pickr
                  class="w-full"
                  v-model="form.callback_date"
                  placeholder="Callback time *"
                  :config="datetimePickerConfig"
                  name="date"
                  v-validate="'required'" />
              <span class="text-danger text-sm" v-show="errors.has('date')">
              {{ errors.first('date') }}
            </span>
          </div>
      </div>
      <div class="vx-row mb-6">
          <div class="vx-col w-full">
              <vs-checkbox
                      name="terms"
                      v-model="form.terms"
                      v-validate="'required'"
                      data-vv-validate-on="click">By submitting this form you agree to the privacy policy of this website and the storing of the submitted inofrmation</vs-checkbox>
              <input style="display: none" name="terms" v-validate="'required'" type="checkbox">
              <span class="text-danger text-sm" v-show="errors.has('terms')">
                {{ errors.first('terms') }}
              </span>
          </div>
      </div>
      <div class="vx-row">
          <div class="vx-col w-full">
              <vs-button class="mr-3 mb-2" @click="send">Send</vs-button>
          </div>
      </div>
  </vx-card>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { START_TIME, SUNDAY } from "../config";
import { isOpen, getEndTime } from "../helpers";
import { issueService } from '../../../../services/front/issue.service'

export default {
    name: "CustomerForm",
    components: {
        flatPickr
    },
    computed: {
        isSupportOpen () {
           return isOpen(START_TIME, getEndTime())
        }
    },
    data() {
        return {
            form: {
                name: '',
                gender: 'male',
                phone_number: '',
                order_number: '',
                email: '',
                description: '',
                date: '',
                terms: false
            },
            datetimePickerConfig: {
                enableTime: true,
                dateFormat: "d.m.Y H:i",
                time_24hr: true,
                minDate: new Date(),
                minTime: START_TIME,
                maxTime: getEndTime(),
                defaultHour: '08',
                defaultMinute: '00',
                minuteIncrement: 30,
                disable: [
                    (date) => {
                        return (date.getDay() === SUNDAY);
                    }
                ],
                locale: {
                    "firstDayOfWeek": 1 // start week on Monday
                }
            },
        }
    },
    methods: {
        send () {
            this.$validator.validateAll().then(result => {
                if (result) {
                    issueService.store(this.form)
                        .then(() => {
                            this.resetForm()
                            this.$vs.notify({
                                title: this.$i18n.tc('general.login.notification.title'),
                                color:'success',
                                iconPack: 'feather',
                                icon:'icon-x-circle',
                                position:'top-right'})
                        })
                        .catch(() => {
                            this.$vs.notify({
                                title: this.$i18n.tc('general.error_msg'),
                                color:'danger',
                                iconPack: 'feather',
                                icon:'icon-x-circle',
                                position:'top-right'})
                        })
                        .finally(() => {
                            this.$validator.errors.clear()
                        })
                }
            })
        },
        resetForm () {
            this.form = {
                name: '',
                gender: 'male',
                phone_number: '',
                order_number: '',
                email: '',
                description: '',
                date: '',
                terms: false
            }
        }
    }
}
</script>

<style lang="scss" scoped>
 .text-danger {
     padding: 5px;
 }
 .description {
     div.vs-con-textarea {
       margin-bottom: 0;
     }
 }
</style>
