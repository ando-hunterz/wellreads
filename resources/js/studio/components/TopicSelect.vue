<template>
    <multiselect
        v-model="value"
        :placeholder="trans.app.select_a_topic"
        :options="options"
        :multiple="false"
        @input="onChange"
        label="name"
        track-by="slug"
        style="cursor: pointer"
        :tag-placeholder="trans.app.add_a_new_topic"
        :taggable="true"
        @tag="addTopic"
    />
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        props: {
            topics: {
                type: Array,
                required: false,
            },
            assigned: {
                type: Object | Array,
                required: false,
            },
        },

        components: {
            Multiselect,
        },

        data() {
            const allTopics = this.topics.map(obj => {
                let filtered = {}

                filtered['name'] = obj.name
                filtered['slug'] = obj.slug

                return filtered
            })

            return {
                options: allTopics,
                value: this.assigned ? this.assigned : [],
                trans: JSON.parse(Studio.translations),
            }
        },

        methods: {
            onChange(value, id) {
                this.$store.dispatch('setPostTopic', value)

                this.update()
            },

            addTopic(searchQuery) {
                const topic = {
                    name: searchQuery,
                    slug: this.slugify(searchQuery),
                }

                this.options.push(topic)

                this.value = {
                    name: topic.name,
                    slug: topic.slug,
                    user_id: Studio.user.id
                }

                this.$store.dispatch('setPostTopic', this.value)

                this.update()
            },

            update() {
                this.$parent.update()
            },
        },
    }
</script>
