<template lang="">
    <div class="text-4xl drop-shadow-lg text-center font-semibold">Register</div>
    <form class="flex flex-col gap-2" @submit.prevent="submit" :key="register.processing">
        <input-text required v-model:inputValue="register.nama" :error="register.errors.nama" title="nama"></input-text>
        <input-text required v-model:inputValue="register.email" :error="register.errors.email" title="email"></input-text>
        <div class="grid lg:grid-cols-2 gap-4">
            <input-text required hidden title="Password" v-model:inputValue="register.password" :error="register.errors.password"></input-text>
            <input-text required hidden title="ulangi password" placeholder="Ulangi Password" v-model:inputValue="register.password_confirmation" :error="register.errors.password_confirmation"></input-text>
        </div>
        <input-select title="daftar sebagai" v-model:inputValue="register.role" :dataSelect="role" pick="nama" label="nama"></input-select>
        <div class="flex flex-col gap-2 w-full mt-4">
            <div class="flex justify-start text-sm">
                <Link :href="route('login.index')" class="link link-primary">Sudah punya akun? Login.</Link>
            </div>
            <ButtonSubmit full :form="register" type="success">Register</ButtonSubmit>
        </div>
    </form>
</template>
<script>
import AuthLayout from '../../Layouts/AuthLayout.vue';

export default {
    layout: AuthLayout
}
</script>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import InputText from '../../Components/input/InputText.vue';
import ButtonSubmit from '../../Components/button/ButtonSubmit.vue'
import inputSelect from '../../Components/input/inputSelect.vue';
import { useForm } from '@inertiajs/inertia-vue3'

const register = useForm({
    nama: null,
    email: null,
    password: null,
    role: 'agen',
    password_confirmation: null,
})
const role = [
    {
        nama: 'developer',
    },
    {
        nama: 'agen',
    }
]
const submit = () => {
    register.post(route('register.store'), {
        onSuccess: () => {
            register.reset()
        }
    })
}
</script>
<style lang="">
    
</style>