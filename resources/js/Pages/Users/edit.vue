<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({user : Object,})

const user = usePage().props.user;

const form = useForm('ChangeUser',{
    username: user.username,
    lastName: user.last_name,
    firstName: user.first_name,
    email: user.email,
    terms: false,
});
const submit = () => {
    form.put(`/users/${user.id}`);
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User Data</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 shadow-lg  lg:px-8 w-1/3">
                <div>
                    Change Data
                </div>
                <form @submit.prevent="submit">
                    <div class="card-header">
                        <InputLabel for="username" value="Username" />

                        <TextInput
                            id="username"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.username"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.lastName" />
                    </div>

                    <div>
                        <InputLabel for="firstName" value="Firstname"/>

                        <TextInput
                            id="firstName" type="text" class="mt-1 block w-full"
                            v-model="form.firstName"
                            required
                            autocomplite="firsName"
                        />

                        <InputError class="mt-2" :message="form.errors.firstName" />
                    </div>
                    <div>
                        <InputLabel for="lastName" value="Lastname" />

                        <TextInput
                            id="lastName"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.lastName"
                            required
                            autocomplete="lastName"
                        />

                        <InputError class="mt-2" :message="form.errors.lastName" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-bind:value="user.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="flex items-center justify-center space-x-36 mt-4 mx-0">
                        <Link :href="`/users/${user.id}`" method="delete" as="button" class="rounded-md">
                            <SecondaryButton class="bg-[#dc2626] text-white hover:bg-red-800">
                                Delete
                            </SecondaryButton>
                        </Link>

                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
