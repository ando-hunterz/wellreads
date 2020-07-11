<template>
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center justify-content-between border-0">
          <img class="user-logo mx-auto" src="/assets//WRLogo.png" alt />
        </div>
        <div class="well-dropdown-divider"></div>
        <div class="modal-body">
          <div class="d-flex flex-column">
            <div class="row my-2">
              <input
                type="text"
                class="user-input"
                v-model="input.email"
                name="email"
                id="email"
                placeholder="Email"
              />
            </div>
            <div class="row my-2">
              <input
                v-model="input.password"
                type="password"
                class="user-input"
                name="password"
                id="password"
                placeholder="Password"
              />
            </div>
            <div class="row">
              <button type="button" class="user-button mx-auto my-3" @click="login">Sign In</button>
            </div>
            <div class="row">
              <p class="user-paragraph mx-auto">
                Doesn't have an account?
                <span class="user-href" @click="showRegister">Sign Up</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NProgress from "nprogress";
export default {
  name: "login-modal",



  data() {
    return {
      input: {
        email: "",
        password: ""
      },
      loginError: false,
      loginMessage: ""
    };
  },
  methods: {
    login() {
      if (this.input.username != "" && this.input.password != "") {
        NProgress.start();
        this.request()
          .post("/login", this.input, {
            headers: { Accept: "application/json" }
          })
          .then(response => {
            console.log(response);
            Studio.user = response.data;
            Studio.avatar = response.data.avatar;
            console.log(Studio);
            this.$emit('logged', response.data);
            NProgress.done();
            this.$parent.closeLoginModal();
          })
          .catch(error => {
              console.log(error)
            // this.loginError = true;
            // this.loginMessage = error.response.data.errors.email[0];
          });
        console.log("hey");
      } else {
        console.log("A username and password must be present");
      }
    },
    showRegister(){
        this.$parent.showRegisterModal();
        this.$parent.closeLoginModal();
    }
  }
};
</script>

<style scoped lang="scss">
.filepond--wrapper {
  display: flex;
  justify-content: center;
}
</style>
