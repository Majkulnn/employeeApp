<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";


</script>

<template>
    <Head title="Employee" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Employee</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-1/3">
                <form @submit.prevent="submit()">

                    <div>
                        <InputLabel for="first_name" value="First Name" />

                        <TextInput
                            id="first_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.first_name"
                            autofocus
                            required
                            autocomplete="first_name"
                        />

                    </div>

                    <div>
                        <InputLabel for="middle_name" value="Middle Name" />

                        <TextInput
                            id="middle_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.middle_name"
                            autocomplete="middle_name"
                        />

                    </div>

                    <div>
                        <InputLabel for="last_name" value="Last Name" />

                        <TextInput
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.last_name"
                            required
                            autocomplete="last_name"
                        />

                    </div>

                    <div>
                        <InputLabel for="address" value="Address" />

                        <TextInput
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            required
                            autocomplete="address"
                        />

                    </div>
                    <div>
                        <InputLabel for="department_id" value="Department"/>

                        <select v-model="form.department_id" class="w-full">
                            <option disabled value="">Please select one</option>
                            <option v-for="department in departments" :value="department.id">{{department.name}}</option>
                        </select>

                    </div>

                    <div>
                        <InputLabel for="country_id" value="Country"/>

                        <select v-model="form.country_id" class="w-full" @change="getStates()">
                            <option disabled value="">Please select one</option>
                            <option v-for="country in countries" :value="country.id">{{country.name}}</option>
                        </select>

                    </div>

                    <div>
                        <InputLabel for="state_id" value="State"/>

                        <select v-model="form.state_id" class="w-full" @change="getCities()">
                            <option disabled value="">Please select one</option>
                            <option v-for="state in states" :value="state.id">{{state.name}}</option>
                        </select>

                    </div>

                    <div>
                        <InputLabel for="city_id" value="City"/>

                        <select v-model="form.city_id" class="w-full">
                            <option disabled value="">Please select one</option>
                            <option v-for="city in cities" :value="city.id">{{city.name}}</option>
                        </select>

                    </div>

                    <div>
                        <InputLabel for="zip_code" value="Zip Code" />

                        <TextInput
                            id="zip_code"
                            type="text" nummeric
                            class="mt-1 block w-full"
                            v-model="form.zip_code"
                            required
                            autocomplete="zip_code"
                        />

                    </div>

                    <div>
                        <InputLabel for="birthdate" value="BirthDate" />

                        <TextInput
                            id="birthdate"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.birthdate"
                            required
                            autocomplete="birthdate"
                        />

                    </div>

                    <div>
                        <InputLabel for="date_hired" value="Date Hired" />

                        <TextInput
                            id="date_hired"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.date_hired"
                            required
                            autocomplete="date_hired"
                        />

                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {router, useForm} from "@inertiajs/vue3";

export default {
    data() {
        return {
            countries: [],
            states: [],
            departments: [],
            cities: [],
            form: {
                first_name: "",
                last_name: "",
                middle_name: "",
                address: "",
                country_id: "",
                state_id: "",
                department_id: "",
                city_id: "",
                zip_code: "",
                birthdate: null,
                date_hired: null
            }
        };
    },
    created() {
        this.getCountries();
        this.getDepartments();
    },
    methods: {
        getCountries() {
            axios
                .get("/api/employees/countries")
                .then(res => {
                    this.countries = res.data;
                })
                .catch(error => {
                    console.log(console.error);
                });
        },
        getStates() {
            axios
                .get("/api/employees/" + this.form.country_id + "/states")
                .then(res => {
                    this.states = res.data;
                })
                .catch(error => {
                    console.log(console.error);
                });
        },
        getCities() {
            axios
                .get("/api/employees/" + this.form.state_id + "/cities")
                .then(res => {
                    this.cities = res.data;
                })
                .catch(error => {
                    console.log(console.error);
                });
        },
        getDepartments() {
            axios
                .get("/api/employees/departments")
                .then(res => {
                    this.departments = res.data;
                })
                .catch(error => {
                    console.log(console.error);
                });
        },
        submit(){
            axios
                .post("/api/employees", {
                    first_name: this.form.first_name,
                    middle_name: this.form.middle_name,
                    last_name: this.form.last_name,
                    address: this.form.address,
                    country_id: this.form.country_id,
                    state_id: this.form.state_id,
                    city_id: this.form.city_id,
                    department_id: this.form.department_id,
                    zip_code: this.form.zip_code,
                    birthdate: this.form.birthdate,
                    date_hired: this.form.date_hired
                })
                .then(()=>{
                    router.get('/employees')
                })
        }
    }
}
</script>
