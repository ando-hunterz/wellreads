<template>
  <div class="d-flex flex-column justify-content-end">
    <div v-for="(post, index) in popPosts" :key="post.id" :class=" {'mt-3 pt-3': index != 0}" class="row" :style="{ cursor: pointer }" @mouseover="pointer = 'pointer'" @click="redirectPost(post)" >
      <div class="col text-left " >
        <div class="large-popular">
          <h5 >
            <Strong>{{post.title}}</Strong>
          </h5>
        </div>

        <div class="popular-paragraph">
          <p v-if="post.summary != null" class="mb-4">
            {{post.summary}}
          </p>
          <p v-else class="mb-4">No Summary</p>
          <div class="bottom-paragraph">
            <p>{{post.user_meta.username}} in WellReads</p>
            <p>{{ moment(post.published_at).format('D MMMM') }}</p>
          </div>

        </div>
      </div>
      <div class="col-auto">
        <img v-if="post.featured_image != null" :src="post.featured_image" class="side-image">
        <img v-else class="side-image" src="https://picsum.photos/id/237/197/172" />
      </div>
    </div>
    <!-- <div class="row mt-3 pt-3">
      <div class="col text-left">
        <div class="large-popular">
          <h5>
            <Strong>Highlight of The Week in Football!!</Strong>
          </h5>
        </div>
        <div class="popular-paragraph">
          <p class="mb-4">
            Football is a worldwide championship with people all
            around the world participating in. Having such culture is the best of
            humanity.
          </p>
          <p>Raynard Rorong in WellReads</p>
          <p>20 July</p>
        </div>
      </div>
      <div class="col-auto">
        <img class="side-image" src="https://picsum.photos/id/237/197/172" />
      </div>
    </div>
    <div class="row mt-3 pt-3">
      <div class="col text-left">
        <div class="large-popular">
          <h5>
            <Strong>Highlight of The Week in Football!!</Strong>
          </h5>
        </div>
        <div class="popular-paragraph">
          <p class="mb-4">
            Football is a worldwide championship with people all
            around the world participating in. Having such culture is the best of
            humanity.
          </p>
          <p>Raynard Rorong in WellReads</p>
          <p>20 July</p>
        </div>
      </div>
      <div class="col-auto">
        <img class="side-image" src="https://picsum.photos/id/237/197/172" />
      </div>
    </div> -->
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
  name: "popular-post-list",

  props: {
    popPosts: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      pointer: 'auto'
    };
  },
  mounted() {
    this.popularPosts = this.popPosts;
  },
  methods: {
      redirectPost(post){
          this.$router.push({ name: 'post', params: { identifier: this.publicIdentifier(post), slug: post.slug }})
      }
  }
};
</script>
<style scoped>
.div-post:hover{
    cursor: pointer;
}
</style>
