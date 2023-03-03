<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

defineProps({ country: Object })

const country = usePage().props.country

const form = useForm('ChangeUser', {
  country_code: country.country_code,
  name: country.name,
  terms: false,
})
const submit = () => {
  form.put(`/countries/${country.id}`)
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Country Data
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 shadow-lg  lg:px-8 w-1/3">
        <div>
          Change Data
        </div>
        <form @submit.prevent="submit">
          <div>
            <InputLabel
              for="country_code"
              value="Code"
            />

            <TextInput
              id="country_code"
              v-model="form.country_code"
              type="text"
              class="mt-1 block w-full"
              autofocus
              required
              autocomplete="country_code"
            />

            <InputError
              class="mt-2"
              :message="form.errors.country_code"
            />
          </div>
          <div>
            <InputLabel
              for="name"
              value="Name"
            />

            <TextInput
              id="name"
              v-model="form.name"
              type="text"
              class="mt-1 block w-full"
              required
              autocomplete="lastName"
            />

            <InputError
              class="mt-2"
              :message="form.errors.name"
            />
          </div>

          <div class="flex items-center justify-center space-x-36 mt-4 mx-0">
            <Link
              :href="`/countries/${country.id}`"
              method="delete"
              as="button"
              class="rounded-md"
            >
              <SecondaryButton class="bg-red-700 text-white hover:bg-red-800">
                Delete
              </SecondaryButton>
            </Link>

            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Update
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
