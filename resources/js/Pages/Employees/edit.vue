<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({employee : Object,})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Employee Data</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 shadow-lg  lg:px-8 w-1/3">
                <div>
                    Change Data
                </div>
<!--                <form @submit.prevent="submit">-->
                    <div>
                        <InputLabel for="first_name" value="First Name" />

                        <TextInput
                            id="first_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].first_name"
                        />

                    </div>
                    <div>
                        <InputLabel for="middle_name" value="Middle Name" />

                        <TextInput
                            id="middle_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].middle_name"
                        />

                    </div>
                    <div>
                        <InputLabel for="last_name" value="Last Name" />

                        <TextInput
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].last_name"
                        />

                    </div>
                    <div>
                        <InputLabel for="department_id" value="Department Name" />

                        <TextInput
                            id="department_id"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].department.name"
                        />

                    </div>
                    <div>
                        <InputLabel for="country_id" value="Country" />

                        <TextInput
                            id="country_id"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].country.name"
                        />

                    </div>
                    <div>
                        <InputLabel for="state_id" value="State" />

                        <TextInput
                            id="state_id"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].state.name"
                        />

                    </div>
                    <div>
                        <InputLabel for="city_id" value="City Name" />

                        <TextInput
                            id="city_id"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].city.name"
                        />

                    </div>
                    <div>
                        <InputLabel for="zip_code" value="Zip Code" />

                        <TextInput
                            id="zip_code"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].zip_code"
                        />

                    </div>
                    <div>
                        <InputLabel for="birthdate" value="Birth Date" />

                        <TextInput
                            id="birthdate"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].birthdate"
                        />

                    </div>
                    <div>
                        <InputLabel for="date_hired" value="Date Hired" />

                        <TextInput
                            id="date_hired"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="employee[0].date_hired"
                        />

                    </div>
<!--                </form>-->
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {router, useForm, usePage} from "@inertiajs/vue3";

let employee;
employee = usePage().props().employee()
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
                .put("/api/employees/" + employee.id, {
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
