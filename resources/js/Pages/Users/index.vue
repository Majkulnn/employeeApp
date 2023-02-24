<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({users : Object,})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Link :href="route('users.create')" method="get" as="button" class="bg-emerald-300 font-bold overflow-hidden shadow-sm sm:rounded-lg">
                        Create User
                    </Link>
                <table class="p-6 text-gray-900 w-2/6 table-fixed bg-white rounded-2xl border- border-black">
                        <thead class="w-full border-b-2  font-bold decoration">
                            <td class="w-1/12">Id</td>
                            <td>Username</td>
                            <td>Firstname</td>
                            <td>Lastname</td>
                            <td>Options</td>
                        </thead>
                        <tbody v-for="user in users" class="p-6 text-gray-900">
                            <td>{{user.id}}</td>
                            <td>{{user.username}}</td>
                            <td>{{user.first_name}}</td>
                            <td>{{user.last_name}}</td>
                            <td class="font-bold">
                                <Link as="button" class="bg-yellow-200 rounded-md">
                                    Edit
                                </Link>
                                <Link :href="`/users/${user.id}`" method="delete" as="button" class="bg-red-400 rounded-md">
                                    Delete
                                </Link>
                            </td>
                        </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
