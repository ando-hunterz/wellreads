<template>
  <div>
    <vue-headful title="WellReads - Help" description="Your Reading Subscribtion" />

    <navbar ref="navbar"></navbar>

    <div>
      <div class="col-11 mx-auto bg-black">
        <div class="help-content">
          <hr class="navbar-divider" />
          <div class="d-flex flex-column px-5 mx-2 mt-5 pt-3">
            <div class="row">
              <h1>Help</h1>
            </div>
            <div class="row">
              <p>Customer Service</p>
            </div>
            <div class="row">
              <p>We Gladly here to respond if you have questions</p>
            </div>
            <div class="row mt-4">
              <div class="d-flex flex-row">
                <input type="text" name id class="search-input" placeholder="Search..." />
                <img
                  width="25"
                  height="25"
                  class="logo"
                  :src="'/assets//SearchButton.png'"
                  alt
                />
              </div>
            </div>
            <div class="row input-border"></div>
            <div class="row d-flex flex-row justify-content-between">
              <div class="col-3 d-flex flex-column justify-content-between help-inner-content">
                <div class="row mb-4">
                  <h2>My Account</h2>
                </div>
                <div class="row">
                  <p>Profile</p>
                </div>
                <div class="row">
                  <p>Change Your Password</p>
                </div>
                <div class="row">
                  <p>Change Your Username</p>
                </div>
              </div>
              <div class="col-3 d-flex flex-column justify-content-between help-inner-content">
                <div class="row mb-4">
                  <h2>Writing</h2>
                </div>
                <div class="row">
                  <p>Start Writing</p>
                </div>
                <div class="row">
                  <p>Insert Images</p>
                </div>
                <div class="row">
                  <p>Edit a Post</p>
                </div>
              </div>
              <div class="col-3 d-flex flex-column justify-content-between help-inner-content">
                <div class="row mb-4">
                  <h2>Report</h2>
                </div>
                <div class="row">
                  <p>Account</p>
                </div>
                <div class="row">
                  <p>Negative Content</p>
                </div>
                <div class="row">
                  <p>Copyright</p>
                </div>
              </div>
              <div class="col d-flex flex-column justify-content-between help-inner-content">
                <div class="row mb-4">
                  <h2>Terms and Policies</h2>
                </div>
                <div class="row">
                  <p>Terms of Services</p>
                </div>
                <div class="row">
                  <p>Privacy Policies</p>
                </div>
                <div class="row">
                  <p>Writer Program Term</p>
                </div>
              </div>
            </div>
            <div class="row mt-4">
                <router-link :to="{ name: 'upgrade'}" class="help-href">Upgrade To Premium</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NProgress from "nprogress";
import $ from "jquery";
import vueHeadful from "vue-headful";


export default {
  name: "help-screen",

  components: {
    vueHeadful
  },

  data() {
    return {
    };
  },

  mounted() {
    NProgress.done();
  },

};
</script>
