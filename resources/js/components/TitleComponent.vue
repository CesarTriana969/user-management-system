<template>
    <div class="max-[768px]:mb-5">
        <p class="text-4xl text-gray-900 mt-5">{{ title }}</p>
        <nav class="flex justify-between mt-3" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center" v-for="(link, index) in links" :key="index">
                    <a :href="link.href" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 mr-3">
                        {{ link.text }}
                    </a>

                    <div v-if="index !== links.length - 1" class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true
        },
        links: {
            type: Array,
            required: true
        }
    }
}
</script>