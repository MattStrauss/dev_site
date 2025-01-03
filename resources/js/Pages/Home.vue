<template>
    <layout>
        <Head title="Home"></Head>
        <div class="bg-gray-600 p-10 inset-y-auto object-center">
            <img class="h-40 w-40 rounded-full mx-auto border-2 border-yellow-500" src="/storage/images/avatar.jpeg">
            <div class="w-16 border-t-4 border-yellow-500 text-center ml-auto mr-auto mt-3 mb-3">  </div>
            <div class="text-center text-gray-100 font-thin">
                <h2 class="text-lg">Matt Strauss</h2>
                <div class="text-yellow-500">Full Stack Developer</div>
                <div>Pennsylvania, USA</div>
                <div>PHP, Laravel, Vue, Automated Testing</div>
            </div>
        </div>

        <div class="object-cover">

            <div class="bg-gray-700 p-4 object-center text-center pb-10">

                <div class="md:ml-40 md:mr-40 pb-5">
                    <p class="text-3xl text-yellow-500 font-hairline">About</p>
                    <div class="w-16 border-t-4 border-yellow-500 text-center ml-auto mr-auto mt-3 mb-3"></div>

                    <p class="text-center text-gray-100 text-hairline pt-2 prose prose-lg prose-yellow max-w-full">
                        I'm a freelance software developer with experience in a range of technologies, see below. While I typically work as a full stack developer, my skills are
                        stronger on the server-side. But, with the advent of tools like <a href="https://inertiajs.com/" class="underline hover:text-yellow-500"> Inertia.js</a>
                        and <a href="https://tailwindcss.com/" class="underline hover:text-yellow-500">TailwindCSS</a>, the frontend is becoming more and more fun. I am keenly
                        interested in open source software and <u>a long time user/fan of automated testing</u>.
                        My educational background includes; earning a Bachelor of Science in Software Engineering from the
                        <a href="https://www.psu.edu/" class="underline hover:text-yellow-500">Pennsylvania State University</a> and
                        a Master of Science in Computer Science from the <a href="https://www.gatech.edu/" class="underline hover:text-yellow-500">Georgia Institute of Technology</a>.
                        My specialization at Georgia Tech was <strong>Machine Learning</strong>, which I am often able to apply in my work.
                    </p>

                </div>

                <div class="md:ml-40 md:mr-40 pt-5 text-center">
                    <h2 class="text-3xl text-yellow-500 font-hairline">Familiar With</h2>
                    <div class="w-16 border-t-4 border-yellow-500 text-center ml-auto mr-auto mt-3 mb-3">  </div>

                    <div class="flex content-start flex-wrap flex-col sm:flex-row text-gray-700 pt-2 content-center">

                        <div class="sm:w-1/3 w-auto border-2 border-gray-800 m-2 bg-gray-200 rounded flex-grow content-center p-3">
                            <div class="border-b-2 border-gray-600 mb-4">
                                <h4 class="text-3xl font-thin pt-2">Backend</h4>
                            </div>
                            <div class="px-6 py-4">

                                <span class="inline-block bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2"
                                      v-for="skill in skills.backend" :key="skill">{{ skill }}
                                </span>

                            </div>
                        </div>

                        <div class="sm:w-1/3 w-auto border-2 border-gray-800 m-2 bg-gray-200 rounded flex-grow content-center p-3">
                            <div class="border-b-2 border-gray-600 mb-4">
                                <h4 class="text-3xl font-thin pt-2">Frontend</h4>
                            </div>
                            <div class="px-6 py-4">

                                <span class="inline-block bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2"
                                      v-for="skill in skills.frontend" :key="skill">{{ skill }}
                                </span>

                            </div>
                        </div>

                        <div class="sm:w-1/3 w-auto border-2 border-gray-800 m-2 bg-gray-200 rounded flex-grow content-center p-3">
                            <div class="border-b-2 border-gray-600 mb-4">
                                <h4 class="text-3xl font-thin pt-2">Automated Testing</h4>
                            </div>
                            <div class="px-6 py-4">

                                <span class="inline-block bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2"
                                      v-for="skill in skills.testing" :key="skill">{{ skill }}
                                </span>

                            </div>
                        </div>

                        <div class="sm:w-1/3 w-auto border-2 border-gray-800 m-2 bg-gray-200 rounded flex-grow content-center p-3">
                            <div class="border-b-2 border-gray-600 mb-4">
                                <h4 class="text-3xl font-thin pt-2">Miscellaneous </h4>
                            </div>
                            <div class="px-6 py-4">

                                 <span class="inline-block bg-gray-600 rounded-full px-3 py-1 text-sm font-semibold text-gray-100 mr-2 mb-2"
                                       v-for="skill in skills.misc" :key="skill">{{ skill }}
                                </span>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </layout>

</template>

<script>
import Layout from '../Shared/Layout';
import { Head } from '@inertiajs/inertia-vue3'

export default {
    name: "Home",

    components: {
        Layout,
        Head,
    },

    props: {
        skills: Object,
    },
}
</script>
