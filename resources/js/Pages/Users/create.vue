<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const form = useForm({
  lastName: '',
  firstName: '',
  email: '',
  terms: false,
})
const submit = () => {
  form.post(route('users.store'))
}
defineProps({ users: Object })
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create User
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-1/3">
        <form @submit.prevent="submit">
          <div>
            <InputLabel
              for="firstName"
              value="Firstname"
            />

            <TextInput
              id="firstName"
              v-model="form.firstName"
              type="text"
              class="mt-1 block w-full"
              autofocus
              required
              autocomplete="firstName"
            />

            <InputError
              class="mt-2"
              :message="form.errors.firstName"
            />
          </div>
          <div>
            <InputLabel
              for="lastName"
              value="Lastname"
            />

            <TextInput
              id="lastName"
              v-model="form.lastName"
              type="text"
              class="mt-1 block w-full"
              required
              autocomplete="lastName"
            />

            <InputError
              class="mt-2"
              :message="form.errors.lastName"
            />
          </div>

          <div class="mt-4">
            <InputLabel
              for="email"
              value="Email"
            />

            <TextInput
              id="email"
              v-model="form.email"
              type="email"
              class="mt-1 block w-full"
              required
              autocomplete="username"
            />

            <InputError
              class="mt-2"
              :message="form.errors.email"
            />
          </div>

          <div class="flex items-center justify-end mt-4">
            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Create
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
