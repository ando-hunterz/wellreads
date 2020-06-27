<template>
    <div>
        <vue-headful
            title="Search"
            description="Sometimes creating a blog is easier said than done. With Canvas, it's just easier."
        />

        <navbar>
        </navbar>

        <div class="mt-5">
            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 mt-3">
                <input type="searchQuery" class="search-form" placeholder="Search Here" v-on:keyup='performSearch' v-model="query">
            </div>

            <div v-if="this.searchResult.length > 0" class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 mt-3">
                <div v-for="post in searchResult" :key="post.title">
                    <router-link :to="{ name: 'post', params: { identifier: publicIdentifier(post), slug: post.slug } }" class="text-decoration-none">
                        <div class="card-transparent mb-4 shadow-sm">
                            <div class="row no-gutters">
                                <div :class="post.featured_image ? 'col-9' : ''">
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">{{ post.title }}</h4>
                                        <p class="card-text text-secondary">{{ post.summary }}</p>
                                        <p class="card-text"><small class="text-muted">{{ moment(post.published_at).format('MMM D') }} — {{ post.read_time }}</small></p>
                                    </div>
                                </div>
                                <div v-if="post.featured_image" class="col-3">
                                    <img :src="post.featured_image" class="card-img" :alt="post.featured_image_caption">
                                </div>
                            </div>
                             <div class="post-card-border mx-3"></div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import NProgress from 'nprogress'
    import vueHeadful from 'vue-headful'
    import Navbar from "../components/Navbar";

    export default {
        name: 'search',

        components: {
            Navbar,
            vueHeadful
        },

        data() {
            return {
                featuredPostCount: 4,
                posts: [],
                query: "",
                options: {
                    isCaseSensitive: false,
                    keys: ['title','body'],
                    threshold: 0.2
                },
                searchResult: []

            }
        },

        mounted() {
            this.fetchPosts()
        },

        methods: {
            fetchPosts() {
                this.request()
                    .get(Studio.path + '/api/posts')
                    .then(response => {
                        this.posts = response.data.posts

                        NProgress.done()
                    })
                    .catch(error => {
                        // Add any error debugging...
                        this.$router.push({name: 'home'})

                        NProgress.done()
                    })
            },
            performSearch(){
                console.log(this.query)
                this.$search(this.query, this.posts, this.options).then(results => {
                    if(results.length > 0) this.searchResult = results;
                    // console.log(this.searchResult)
                })
            }
        }
    }
</script>
