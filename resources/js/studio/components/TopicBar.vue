<template>
  <div class="col-10 offset-1 d-flex justify-content-center mx-auto mb-4">
    <router-link :to="{name: 'home'}" class="topic-bar-btn mr-2">HOME</router-link>
    <router-link :to="{name: 'popular'}" class="topic-bar-btn mx-2">POPULAR</router-link>
    <button class="topic-bar-btn ml-2" data-toggle="dropdown">CATEGORIES</button>
    <div class="dropdown">
      <div class="dropdown-menu" aria-labelledby="dropdownMenu" id="topic-dropdown">
        <!-- <div v-for="topic in topics" :key="topic.slug" class="dropdown-item"><router-link </div> -->
        <router-link
          v-for="topic in topics"
          :key="topic.slug"
          :to="{ name: 'topic-posts', params: { slug: topic.slug }}"
          class="dropdown-item topic-link"
        >{{topic.name}}</router-link>
        <div class="well-dropdown-divider"></div>
        <p class="dropdown-item">Others</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "topic-bar",

  data() {
    return {
      topics: [],
      topicsHeader: []
    };
  },

  mounted() {
    this.fetchTopics();
  },

  methods: {
    fetchTopics() {
      this.request()
        .get(Studio.path + "/api/topics/all")
        .then(response => {
          console.log(response);
          this.topicsHeader = response.data;
          this.topics = this.topicsHeader.sort(() => Math.random() - 0.5);
          this.topics = this.topics.slice(0, 4);
        })
        .catch(error => {
          // Add any error debugging...
        });
    }
  }
};
</script>
