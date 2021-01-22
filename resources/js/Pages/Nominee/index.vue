<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nominee
            </h2>
        </template>

        <div class="py-12 text-gray-800">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl sm:rounded-lg flex flex-wrap">
                    <div v-for="nominee in nominees" :key="nominee.id" class="w-1/2 p-4">
                        <div class="flex bg-white my-4">
                            <div class="w-1/3 rounded-lg text-center m-10 bg-gray-600">Photo</div>
                            <div class="w-2/3 py-10 pl-2 text-sm">
                                <ul>
                                    <li>Name: {{ nominee.name }}</li>
                                    <li>Age: {{ nominee.age }}</li>
                                    <li>Class: {{ nominee.class }}</li>
                                    <li>Hobby: {{ nominee.hobby }}</li>
                                    <li>Description: {{ nominee.description }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props: {
            nominees: Array,
        },

        components: {
            AppLayout,
        },
    }
</script>
