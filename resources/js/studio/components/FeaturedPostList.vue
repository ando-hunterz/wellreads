<template>
  <div class="row">
    <div v-for="post in featuredPost" :key="post.id" class="col-4 mx-2">
      <router-link
        :to="{ name: 'post', params: { identifier: publicIdentifier(post), slug: post.slug } }"
        class="text-decoration-none"
      >
        <img v-if="post.featured_image != null" :src="post.featured_image" class="highlight-image" />
        <img v-else src="https://picsum.photos/id/237/413/224" class="highlight-image" />
        <div class="highlight-content">
          <h5 class="mt-3">
            <Strong>{{post.title}}</Strong>
          </h5>
          <div class="bottom-paragraph">
            <p>{{post.user_meta.username}} in WellReads</p>
            <p class="date-post">{{ moment(post.published_at).format('D MMMM') }}</p>
          </div>
        </div>
      </router-link>
    </div>
    <featured-post-side :posts="this.posts"></featured-post-side>
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
import FeaturedPostSide from './FeaturedPostSide'
export default {
  name: "featured-post-list",

  components: {
      FeaturedPostSide
  },

  props: {
    posts: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      availablePosts: this.posts
    };
  },
  computed: {
    featuredPost: function() {
    //   var randPosts = [];
    //   for (var i = 0; i < 2; i++) {
    //     randPosts.push(
    //       this.posts[Math.floor(Math.random() * this.posts.length)]
    //     );
    //   }

      return this.posts.sort(() => Math.random() - 0.5).slice(0,2)
    }
  },
  mounted() {
    console.log(this.featuredPost);
  }
};
</script>
