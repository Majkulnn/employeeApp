<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import SearchInput from 'vue-search-input'
import 'vue-search-input/dist/styles.css'
import TextInput from '@/Components/TextInput.vue'

defineProps({ cities: Object })

const form = useForm({
  search: '',
  terms: false,
})
const submit = () => {
  form.get('/cities')
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Cities
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:w-2/5">
        <div class="m-auto border-1 flex">
          <Link
            :href="route('cities.create')"
            method="get"
            as="button"
            class="bg-emerald-300 font-bold mx-auto overflow-hidden shadow-sm sm:rounded-lg self-center"
          >
            &nbsp;Create City&nbsp;
          </Link>
          <form
            class="mx-auto"
            @submit.prevent="submit"
          >
            <search-input
              v-model="form.search"
              placeholder="Search for city..."
              class="w-1/3 "
              autocomplete
            />
          </form>
          <Link
            :href="`/cities`"
            method="get"
            as="button"
            class="bg-green-200 font-bold mr-auto overflow-hidden sm:rounded-lg self-center"
          >
            Show All
          </Link>
        </div>
        <table class="text-gray-900 mx-auto mt-5 table-fixed pt-0 w-full bg-white rounded-2xls">
          <thead class="w-full border-b-2  font-bold decoration">
            <td class="w-1/12">
              Id
            </td>
            <td>State Name</td>
            <td>Name</td>
            <td>Options</td>
          </thead>
          <tbody
            v-for="city in cities"
            class="p-6 text-gray-900 border-b-2 truncate"
          >
            <td class="truncate">
              {{ city.id }}
            </td>
            <td class="truncate">
              {{ city.state.name }}
            </td>
            <td class="truncate">
              {{ city.name }}
            </td>
            <td class="truncate font-bold space-x-2">
              <Link
                :href="`/cities/${city.id}/edit`"
                methods="GET"
                as="button"
                class="bg-yellow-200 rounded-md"
              >
                &nbsp;Edit&nbsp;
              </Link>
              <Link
                :href="`/cities/${city.id}`"
                method="delete"
                as="button"
                class="bg-red-400 rounded-md"
              >
                &nbsp;Delete&nbsp;
              </Link>
            </td>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
