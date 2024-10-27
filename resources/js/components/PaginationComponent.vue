<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous </a>
            <a href="#"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ dataComplet.from }}</span>
                    to
                    <span class="font-medium">{{ dataComplet.last_page }}</span>
                    of
                    <span class="font-medium">{{ dataComplet.total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <template v-for="(pagination, id) in dataComplet.links" :key="id"
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <button href="#" aria-current="page" :class="[
                            '  relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                            pagination.active ? 'z-10 bg-gray-200 border-gray-800 text-gray-800 relative inline-flex items-center px-4 py-2 border text-sm font-medium' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                        ]" @click="$emit('getData', pagination.url)" v-html="pagination.label"> </button>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        dataComplet: {
            type: Object
        },
    },
}
</script>