<template>
  <div class="col ml-2">
    <div class="d-flex flex-column">
      <div v-for="(post, index) in featuredSidePost" :key='post.id' @click="redirectPost(post)" :class="{ 'mt-4': index != 0 }" class="row" :style="{ cursor: pointer }" @mouseover="pointer = 'pointer'">

        <img v-if="post.featured_post != null" class="ml-3 pl-2 side-image" :src="post.featured_image" />
        <img v-else class="ml-3 pl-2 side-image" src="https://picsum.photos/id/237/127/106" />

        <div class="col text-left side-text">

          <h4>
            <Strong>{{post.title}}</Strong>
          </h4>

          <p class="side-paragraph">{{post.user_meta.username}} in WellReads</p>
          <p class="date-post-side">{{ moment(post.published_at).format('D MMMM') }}</p>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="row row-cols-1 row-cols-md-2">
        <div v-for="post in availablePosts">
            <router-link :to="{ name: 'post', params: { identifier: publicIdentifier(post), slug: post.slug } }" class="text-decoration-none">
                <div class="col mb-4">
                    <div class="card-transparent post-card">
                        <img v-if="post.featured_image" :src="post.featured_image" class="card-img-top" :alt="post.featured_image_caption">
                        <div class="card-body">
                            <h5 class="card-title mt-0">{{ post.title }}</h5>
                            <p class="card-text text-secondary">{{ post.summary }}</p>
                        </div>
                        <div class="card-footer text-muted bg-transparent border-0 small d-flex justify-content-between">
                            <span>{{ moment(post.published_at).format('MMM D') }}</span>
                            <span>{{ post.read_time }}</span>
                        </div>
                        <div class="post-card-border mx-3"></div>
                    </div>
                </div>
            </router-link>
        </div>
  </div>-->
</template>

<script>
export default {
  name: "featured-post-side",

  props: {
    posts: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      sidePosts: this.posts,
      pointer: 'auto'
    };
  },
  computed: {
    featuredSidePost: function() {
    //   var randPosts = [];
    //   for (var i = 0; i < 3; i++) {
    //     randPosts.push(
    //       this.posts[Math.floor(Math.random() * this.posts.length)]
    //     );

    //   }
    //   console.log(this.posts)
      return this.posts.sort(() => Math.random() - 0.5).slice(0,3)
    }
  },
  methods: {
      redirectPost(post){
          this.$router.push({ name: 'post', params: { identifier: this.publicIdentifier(post), slug: post.slug }})
      }
  }
};
</script>
