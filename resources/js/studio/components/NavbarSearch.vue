<template>
  <div>
    <input
      v-model="query"
      type="text"
      class="search-bar my-auto"
      placeholder="Search"
      @keyup="performSearch"
      @focus="showResult = true" @blur="showResult = false"
    />
    <!-- <div class="searchList">
   <h4 class="search-item-header">
       This Is item
   </h4>
   <hr/>
    </div>-->
    <div v-if="showResult && this.query != ''" class="searchList w-75" @mousedown.prevent="showResult = true">
      <div v-if="postsResult.length > 0">
        <h5 class="search-item-header">Posts</h5>
        <hr />
        <div class="d-flex flex-column">
          <div v-for="post in postsResult" :key="post.slug" class="my-2">
            <router-link
              :to="{ name: 'post', params: { identifier: publicIdentifier(post), slug: post.slug } }"
              class="text-decoration-none"
            >{{post.title}}</router-link>
            <p>{{post.summary}}</p>
          </div>
        </div>
      </div>
      <div v-if="tagsResult.length > 0">
        <!-- <h5  class="search-item-header mt-1">
          Tags
      </h5>
      <h5 v-else class="search-item-header">No Result Found</h5>
      <hr/>
        <router-link v-for="tag in tagssResult" :key="tag.slug" :to="{ name: 'post', params: { identifier: publicIdentifier(post), slug: post.slug } }" class="text-decoration-none">{{post.title}}</router-link>-->
      </div>
      <div>
        <h5 v-if="usersResult.length > 0" class="search-item-header mt-1">Users</h5>
        <hr />
        <router-link
          v-for="user in usersResult"
          :key="user.id"
          :to="{ name: 'user', params: { identifier: user.id } }"
          class="text-decoration-none"
        >
          <img
            :src="user.avatar"
            class="rounded-circle my-2 shadow-inner"
            style="width: 20px"
            :alt="user.name"
          />
          {{user.name}}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "navbar-search",

  components: {},

  data() {
    return {
      showResult: false,
      posts: [],
      postsResult: [],
      tags: [],
      tagsResult: [],
      users: [],
      usersResult: [],
      value: null,
      query: "",
      postOptions: {
        keys: ["title", "body"],
        threshold: 0.2
      },
      tagsOptions: {
        keys: ["name", "slug"],
        threshold: 0.2
      },
      usersOptions: {
        keys: ["name", "username"],
        threshold: 0.2
      }
    };
  },

  mounted() {
    this.fetchPost();
    this.fetchTags();
    this.fetchUser();
  },
  methods: {
    softReset() {
      this.showResult = !this.showResult;
      this.postsResult = [];
      this.usersResult = [];
    },
    fetchPost() {
      this.request()
        .get(Studio.path + "/api/posts")
        .then(response => {
          console.log(response);
          this.posts = response.data;
        })
        .catch(error => {
          // Add any error debugging...
        });
    },
    fetchTags() {
      this.request()
        .get(Studio.path + "/api/tags")
        .then(response => {
          console.log(response);
          this.users = response.data.tags;
        })
        .catch(error => {
          // Add any error debugging...
        });
    },
    fetchUser() {
      this.request()
        .get(Studio.path + "/api/users/all")
        .then(response => {
          console.log(response);
          this.users = response.data.users;
        })
        .catch(error => {
          // Add any error debugging...
        });
    },
    performSearch() {
      if(this.query == "") return null
      this.showResult = true;
      console.log(this.query);
      this.$search(this.query, this.posts.posts, this.postOptions).then(
        results => {
          console.log(this.posts.posts);
          console.log(results);
          if (results) {
            this.postsResult = results;
            if (this.postsResult.length > 3) {
              this.postsResult = this.searchResult.slice(0, 3);
            }
          } else {
            this.postsResult = [];
          }
        }
      );
      //  this.$search(this.query, this.tags, this.tagOptions).then(results => {
      //     if(results.length > 0) {
      //         this.tagsResult = results;
      //         if (this.tagsResult.length > 3 ){
      //             this.tagsResult = this.searchResult.slice(0,3);
      //         }
      //     }
      // })
      this.$search(this.query, this.users, this.usersOptions).then(results => {
        console.log(results);
        if (results) {
          this.usersResult = results;
          if (this.usersResult.length > 3) {
            this.usersResult = this.searchResult.slice(0, 3);
          }
        } else {
          this.usersResult = [];
        }
      });
    }
  }
};
</script>

<style  scoped>
</style>
