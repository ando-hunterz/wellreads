<template>
    <div>
        <vue-headful
            title="Studio — Login"
            description="Sometimes creating a blog is easier said than done. With Canvas, it's just easier."
        />

        <navbar>
        </navbar>
        <div class="container mt-5 pt-5">
            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <h1 class="py-2">Login</h1>
                    <p v-if="loginError" class="text-danger">{{ loginMessage }}</p>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input
                            class="form-control"
                            type="text"
                            name="email"
                            v-model="input.email"
                            placeholder="Email"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            v-on:keyup.enter="login"
                            class="form-control"
                            type="password"
                            name="password"
                            v-model="input.password"
                            placeholder="Password"
                        />
                    </div>
                    <button type="button" class="btn btn-outline-primary" v-on:click="login()">Login</button>
                </div>
            </div>
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
            input: {
                email: "",
                password: ""
            },
            loginError: false,
            loginMessage: ""
        };
    },
    mounted() {
        NProgress.done();
    },
    methods: {
        login() {
            if (this.input.username != "" && this.input.password != "") {
                NProgress.start();
                this.request()
                    .post("/login", this.input, {
                        headers: { Accept: "application/json" }
                    })
                    .then(response => {
                        console.log(response);
                        Studio.user = response.data;
                        Studio.avatar = response.data.avatar;
                        console.log(Studio);
                        NProgress.done()
                        this.$router.push({ name: "home" });
                    })
                    .catch(error => {
                        this.loginError = true;
                        this.loginMessage = error.response.data.errors.email[0]
                    });
                console.log("hey");
            } else {
                console.log("A username and password must be present");
            }
        }
    }
};
</script>
