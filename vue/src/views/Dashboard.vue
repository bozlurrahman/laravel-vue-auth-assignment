<template>
  <div class="dashboard">
    <p>Dashboard sectet contents goes here. Your Date of birth: {{$store.state.auth.user.dob | dateFormat}}</p>
  </div>
</template>

<script>
import { mapActions } from "vuex";

import moment from "moment";

export default {
  name: "Dashboard",
  data() {
    return {
      // dob: null,
    };
  },
  beforeCreate() {
    // this.LogInVerify();
    // i have called the LoginVerify function in vue/src/main.js for much better performance.
  },
  methods: {
    ...mapActions(["LogInVerify"]),
  },
  components: {},
  
  mounted() {
    
  },
  filters: {
    uppercase: function(value) {
      return value.toUpperCase();
    },

    dateFormat: function (value) {

      if (!value) {
        return ''
      } else {
        return moment(value).utc().format('MMM DD, YYYY')
        // return moment(value,'YYYY-MM-DD HH:mm:ss').format('MMM DD, YYYY')
      }
    },
  }
};
</script>
