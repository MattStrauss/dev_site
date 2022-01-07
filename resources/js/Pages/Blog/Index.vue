<template>
    <layout>
        <Head title="Blog"></Head>
        <div class="bg-gray-600 p-10 inset-y-auto object-center">
            <div class="object-cover">
                <div class="p-4 object-center text-center pb-10">
                    <div class="md:ml-40 md:mr-40  pb-5">
                        <p class="text-3xl text-yellow-500 font-hairline">Blog</p>
                        <div class="w-16 border-t-4 border-yellow-500 text-center ml-auto mr-auto mt-3 mb-3"></div>


                        <div>
                            <ul>
                                <li v-for="post in posts" :key="post.id" class="border-b-2 border-yellow-500 py-8">
                                    <Link :href="/blog/ + post.slug">
                                        <img :src="post.featured_image" alt="featured image of post"
                                             class="h-60 w-60 rounded-full mx-auto border-2 border-yellow-500" >
                                    </Link>
                                    <Link :href="/blog/ + post.slug" class="text-2xl text-yellow-500 hover:text-yellow-600" v-text="post.title"></Link>
                                    <p class="italic text-gray-100 text-hairline pt-2" v-text="post.excerpt"></p>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </layout>
</template>

<script>

import Layout from '../../Shared/Layout';
import { Head } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'

export default {
    name: "Index",

    components: {
        Layout,
        Head,
        Link,
    },

    props: {
        posts : Object,
    },

}
</script>

<style scoped>

</style>
