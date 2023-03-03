<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

defineProps({ employee: Object })

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Employee Data
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 shadow-lg  lg:px-8 w-1/3">
        <div>
          Employee Profile
        </div>
        <div>
          <InputLabel
            for="first_name"
            value="First Name"
          />

          <TextInput
            id="first_name"
            v-model="employee[0].first_name"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="middle_name"
            value="Middle Name"
          />

          <TextInput
            id="middle_name"
            v-model="employee[0].middle_name"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="last_name"
            value="Last Name"
          />

          <TextInput
            id="last_name"
            v-model="employee[0].last_name"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="department_id"
            value="Department Name"
          />

          <TextInput
            id="department_id"
            v-model="employee[0].department.name"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="country_id"
            value="Country"
          />

          <TextInput
            id="country_id"
            v-model="employee[0].country.name"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="state_id"
            value="State"
          />

          <TextInput
            id="state_id"
            v-model="employee[0].state.name"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="city_id"
            value="City Name"
          />

          <TextInput
            id="city_id"
            v-model="employee[0].city.name"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="zip_code"
            value="Zip Code"
          />

          <TextInput
            id="zip_code"
            v-model="employee[0].zip_code"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="birthdate"
            value="Birth Date"
          />

          <TextInput
            id="birthdate"
            v-model="employee[0].birthdate"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>
        <div>
          <InputLabel
            for="date_hired"
            value="Date Hired"
          />

          <TextInput
            id="date_hired"
            v-model="employee[0].date_hired"
            type="text"
            class="mt-1 block w-full"
            readonly
          />
        </div>

        <div class="flex items-center justify-center space-x-36 mt-4 mx-0">
          <Link
            :href="`/employees/${employee[0].id}`"
            method="delete"
            as="button"
            class="rounded-md"
          >
            <SecondaryButton class="bg-red-700 text-white hover:bg-red-800">
              Delete
            </SecondaryButton>
          </Link>
          <Link
            :href="`/employees/${employee[0].id}/edit`"
            method="get"
            as="button"
            class="rounded-md"
          >
            <SecondaryButton class="bg-yellow-400 text-black hover:bg-yellow-600">
              Edit
            </SecondaryButton>
          </Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
