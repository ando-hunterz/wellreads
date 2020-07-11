<template>
  <div class="mb-5">
    <vue-headful title="WellReads" description="Your Reading Subscribtion" />

    <navbar ref="navbar"></navbar>
    <topic-bar class="mx-3"></topic-bar>
    <div class="mt-2">
      <div class="col-10 offset-1">
        <featured-post-list :posts="posts.slice(0, featuredPostCount)"></featured-post-list>
        <div class="row mt-3">
          <a href class="ml-auto mr-3 editor-pick">More Editor's Pick</a>
        </div>
        <div class="hr-divider mt-3">
            <hr>
        </div>

        <div class="row">
          <div class="col-9 pr-5">
            <img src="https://picsum.photos/id/237/848/210" />
            <div class="col-9 popular-content">
              <h2 class="my-3 py-2">Popular on WellReads</h2>

                <popular-post-list :popPosts="popularPosts"></popular-post-list>

            </div>
          </div>
          <div class="col">
            <div class="popular-header mx-auto my-auto px-4 py-4">
              <h4 class="text-center popular-text">Popular</h4>
            </div>
            <div class="d-flex flex-column">
              <popular-post-side :popPosts="popularPosts"></popular-post-side>
            </div>
          </div>
        </div>
      </div>
    </div>

    <login-modal
        ref="profileModal"
        @logged="updateUser"
    />
    <register-modal
        ref="registerModal"
        @logged="updateUser"
    />
  </div>


</template>

<script>
import NProgress from "nprogress";
import $ from "jquery";
import vueHeadful from "vue-headful";
import Navbar from "../components/Navbar";
import PostList from "../components/PostList";
import FeaturedPostList from "../components/FeaturedPostList";
import PopularPostList from "../components/PopularPostList";
import PopularPostSide from "../components/PopularPostSide";
import LoginModal from "../components/modals/LoginModal"
import RegisterModal from "../components/modals/RegisterModal"
import TopicBar from "../components/TopicBar"

export default {
  name: "home-screen",

  components: {
    TopicBar,
    LoginModal,
    RegisterModal,
    PopularPostSide,
    PopularPostList,
    FeaturedPostList,
    Navbar,
    PostList,
    vueHeadful
  },

  data() {
    return {
      featuredPostCount: 4,
      posts: [],
      popularPosts: [],
      user: null,
      email: ""
    };
  },

  mounted() {
    this.fetchPosts();
    NProgress.done();
    if(Studio.user == null){
        $(this.$refs.profileModal.$el).modal('show')
    } else{
        this.user = Studio.user;
    }
  },

  methods: {
    fetchPosts() {
      this.request()
        .get(Studio.path + "/api/posts")
        .then(response => {
          this.posts = response.data.posts;
          this.request()
            .get(Studio.path + "/api/posts/popularPost")
            .then(responses => {
              console.log(responses.data.posts);
              this.popularPosts = responses.data.posts;
            })
            .catch(error => {
              console.log(error);
            });
        })
        .catch(error => {
          // Add any error debugging...
          this.$router.push({ name: "home" });

          NProgress.done();
        });
    },
    showRegisterModalFromForm(){
        $(this.$refs.registerModal.$el).modal('show')
        this.$refs.registerModal.getEmail()
    },
    showRegisterModal(data){
        $(this.$refs.registerModal.$el).modal('show')
    },
    closeRegisterModal(){
         $(this.$refs.registerModal.$el).modal('hide')
    },
    showLoginModal(){
        $(this.$refs.profileModal.$el).modal('show')
    },
    closeLoginModal(){
         $(this.$refs.profileModal.$el).modal('hide')
    },
    updateUser(value){
        console.log(value)
        Studio.user = value;
        this.user = value;
        this.$refs.navbar.updateUser(value)
    }
  }
};
</script>
