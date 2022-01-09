<template>
    <layout>
        <Head>
            <title>{{post.title}}</title>
            <meta name="description" :content="post.excerpt" />
            <meta name="twitter:title" :content="post.title">
            <meta name="twitter:description" :content="post.excerpt">
            <meta name="twitter:image" :content="'https://mattstrauss.dev' + post.featured_image">
            <meta name="twitter:creator" content="@mstrauss_dev">
        </Head>
        <div class="bg-gray-600 p-3 md:p-10 inset-y-auto object-center">
            <div class="object-cover">
                <div class="p-4 object-center text-center pb-10">
                    <div class="md:ml-40 md:mr-40 pb-5">
                        <p v-text="post.title" class="text-3xl text-yellow-500 font-hairline"></p>
                        <div class="w-16 border-t-4 border-yellow-500 text-center ml-auto mr-auto mt-3 mb-3"></div>

                        <div>
                            <img :src="post.featured_image" alt="featured image of post"
                                 class="h-60 w-60 rounded-full mx-auto border-2 border-yellow-500" >

                            <p class="text-gray-100 text-sm tracking-widest py-2">
                                {{post.created_at}} &middot; {{post.readTime}} minute read
                            </p>

                            <div class="px-6 pt-4">
                                <span v-for="tag in post.tags" class="inline-block bg-gray-100 rounded-full px-3 py-1
                                        text-sm font-semibold text-gray-600 mr-2 mb-2">
                                    <span> <i class="fas fa-tags text-yellow-600"></i> {{tag.name}} </span>
                                </span>
                            </div>

                            <div v-html="post.body"
                                 class="text-gray-100 mt-6 prose prose-yellow prose-lg mx-auto text-left">
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

    </layout>
</template>

<script>

import Layout from '../../Shared/Layout';
import {Head, Link} from '@inertiajs/inertia-vue3'

export default {
    name: "Show",

    components: {
        Layout,
        Head,
    },


    props: {
        post : Object,
    },

}
</script>

<style scoped>

</style>
