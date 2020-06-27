<template>
    <div>
        <vue-headful
            title="Under Construction"
            description="Sometimes creating a blog is easier said than done. With Canvas, it's just easier."
        />

        <navbar>
        </navbar>
        <div class="container mt-5 pt-5">
            <h1>Under Construction</h1>
        </div>
    </div>
</template>

<script>
import NProgress from "nprogress";
import vueHeadful from "vue-headful";
import Navbar from "../components/Navbar";

export default {
    name: "login",

    components: {
        Navbar,
        vueHeadful
    },

    data() {
        return {

        };
    },
    mounted() {
        NProgress.done();
    },
    methods: {

    }
};
</script>
