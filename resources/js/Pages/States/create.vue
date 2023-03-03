<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Dropdown from '@/Components/Dropdown.vue'

const form = useForm({
  country_id: '',
  name: '',
  terms: false,
})
const submit = () => {
  form.post(route('states.store'))
}
defineProps({ countries: Object })
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create State
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-1/3">
        <form @submit.prevent="submit">
          <div>
            <InputLabel
              for="country_id"
              value="Country"
            />

            <select v-model="form.country_id">
              <option
                disabled
                value=""
              >
                Please select one
              </option>
              <option
                v-for="country in countries"
                :value="country.id"
              >
                {{ country.name }}
              </option>
            </select>

            <InputError
              class="mt-2"
              :message="form.errors.country_id"
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
