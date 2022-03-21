import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";

// axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000/api/";
// axios.defaults.headers.post['Content-Type'] ='application/json;charset=utf-8';
// axios.defaults.headers.post['Access-Control-Allow-Origin'] = 'http://localhost:3000';
// axios.defaults.headers.post['Origin'] ='localhost';
// axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*';

axios.interceptors.response.use(undefined, function(error) {
  if (error) {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true;
      store.dispatch("LogOut");
      return router.push("/login");
    }
  }
});

Vue.config.productionTip = false;

new Vue({
  store,
  router,
  async beforeCreate() {
    await this.$store.dispatch('LogInVerify')
    this.$mount('#app')
  },
  render: (h) => h(App),
});
