
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal', {
    template: `
        <div class="small reveal">
            <h1>{{ post.title }}</h1>
            <p>{{ post.text }}</p>
            <a :href="post.url" class="small button float-right" target="_blank">Go to feed page</a>
        
            <button class="close-button" @click="$emit('close')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`,

    data: function () {
        return {
            post: []
        };
    },

    created: function () {
        this.fetchPost(app.currentPost);
    },

    methods: {
        fetchPost: function (post) {
            $.getJSON('/post/' + post, function (post) {
                this.post = post;
            }.bind(this));
        }
    }
});

const app = new Vue({
    el: '#app',

    data: {
        showModal: false,
        currentPost: 1
    }
});
