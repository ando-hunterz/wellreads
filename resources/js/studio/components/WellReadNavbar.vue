// <template>
//   <nav class="navbar py-2 mt-2">
//             <div class="d-flex justify-content-between col-lg-10 offset-lg-1 px-0 mb-2">
//                 <div class="btn-group align-items-center">
//                      <router-link :to="{name: 'upgrade'}" class="premium-btn">Premium</router-link>
//                 </div>


//                 <div class="align-item-center">
//                     <router-link :to="{name: 'home'}"><img width="75" height="35" class="logo" src="WRLogo.png" alt=""></router-link>
//                 </div>


//                 <div class="align-items-center">

//                     <button @click="toggleSearch" class="logo mx-2" >
//                         <img width="25" height="25" src="SearchButton.png" alt="">
//                     </button>
//                     <img width="25" height="25" class="logo mx-2" src="NotificationButton.png" alt="">
//                     <router-link  :to="{name:'posts-create'}" class="logo mx-2">
//                         <img width="25" height="25"  src="NewButton.png" alt="">
//                     </router-link>

//                     <div class="btn-group">


//                         <div class="dropdown">
//                             <a href="#" id="dropdownMenu" class="nav-link p-0 mx-2" role="button"
//                                 data-toggle="dropdown">
//                                 <img
//                                     :src="avatar"
//                                     class="rounded-circle logo"
//                                     style="width: 25px"
//                                     :alt="user.name"
//                                 />
//                             </a>
//                             <div class="dropdown-menu" aria-labelledby="dropdownMenu">
//                                 <div class="dropdown-header">
//                                     <div class="row">
//                                         <img
//                                             :src="avatar"
//                                             class="rounded-circle logo"
//                                             style="width: 25px"
//                                             :alt="user.name"
//                                         />
//                                         <div class="col-auto">
//                                             <h6 class="">
//                                                 <strong>{{ user.name }}</strong>
//                                             </h6>
//                                             <p class="profile-p">
//                                                 @{{ user.name }}
//                                             </p>
//                                         </div>
//                                     </div>

//                                 </div>




//                                 <div class="dropdown-divider"></div>
//                                 <router-link :to="{name: 'user', params: { identifier: user.id}}" class="dropdown-item">Profile</router-link>
//                                 <router-link :to="{name:'stats'}" class="dropdown-item">Stats</router-link>
//                                 <router-link :to="{name:'help'}" class="dropdown-item">Help</router-link>
//                                 <router-link :to="{name:'settings-show'}" class="dropdown-item">Settings</router-link>
//                                 <div class="dropdown-item">Paid Program</div>
//                                 <div class="dropdown-divider"></div>
//                                 <a
//                                     class="dropdown-item"
//                                     style="cursor: pointer"
//                                     @click.prevent="sessionLogout"
//                                 >Log Out</a>
//                             </div>
//                         </div>
//                     </div>

//                 </div>
//             </div>
//         </nav>
// </template>

// <script>
// import NavbarSearch from './NavbarSearch'


// export default {

//   name: "wellread-navbar",

//   data() {
//     return {
//       searchTrue: false,
//       user: Studio.user,
//       avatar: Studio.avatar,
//       canvasPath: Studio.canvasPath,
//       topicsHeader: [],
//       token: this.getToken(),
//       trans: JSON.parse(Studio.translations),
//     };
//   },

//   mounted() {
//     this.fetchTopics();
//   },

//   methods: {
//     toggleSearch(){
//         this.searchTrue = !this.searchTrue
//         console.log(this.searchTrue);
//     },
//     sessionLogout() {
//       this.logout();
//     },
//     fetchTopics() {
//       this.request()
//         .get(Studio.path + "/api/topics/all")
//         .then(response => {
//           console.log(response);
//           this.topicsHeader = response.data;
//         })
//         .catch(error => {
//           // Add any error debugging...
//         });
//     }
//   }
// };
// </script>

<template>
  <nav class="navbar py-2">
    <div
      class="d-flex justify-content-between col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12 px-0 mb-2"
    >
      <div class="btn-group align-items-center">
        <!-- <a
          href="https://twitter.com/@cnvs_io"
          class="pr-3 text-decoration-none"
          target="_blank"
          rel="noopener"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 20" class="primary">
            <path
              d="M21.173 3.162A5.038 5.038 0 0023.338.37a9.698 9.698 0 01-3.129 1.223A4.856 4.856 0 0016.616 0c-2.718 0-4.922 2.26-4.922 5.049 0 .396.042.78.126 1.15C7.728 5.988 4.1 3.979 1.67.922a5.14 5.14 0 00-.666 2.54c0 1.751.87 3.297 2.19 4.203a4.834 4.834 0 01-2.23-.63v.062c0 2.447 1.697 4.488 3.951 4.95a4.695 4.695 0 01-1.297.178c-.317 0-.627-.03-.927-.09.626 2.006 2.444 3.466 4.599 3.505A9.722 9.722 0 010 17.733 13.71 13.71 0 007.548 20c9.058 0 14.01-7.692 14.01-14.365 0-.22-.005-.439-.013-.654A10.1 10.1 0 0024 2.368a9.617 9.617 0 01-2.827.794z"
              fill-rule="evenodd"
            />
          </svg>
        </a>
        <a
          href="https://github.com/cnvs/canvas"
          class="text-decoration-none"
          target="_blank"
          rel="noopener"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 24" class="primary">
            <path
              d="M0 12.305c0 5.435 3.438 10.047 8.207 11.674.6.113.82-.267.82-.593 0-.292-.011-1.066-.017-2.093-3.339.744-4.043-1.65-4.043-1.65-.545-1.42-1.332-1.798-1.332-1.798-1.09-.764.083-.749.083-.749 1.203.087 1.837 1.268 1.837 1.268 1.071 1.88 2.809 1.338 3.493 1.022.109-.795.42-1.337.762-1.645-2.665-.31-5.466-1.365-5.466-6.08 0-1.343.467-2.442 1.235-3.302-.123-.311-.535-1.562.117-3.256 0 0 1.008-.33 3.3 1.261a11.241 11.241 0 013.005-.414c1.019.005 2.046.141 3.004.414 2.29-1.592 3.297-1.261 3.297-1.261.654 1.694.242 2.945.119 3.256.77.86 1.234 1.959 1.234 3.302 0 4.726-2.806 5.767-5.48 6.071.431.38.815 1.13.815 2.279 0 1.645-.015 2.971-.015 3.375 0 .329.216.712.825.591 4.765-1.63 8.2-6.239 8.2-11.672C24 5.508 18.627 0 12 0S0 5.508 0 12.305z"
              fill-rule="evenodd"
            />
          </svg>
        </a> -->
        <router-link :to="{name: 'home'}" class="text-muted"> Logo </router-link>
        <div class="my-auto ml-3">
          <slot name="status" />
        </div>
      </div>

      <div class="my-auto ml-auto d-flex align-items-end align-middle">
        <slot name="action" />
      </div>

      <slot name="menu" />

      <div class="align-items-center my-auto">
        <slot name="extra"></slot>

        <div v-if="user" class="btn-group">
          <div class="mr-1">
            <slot name="actions"></slot>
          </div>

          <!-- <router-link :to="{name:'tags'}" class="text-muted text-decoration-none">
                        Tags
                    </router-link>
                    <router-link :to="{name:'topics'}" class="text-muted text-decoration-none ml-3">
                        Topics
          </router-link>-->

          <button @click="toggleSearch" class="mx-1 my-auto nav-button" >
                        <svg width="22" height="23" viewBox="0 0 31 32" class="primary" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.5969 18.7633C25.3925 13.4035 24.1231 5.98181 18.7633 2.18708C13.4035 -1.60765 5.98182 -0.339114 2.18708 5.02157C-1.60765 10.3813 -0.339114 17.8022 5.02157 21.5969C8.84713 24.3053 13.905 24.5139 17.94 22.131L26.7073 30.8457C27.654 31.8422 29.229 31.8821 30.2255 30.9355C31.222 29.9897 31.2619 28.4147 30.3162 27.4182C30.2862 27.3865 30.2572 27.3575 30.2255 27.3275L21.5969 18.7633ZM11.8847 19.5758C7.64932 19.5767 4.21547 16.1455 4.21275 11.9101C4.21185 7.67471 7.64297 4.24086 11.8793 4.23905C16.1093 4.23723 19.5413 7.66292 19.5495 11.8929C19.5567 16.1292 16.1274 19.5685 11.8902 19.5758C11.8884 19.5758 11.8875 19.5758 11.8847 19.5758Z" fill-rule="evenodd"/>
                        </svg>
          </button>

          <transition name="fade">
          <navbar-search v-if="this.searchTrue"></navbar-search>
          </transition>

          <router-link  :to="{name:'posts-create'}" class="mx-1 my-auto">
            <svg
              width="22"
              height="22"
              viewBox="0 0 31 31"
              class="primary"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M28.2321 12.7321H18.8214C18.5157 12.7321 18.2679 12.4843 18.2679 12.1786V2.76786C18.2679 1.23932 17.0285 0 15.5 0C13.9715 0 12.7321 1.23932 12.7321 2.76786V12.1786C12.7321 12.4843 12.4843 12.7321 12.1786 12.7321H2.76786C1.23932 12.7321 0 13.9715 0 15.5C0 17.0285 1.23932 18.2679 2.76786 18.2679H12.1786C12.4843 18.2679 12.7321 18.5157 12.7321 18.8214V28.2321C12.7321 29.7607 13.9715 31 15.5 31C17.0285 31 18.2679 29.7607 18.2679 28.2321V18.8214C18.2679 18.5157 18.5157 18.2679 18.8214 18.2679H28.2321C29.7607 18.2679 31 17.0285 31 15.5C31 13.9715 29.7607 12.7321 28.2321 12.7321Z"
                fill-rule="evenodd"
              />
            </svg>
          </router-link>

          <div class="dropdown">
            <a
              href="#"
              id="dropdownMenu"
              class="nav-link p-0"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                :src="avatar"
                class="rounded-circle my-0 shadow-inner ml-1"
                style="width: 31px"
                :alt="user.name"
              />
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                <div class="dropdown-header">
                    <div class="col-2"></div>
                    <img
                        :src="avatar"
                        class="rounded-circle my-2 shadow-inner"
                        style="width: 31px"
                        :alt="user.name"
                    />
                     <h6>
                        {{ user.name }}
                        <br />
                        {{ user.email }}
                    </h6>
                </div>

              <div class="dropdown-divider"></div>
              <router-link :to="{name: 'upgrade'}"  class="dropdown-item"> Upgrade </router-link>
              <router-link :to="{name: 'user', params: { identifier: user.id}}"  class="dropdown-item"> Profile </router-link>
              <router-link :to="{name:'posts'}" class="dropdown-item">{{ trans.app.posts_simple }}</router-link>
              <router-link :to="{name:'help'}" class="dropdown-item">help</router-link>
              <router-link :to="{name:'stats'}" class="dropdown-item">{{ trans.app.stats }}</router-link>
              <div class="dropdown-divider"></div>
              <router-link
                :to="{name:'settings-show'}"
                class="dropdown-item"
              >{{ trans.app.settings }}</router-link>
              <a
                class="dropdown-item"
                style="cursor: pointer"
                @click.prevent="sessionLogout"
              >{{ trans.app.sign_out }}</a>
            </div>
          </div>
        </div>

        <div v-else class="btn-group">
            <a v-if="this.$route.name != 'login'" class="action-muted-btn text-decoration-none ml-3" href="/login">Sign in</a>
            <a v-else class="action-muted-btn text-decoration-none ml-3" href="/register">Register</a>
        </div>

      </div>
    </div>
    <div
      class="d-flex justify-content-start col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12 px-0 mt-1" id="topic-sel"
    >
      <div v-if="this.$route.name == 'home'" class="btn-group px-auto">
        <router-link class="topic-btn text-decoration-none px-3 mx-3" :to="{ name: 'popular-posts' }">Popular</router-link>
        <router-link
          v-for="topic in topicsHeader"
          :key="topic.name"
          :to="{ name: 'topic-posts', params: { slug: topic.slug }}"
          class="topic-btn text-decoration-none mx-3 px-3"
        >{{topic.name}}</router-link>
      </div>
    </div>
  </nav>
</template>

<script>
import NavbarSearch from './NavbarSearch'


export default {

   components: {
       NavbarSearch
   },


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
    };
  },

  mounted() {
    this.fetchTopics();
  },

  methods: {
    toggleSearch(){
        this.searchTrue = !this.searchTrue
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
    }
  }
};
</script>
