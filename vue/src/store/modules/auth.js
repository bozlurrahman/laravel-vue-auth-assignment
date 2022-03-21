import axios from "axios";
import cookies from 'js-cookie';

const state = {
  user: null,
  posts: null,
  token: null,
};

const getters = {
  isAuthenticated: (state) => !!state.user,
  StatePosts: (state) => state.posts,
  StateUser: (state) => state.user,
  StateToken: (state) => state.token,
};

const actions = {
  async Register({dispatch}, user) {
    await axios.post('register', user)
    let UserForm = new FormData()
    UserForm.append('email', user.email)
    UserForm.append('password', user.password)
    await dispatch('LogIn', user)
  },

  async LogIn({dispatch, commit}, user) {
    
    const User = new FormData();
    User.append("email", user.email);
    User.append("password", user.password);

    var response = await axios.post("login", User);

    const loginSessionInSec = 60*60*2; // 2hours
    const expiryTime = new Date(new Date().getTime() + loginSessionInSec * 1000);
    cookies.set('x-access-token', response.data.token, {expires: expiryTime});
    await commit("setToken", response.data.token);
    await commit("setUser", user);

    dispatch('LogInVerify');

  },

  // async LogInVerify({dispatch,commit, state}) {
  async LogInVerify({dispatch,commit}) {
    
    var token = cookies.get('x-access-token');

    // console.log('token;;;;', token);

    if(typeof token != "undefined") {

      var response = await axios.get("verify",{
        headers: {'Authorization': 'Bearer '+token},
      });
      
      console.log('response;;;;', response);
      await commit("setUser", response.data.user);
    } else {
      dispatch('LogOut')
    }
    // await commit("setUser", user);
  },

  async LogOut({ commit }) {
    let user = null;
    commit("logout", user);
    commit("removeToken");
    cookies.remove('x-access-token');
  },
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },

  setToken(state, token) {
    state.token = token;
  },
  removeToken(state) {
    state.token = null;
  },

  setPosts(state, posts) {
    state.posts = posts;
  },
  logout(state, user) {
    state.user = user;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
