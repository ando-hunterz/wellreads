<template>
    <div>
        <vue-headful
            title="Register"
            description="Sometimes creating a blog is easier said than done. With Canvas, it's just easier."
        />

        <navbar>
        </navbar>
        <div class="container mt-5 pt-5">
            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <h1 class="py-2">Register</h1>
                    <p v-if="registerError && registerErrorMessage.global" class="text-danger">{{ registerErrorMessage.global }}</p>
                    <div class="form-group">
                        <label for="Username">Name</label>
                        <input
                            class="form-control"
                            type="text"
                            name="name"
                            v-model="input.name"
                            placeholder="Name"
                        />
                        <p v-if="registerError && registerErrorMessage.name" class="text-danger">{{ registerErrorMessage.name[0] }}</p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input
                            class="form-control"
                            type="text"
                            name="email"
                            v-model="input.email"
                            placeholder="Email"
                        />
                        <p v-if="registerError && registerErrorMessage.email" class="text-danger">{{ registerErrorMessage.email[0] }}</p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            class="form-control"
                            type="password"
                            name="password"
                            v-model="input.password"
                            placeholder="Password"
                        />
                        <p v-if="registerError &&  registerErrorMessage.password" class="text-danger">{{ registerErrorMessage.password[0] }}</p>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input
                            v-on:keyup.enter="register"
                            class="form-control"
                            type="password"
                            name="password_confirmation"
                            v-model="input.password_confirmation"
                            placeholder="Confirm Password"
                        />
                    </div>
                    <button type="button" class="btn btn-outline-primary" v-on:click="register()">Register</button>
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
    name: "register",

    components: {
        Navbar,
        vueHeadful
    },

    data() {
        return {
            input: {
                email: "",
                password: "",
                password_confirmation: "",
                name: ""
            },
            registerError: false,
            registerErrorMessage: ""
        };
    },
    mounted() {
        NProgress.done();
    },
    methods: {
        register() {
            if (this.input.username != "" && this.input.password != "" && this.input.password_confirmation != "") {
                NProgress.start()
                this.request()
                    .post("/register", this.input, {
                        headers: { Accept: "application/json" }
                    })
                    .then(response => {
                        console.log(response);
                        Studio.user = response.data;
                        Studio.avatar = response.data.avatar;
                        console.log(Studio);
                        this.$router.push({ name: "home" });
                        NProgress.done()
                    })
                    .catch(error => {
                        console.log(error)
                        this.registerError = true;
                        this.registerErrorMessage = error.response.data.errors
                        console.log(this.registerErrorMessage)
                        NProgress.done();
                    });
                console.log("hey");
            } else {
                this.registerError = true;
                this.registerErrorMessage = {global: 'All Field Must Be Filled'};
            }
        }
    }
};
</script>
