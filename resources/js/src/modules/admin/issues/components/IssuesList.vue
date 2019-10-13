<template>
  <div class="vx-row">
    <vx-card>
      <div class="vx-col w-full mb-base">
        <vs-table :sst="true" @sort='handleSort' :data="issues ? issues.data : []">
          <template slot="header">
            <h3>
              Issues
            </h3>
          </template>
          <template slot="thead">
            <vs-th>
              Name
            </vs-th>

            <vs-th >
              Email
            </vs-th>

            <vs-th>
              Gender
            </vs-th>

            <vs-th>
              Order number
            </vs-th>

            <vs-th sort-key="callback_date">
              Callback date
            </vs-th>

            <vs-th>
              Comments
            </vs-th>

            <vs-th>
              Actions
            </vs-th>
          </template>

          <template slot-scope="{data}">
            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
              <vs-td :data="data[indextr].name">
                {{data[indextr].name}}
              </vs-td>

              <vs-td :data="data[indextr].email">
                {{data[indextr].email || '-'}}
              </vs-td>

              <vs-td :data="data[indextr].gender">
                {{data[indextr].gender}}
              </vs-td>

              <vs-td :data="data[indextr].order_number">
                {{data[indextr].order_number}}
              </vs-td>

              <vs-td :data="data[indextr].callback_date">
                {{data[indextr].callback_date || '-'}}
              </vs-td>

              <vs-td :data="data[indextr].comments">
                <vs-button  @click="viewComments(data[indextr])" size="small" icon="comment" :disabled="!data[indextr].comments.length"></vs-button>
              </vs-td>

              <vs-td :data="data[indextr].id">
                <vs-button @click='deleteIssue(data[indextr].id)' size="small" icon="delete"></vs-button>
              </vs-td>
            </vs-tr>
          </template>
        </vs-table>
      </div>

      <div>
        <vs-pagination @change="handleChangePage($event)" :total="total" :value="currentPage" ></vs-pagination>
      </div>

      <vs-popup classContent="popup-example" title="Lorem ipsum dolor sit amet" :active.sync="commentsPopupActive">
        <div v-if="selectedIssue">
          <div v-for="comment in selectedIssue.comments">
            <p>{{ comment.text }}</p>
          </div>
        </div>
      </vs-popup>
    </vx-card>
  </div>
</template>

<script>
import { issueService } from '../../../../services/admin/issue.service'

export default {
  name: "IssuesList",
  computed: {
    currentPage () {
        return this.issues ? this.issues.current_page : 1
    },
    total () {
        return this.issues ? this.issues.last_page : 1
    }
  },
  data () {
      return {
          issues: null,
          commentsPopupActive: false,
          selectedIssue: null
      }
  },
  methods:{
      getIssues (page = 1) {
          return issueService.index(page)
              .then(res => {
                  this.issues =  res.data
              })
              .catch(() => {
                  this.$vs.notify({
                      title: this.$i18n.tc('general.error_msg'),
                      color:'danger',
                      iconPack: 'feather',
                      icon:'icon-x-circle',
                      position:'top-right'})
              })
      },
      deleteIssue (id) {
          return issueService.destroy(id)
              .then(() => {
                  this.getIssues(this.currentPage)
              })
              .catch(() => {
                  this.$vs.notify({
                      title: this.$i18n.tc('general.error_msg'),
                      color:'danger',
                      iconPack: 'feather',
                      icon:'icon-x-circle',
                      position:'top-right'})
              })
      },
      handleChangePage (page) {
          this.getIssues(page);
      },
      handleSort(key, active) {
          console.log(`the user ordered: ${key} ${active}`)
      },
      viewComments (issue) {
          this.selectedIssue = issue
          this.commentsPopupActive = true
      }
  }
}
</script>

<style scoped>

</style>
