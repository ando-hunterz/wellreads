import axios from 'axios'

export default {
    methods: {
        getToken() {
            return document.head.querySelector('meta[name="csrf-token"]').content
        },
        /**
         * Create a base Axios request and configure the defaults.
         *
         * @returns {AxiosInstance}
         */
        request() {
            let instance = axios.create()
            let token = document.head.querySelector('meta[name="csrf-token"]')

            instance.defaults.headers.common['X-CSRF-TOKEN'] = token.content
            instance.defaults.baseURL = '/'

            const requestHandler = request => {
                // Add any request modifiers...
                return request
            }

            const errorHandler = error => {
                //Add any error modifiers...


                return Promise.reject({...error})
            }

            const successHandler = response => {
                // Add any response modifiers...
                return response
            }

            instance.interceptors.request.use(request =>
                requestHandler(request)
            )

            instance.interceptors.response.use(
                response => successHandler(response),
                error => errorHandler(error)
            )

            return instance
        },

        logout() {
            let instance = axios.create()
            let token = document.head.querySelector('meta[name="csrf-token"]')

            instance.defaults.headers.common['X-CSRF-TOKEN'] = token.content
            instance.defaults.baseURL = '/'

            axios
                .post('/logout', {
                    _token: token,
                })
                .then(response => {
                    window.location.href = '/'
                })
        }
    },
}
