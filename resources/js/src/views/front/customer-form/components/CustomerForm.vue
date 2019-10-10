<template>
    <vx-card
            title="Forma"
            :noShadow="true">
        <vx-input-group class="mb-6">
            <vs-input
                name="name"
                label-placeholder="Name *"
                v-model="form.name"
                v-validate="'required'" />
            <span class="text-danger text-sm" v-show="errors.has('name')">
              {{ errors.first('name') }}
            </span>
        </vx-input-group>

        <vx-input-group>
            <vs-radio v-model="form.gender" vs-name="radios1" vs-value="luis">Male</vs-radio>
            <vs-radio v-model="form.gender" vs-name="radios1" vs-value="luis">Female</vs-radio>
        </vx-input-group>

        <vx-input-group class="mb-6">
            <vs-input
                name="phone_number"
                label-placeholder="Phone number *"
                v-model="form.phone_number"
                v-validate="'required|integer'" />
            <span class="text-danger text-sm" v-show="errors.has('phone_number')">
              {{ errors.first('phone_number') }}
            </span>
        </vx-input-group>

        <vx-input-group class="mb-6">
            <vs-input label-placeholder="Order number" v-model="form.order_number" />
        </vx-input-group>

        <vx-input-group class="mb-6">
            <vs-input
                name="email"
                label-placeholder="Email"
                v-model="form.email"
                v-validate="'email'" />
            <span class="text-danger text-sm" v-show="errors.has('email')">
              {{ errors.first('email') }}
            </span>
        </vx-input-group>

        <vx-input-group class="mb-6">
            <vs-textarea
                name="description"
                label="Description *"
                v-model="form.description"
                v-validate="'required'" />
            <span class="text-danger text-sm" v-show="errors.has('description')">
              {{ errors.first('description') }}
            </span>
        </vx-input-group>

        <vx-input-group
            v-if="isSupportOpen"
            class="mb-6" >
            <flat-pickr v-model="form.date" :config="datetimePickerConfig"/>
        </vx-input-group>

        <vx-input-group class="mb-6">
            <vs-checkbox
                name="terms"
                v-model="form.terms"
                v-validate="'required'"
                data-vv-validate-on="click">Terms of use</vs-checkbox>
            <input style="display: none" name="terms" v-validate="'required'" type="checkbox">
            <span class="text-danger text-sm" v-show="errors.has('terms')">
              {{ errors.first('terms') }}
            </span>
        </vx-input-group>

        <vx-input-group>
            <vs-button type="border">
                {{ $i18n.tc('general.login.login') }}
            </vs-button>
        </vx-input-group>

    </vx-card>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { START_TIME } from "../config";
import { isOpen, getEndTime } from "../helpers";

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
                gender: '',
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
                        return (date.getDay() === 0);
                    }
                ],
                locale: {
                    "firstDayOfWeek": 1 // start week on Monday
                }
            },
        }
    },
}
</script>

<style scoped>

</style>
