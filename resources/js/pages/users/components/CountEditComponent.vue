<template>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg p-5 bg-white shade-component">
        <h4 class="text-xl font-bold">Basic information</h4>
        <div class="grid gap-10 items-end md:grid-cols-1 mt-2 max-[768px]:mt-3">
            <div class="flex gap-4 items-center space-x-4 max-[768px]:flex-col max-[768px]:items-center max-[768px]:gap-2">

                <img class="w-24 h-24 rounded-full" src="/system/images/avatars/avatar1.svg" alt="">

                <div class="font-medium w-full mt-10 mb-10 grid grid-cols-2 items-end gap-5  max-[768px]:grid-cols-1" style="margin-left: 0;">
                    <div class="relative z-0">
                        <input
                            v-model="user.name"
                            type="text" 
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " 
                            disabled
                        />
                        <label for="default_standard" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Name
                        </label>
                    </div>
                    <div class="relative z-0 mt-6 w-full">
                        <input
                            v-model="user.email"
                            type="email" 
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " 
                            disabled
                        />
                        <label  class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Email
                        </label>
                    </div>
                    <!-- <button
                        class="mt-8 inline-flex items-center w-20 bg-blue-50 text-blue-500 border border-blue-400 focus:outline-none hover:bg-blue-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Guardar
                    </button> -->
                </div>
            </div>
           
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object
        },
    },
}
</script>

<style>

</style>