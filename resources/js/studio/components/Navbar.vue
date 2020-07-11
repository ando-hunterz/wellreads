<template>
  <nav class="navbar mt-2" :class="{ 'py-2': !helpRoute, 'pt-2': helpRoute, 'pb-0':helpRoute}">
    <div class="d-flex justify-content-between col-lg-10 offset-lg-1 px-0 mb-2">
      <div class="align-items-center">
        <router-link :to="{name: 'upgrade'}" class="premium-btn">Premium</router-link>
      </div>

      <div class="align-item-center">
        <router-link :to="{name: 'home'}">
          <img width="75" height="35" class="logo" :src="'/assets//WRLogo.png'" alt />
        </router-link>
      </div>

      <div v-if="user != null" class="align-items-center">
        <button @click="toggleSearch" class="logo-btn mx-2">
          <img width="25" height="25" class="logo" :src="'/assets//SearchButton.png'" alt />
        </button>
        <img
          width="25"
          height="25"
          class="logo mx-2"
          :src="'/assets//NotificationButton.png'"
          alt
        />
        <router-link :to="{name:'posts-create'}" class="mx-2">
          <img width="25" height="25" class="logo" :src="'/assets//NewButton.png'" alt />
        </router-link>

        <div class="btn-group">
          <div class="dropdown">
            <a
              href="#"
              id="dropdownMenu"
              class="nav-link p-0 mx-2"
              role="button"
              data-toggle="dropdown"
            >
              <img :src="avatar" class="rounded-circle logo" style="width: 25px" :alt="user.name" />
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
              <div class="dropdown-header">
                <div class="row d-flex flex-row justify-content-center">
                  <img
                    :src="avatar"
                    class="rounded-circle logo my-2"
                    style="width: 45px; height: 45px"
                    :alt="user.name"
                  />
                  <div class="col-auto my-2">
                    <h6 style="margin-bottom: 0 !important; font-size: 20px">
                      <strong>{{ user.name }}</strong>
                    </h6>
                    <p class="profile-p">@{{ user.name }}</p>
                  </div>
                </div>
              </div>
              <div class="well-dropdown-divider"></div>
              <router-link
                :to="{name: 'user', params: { identifier: user.id}}"
                class="dropdown-item"
              >Profile</router-link>
              <router-link :to="{name:'stats'}" class="dropdown-item">Stats</router-link>
              <router-link :to="{name:'help'}" class="dropdown-item">Help</router-link>
              <router-link :to="{name:'settings-show'}" class="dropdown-item">Settings</router-link>
              <div class="dropdown-item">Paid Program</div>
              <div class="well-dropdown-divider"></div>
              <a
                class="dropdown-item signout-btn"
                style="cursor: pointer"
                @click.prevent="sessionLogout"
              >Log Out</a>
            </div>
          </div>
        </div>

      </div>
      <div class="align-item-center" v-else>
          <button type="button" @click="showLogin" class="premium-btn">Sign In</button>
          <button type="button" @click="showRegister" class="premium-btn">Sign Up</button>
      </div>
    </div>
    <div v-if="this.$route.name != 'help'" class="col-11 mx-auto px-0">
        <hr class="navbar-divider">
    </div>
  </nav>
</template>

<script>
import NavbarSearch from "./NavbarSearch";
import $ from 'jquery'

export default {
  name: "navbar",

  data() {
    return {
      searchTrue: false,
      user: Studio.user,
      avatar: Studio.avatar,
      canvasPath: Studio.canvasPath,
      topicsHeader: [],
      token: this.getToken(),
      trans: JSON.parse(Studio.translations),
      helpRoute: false,
    };
  },

  mounted() {
    this.fetchTopics();
    console.log(this.$route.name)
    if(this.$route.name == 'help') this.helpRoute = true;
    var parentss = this.$parent
    console.log(parent)
    $('#signup-btn').click(parentss, function(){
        console.log(parentss)
        console.log($('#registerModal').dropdown('toggle'))
        parentss.showRegisterModalFromForm()
    })
  },


  methods: {
    toggleSearch() {
      this.searchTrue = !this.searchTrue;
      console.log(this.searchTrue);
    },
    sessionLogout() {
      this.logout();
    },
    fetchTopics() {
      this.request()
        .get(Studio.path + "/api/topics/all")
        .then(response => {
          console.log(response);
          this.topicsHeader = response.data;
        })
        .catch(error => {
          // Add any error debugging...
        });
    },
    showLogin(){
        this.$parent.showLoginModal();
    },
    showRegister(){
        this.$parent.showRegisterModal();
    },
    updateUser(user){
        console.log(user)
        this.user = user;
        this.avatar = user.avatar;
    },

  }
};
</script>
