<template>
    <main class="border-t-8 border-yellow-500">
        <header class="text-gray-100 p-3">

            <div class="social flex flex-row-reverse float-right pt-1">
                <a class="px-2 hover:text-yellow-500" href="https://github.com/MattStrauss"><i class="fab fa-github fa-fw"></i></a>
                <a class="px-2 hover:text-yellow-500" href="https://twitter.com/mstrauss_dev"><i class="fab fa-twitter fa-fw"></i></a>
                <a class="px-2 hover:text-yellow-500" href="https://laracasts.com/@mstrauss"><i class="fab fa-laravel fa-fw"></i></a>
            </div>

            <div class="flex">
                <i @click="toggleNavMenu" class="fas fa-bars fa-fw p-2 mr-2 cursor-pointer"></i>
                <Link v-if="navMenuOpen" href="/" class="p-1 hover:text-yellow-500 ml-1 mr-1" :class="($page.component === 'Home') ? 'text-yellow-500' : ''">
                    <i class="fa fa-home fa-fw"></i>
                    <span class="hidden md:inline uppercase tracking-wide text-xs font-bold"> Home</span>
                </Link>
                <Link v-if="navMenuOpen" href="/projects" class="p-1 hover:text-yellow-500 mr-1" :class="($page.component === 'Projects') ? 'text-yellow-500' : ''">
                    <i class="fa fa-lightbulb fa-fw"></i>
                    <span class="hidden md:inline uppercase tracking-wide text-xs font-bold"> Projects</span>
                </Link>
                <Link v-if="navMenuOpen" href="/blog" class="p-1 hover:text-yellow-500 ml-1" :class="($page.component.startsWith('Blog')) ? 'text-yellow-500' : ''">
                    <i class="fas fa-rss-square"></i>
                    <span class="hidden md:inline uppercase tracking-wide text-xs font-bold"> Blog</span>
                </Link>
                <Link v-if="navMenuOpen" href="/contact" class="p-1 hover:text-yellow-500 ml-1" :class="($page.component === 'Contact') ? 'text-yellow-500' : ''">
                    <i class="fas fa-mail-bulk fa-fw"></i>
                    <span class="hidden md:inline uppercase tracking-wide text-xs font-bold"> Contact</span>
                </Link>
            </div>

        </header>

        <article>
            <slot />
        </article>
        <div class="bg-gray-800 p-4 text-center text-yellow-500 text-xs" v-html="getCopyright"></div>
    </main>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3'

export default {
    name: "Layout",

    components: {
        Link,
    },

    data() {
        return {
            navMenuOpen: false,
        }
    },
    methods: {
        toggleNavMenu() {
            this.navMenuOpen = ! this.navMenuOpen;
        }
    },

    computed: {
        getCurrentYear() {
            let currentDate = new Date();
            return currentDate.getFullYear();
        },
        getCopyright () {
            return "&copy;"+ this.getCurrentYear + " Matt Strauss. All Rights Reserved.";
        }
    },
}
</script>

