export default [
    {
        path: '/',
        name: 'home',
        component: require('./screens/HomeScreen').default,
    },
    {
        path: '/logout',
        name: 'logout',
        component: require('./screens/LoginScreen.vue'),
    },
    {
        path: '/search',
        name: 'search',
        component: require('./screens/SearchScreen.vue').default,
    },
    {
        path: '/popular',
        name: 'popular',
        component: require('./screens/UnderConstructScreen.vue').default
    },
    {
        path: '/tags',
        name: 'tags',
        component: require('./screens/TagScreen').default,
    },
    {
        path: '/tags/:slug',
        name: 'tag-posts',
        component: require('./screens/TagPostsScreen').default,
    },
    {
        path: '/topics',
        name: 'topics',
        component: require('./screens/TopicScreen').default,
    },
    {
        path: '/topicsAdd',
        name: 'topicsadd',
        component: require('./screens/topics/TopicsEdit').default,
    },
    {
        path: '/topics/:slug',
        name: 'topic-posts',
        component: require('./screens/TopicPostsScreen').default,
    },
    {
        path: '/stats',
        name: 'stats',
        component: require('./screens/stats/StatsIndex').default,
    },
    {
        path: '/upgrade',
        name: 'upgrade',
        component: require('./screens/UnderConstructScreen').default,
    },
    {
        path: '/admin/post',
        name: 'admin-post',
        component: require('./screens/posts/AdminPost.vue').default,
    },
    {
        path: '/help',
        name: 'help',
        component: require('./screens/HelpScreen').default,
    },
    {
        path: '/stats/:id',
        name: 'stats-show',
        component: require('./screens/stats/StatsShow').default,
    },
    {
        path: '/posts',
        name: 'posts',
        component: require('./screens/posts/PostIndex').default,
    },
    {
        path: '/posts/create',
        name: 'posts-create',
        component: require('./screens/posts/PostEdit').default,
    },
    {
        path: '/posts/:id/edit',
        name: 'posts-edit',
        component: require('./screens/posts/PostEdit').default,
    },
    {
        path: '/settings',
        name: 'settings-show',
        component: require('./screens/settings/SettingsShow').default,
    },
    {
        path: '/:identifier',
        name: 'user',
        component: require('./screens/UserScreen').default,
    },
    {
        path: '/:identifier/:slug',
        name: 'post',
        component: require('./screens/PostScreen').default,
    },

    {
        path: '*',
        name: 'catch-all',
        redirect: '/',
    },
]
