<template>
    <layout>
        <Head title="Blog"></Head>
        <div class="bg-gray-600 p-10 inset-y-auto object-center">
            <div class="object-cover">
                <div class="p-4 object-center text-center pb-10">
                    <div class="md:ml-40 md:mr-40  pb-5">
                        <p class="text-3xl text-yellow-500 font-hairline">Blog</p>
                        <div class="w-16 border-t-4 border-yellow-500 text-center ml-auto mr-auto mt-3 mb-3"></div>

                        <div v-show="error" class="rounded-md bg-yellow-50 p-4 mx-10">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-yellow-800">
                                        Blog Post Not Found!
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button @click="error = false" type="button" class="inline-flex bg-yellow-50 rounded-md p-1.5 text-yellow-500 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-50 focus:ring-yellow-600">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="py-4 w-full">
                            <input v-model="search" type="search" placeholder="Search..." class="appearance-none w-full px-4 py-2 border border-gray-300 text-base rounded-md text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:ring-yelllow-500 focus:border-yelllow-500 lg:max-w-xs">
                        </div>


                        <div v-if="filters?.tag" class="text-center">
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-600 mr-2 mb-2">
                                <i class="fas fa-filter fa-fw"></i> "{{ filters?.tag }}"
                                <i @click="clearTagFilter()" class="fas fa-times-circle parent hover:text-red-500"></i>
                            </span>
                        </div>


                        <div>
                            <ul>
                                <li v-for="post in posts.data" :key="post.id" class="border-b-2 border-yellow-500 py-8">
                                    <Link :href="/blog/ + post.slug">
                                        <img :src="post.featured_image" alt="featured image of post"
                                             class="h-60 w-60 rounded-full mx-auto border-2 border-yellow-500" >
                                    </Link>
                                    <p class="text-gray-100 text-sm tracking-widest py-2">
                                        {{post.created_at}} &middot; {{post.readTime}} minute read
                                    </p>
                                    <Link :href="/blog/ + post.slug" class="text-2xl text-yellow-500 hover:text-yellow-600" v-text="post.title"></Link>
                                    <p class="text-gray-100 font-light pt-2" v-text="post.excerpt"></p>

                                    <div class="px-6 pt-4">
                                        <Link :href="'/blog/?tag=' + tag.name" v-for="tag in post.tags"
                                              class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-600 mr-2 mb-2 hover:bg-yellow-100">
                                            <i class="fas fa-tags text-yellow-600"></i> {{tag.name}}
                                        </Link>
                                    </div>

                                </li>
                            </ul>
                        </div>

                        <div v-if="posts.last_page > 1" class="my-5">

                            <template v-for="link in posts.links">

                                <Link
                                    class="p-1 text-gray-100 hover:text-yellow-500"
                                    v-if="link.url && ! link.active"
                                    :href="link.url"
                                    v-html="link.label">
                                </Link>

                                <span
                                    class="p-1 text-yellow-700 underline"
                                    v-else-if="link.active"
                                    v-html="link.label">
                                </span>

                                <span
                                    class="p-1 text-gray-400"
                                    v-else
                                    v-html="link.label">
                                </span>

                            </template>

                        </div>



                    </div>
                </div>
            </div>
        </div>

    </layout>
</template>

<script>

import Layout from '../../Shared/Layout';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { debounce } from "lodash";

export default {
    name: "Index",

    data() {
        return {
            search: this.filters?.search ?? '',
        }
    },

    components: {
        Layout,
        Head,
        Link,
    },

    props: {
        posts : Object,
        filters: Object,
        error: {
            type: Boolean,
            default: false,
        },
    },

    methods : {
        clearTagFilter() {
            Inertia.get("/blog");
        },
    },

    watch: {
        search: debounce((value) => {
            Inertia.get("/blog", {search: value},
            { preserveState: true, replace: true, });
        }, 300)
    }

}
</script>
