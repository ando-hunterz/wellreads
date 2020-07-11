<template>
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center justify-content-between border-0">
          <img class="user-logo mx-auto" src="/assets/icons/WRLogo.png" alt />
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
                id="registeremail"
                placeholder="Email"
              />
            </div>
            <div class="row my-2">
              <input
                v-model="input.password"
                type="password"
                class="user-input"
                name="password"
                id="registerpassword"
                placeholder="Password"
              />
            </div>
            <div class="row my-2">
              <input
                v-model="input.password_confirmation"
                type="password"
                class="user-input"
                name="confirmPassword"
                id="confirmpassword"
                placeholder="Confirm Password"
              />
            </div>
            <div class="row">
              <button type="button" class="user-button mx-auto my-3" @click="register">Sign Up</button>
            </div>
            <div class="row">
              <p class="user-paragraph mx-auto">
                Already have an account?
                <span class="user-href" @click="showLogin">Sign In</span>
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
import $ from 'jquery';
export default {
  name: "register-modal",

  data() {
    return {
      input: {
        email: "",
        password: "",
        password_confirmation: "",
        name: 'WellReadUser'
      },
      loginError: false,
      loginMessage: ""
    };
  },
  methods: {
    register() {
      if (
        (this.input.username != "" && this.input.password != "" && this.input.password_confirmation != "") ||
        (this.input.password != this.input.password_confirmation)
      ) {
        NProgress.start();
        this.request()
          .post("/register", this.input, {
            headers: { Accept: "application/json" }
          })
          .then(response => {
            console.log(response);
            Studio.user = response.data;
            Studio.avatar = response.data.avatar;
            console.log(Studio);
            this.$emit("logged", response.data);
            NProgress.done();
            this.$parent.closeRegisterModal();
          })
          .catch(error => {
            console.log(error);
            this.registerError = true;
            this.registerErrorMessage = error.response.data.errors;
            console.log(this.registerErrorMessage);
            NProgress.done();
          });
        console.log("Registered");
      }
    },
    showLogin(){
        this.$parent.showLoginModal()
        this.$parent.closeRegisterModal();
    },
    getEmail(){
       this.input.email = $('#email-signup').val()
       console.log(this.input.email)
    }
  }
};
</script>

<style scoped lang="scss">
</style>
