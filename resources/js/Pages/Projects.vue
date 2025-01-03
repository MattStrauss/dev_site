<template>
    <layout>
        <Head title="Projects"></Head>
        <div class="bg-gray-600 p-6 inset-y-auto object-center">

            <div class="text-center text-gray-100">
                <h2 class="text-3xl font-hairline text-yellow-500">Projects</h2>
                <div class="w-16 border-t-4 border-yellow-500 text-center ml-auto mr-auto mt-3 mb-3"> </div>
            </div>

            <div v-if="projectsFilteredBy" class="text-center">
                <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-600 mr-2 mb-2">
                   <i class="fas fa-filter fa-fw"></i> "{{ projectsFilteredBy }}" <i @click="clearFilter" class="fas fa-times-circle parent hover:text-red-500"></i></span>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 mb-4 sm:mb-0">
                <div v-for="project in filteredProjects" class="max-w-lg rounded overflow-hidden bg-gray-200 mt-3 mb-3 shadow-lg mx-auto border-gray-700 border-2">
                    <img class="w-full" :src="project.img">
                    <div class="px-6 py-4 bg-gray-50 border-t-2 border-gray-300">
                        <div class="font-bold text-xl mb-2 text-yellow-600">
                            <a v-if="project.link" :href="project.link" class="hover:text-yellow-700" v-text="project.name"></a>
                            <span v-if="! project.link" v-text="project.name"></span>
                        </div>
                        <p class="text-gray-700 text-base" v-text="project.description"></p>
                        <p v-if="project.demo" class="mt-4 text-gray-700">
                            <a :href="project.demo" class="hover:text-yellow-700"> <i class="fas fa-video"></i> Demo</a>
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <span v-for="skill in project.skills" class="inline-block bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2">
                            <a @click="filterProjects(skill)" class="hover:text-yellow-400 cursor-pointer" > #{{skill}}</a></span>
                    </div>
                </div>
            </div>

        </div>
    </layout>
</template>

<script>

import Layout from '../Shared/Layout'
import { Head } from '@inertiajs/inertia-vue3'

export default {
    name: "Projects",

    components: {
        Layout,
        Head,
    },

    data() {
        return {
            projectsFilteredBy: '',
        }
    },

    computed:
        {
            filteredProjects() {
                if (this.projectsFilteredBy) {
                    return this.projects.filter((project) => project.skills.includes(this.projectsFilteredBy));
                }
                else {
                    return this.projects;
                }
            }
        },

    methods:
        {
            filterProjects(skill) {
                this.projectsFilteredBy = skill;
            },
            clearFilter() {
                this.projectsFilteredBy = '';
            },
        },

    props:
        {
            projects: Object,
        },
}
</script>
