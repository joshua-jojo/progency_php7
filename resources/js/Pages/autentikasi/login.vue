<template lang="">
    <div class="text-4xl drop-shadow-lg text-center font-semibold">Login</div>
    <div class="alert m-2 alert-error" v-if="flash">{{flash}}</div>
    <form class="flex flex-col gap-2 p-4" @submit.prevent="submit">
        <InputText required title="Email" v-model:inputValue="login.email" :error="login.errors.email"></InputText>
        <InputText required title="Password" hidden v-model:inputValue="login.password" :error="login.errors.password"></InputText>
        <div class="flex flex-col gap-2 w-full mt-4">
            <div class="flex justify-start text-sm">
                <Link :href="route('register.index')" class="link link-primary">Belum punya akun? Register.</Link>
            </div>
            <ButtonSubmit full :form="login" type="success">login</ButtonSubmit>
        </div>
    </form>
</template>
<script>
import { useForm, Link } from '@inertiajs/inertia-vue3';
import InputText from '../../Components/input/InputText.vue';
import ButtonSubmit from '../../Components/button/ButtonSubmit.vue'
import AuthLayout from '../../Layouts/AuthLayout.vue';
export default {
    layout: AuthLayout,
    props: {
        flash: String
    },
    setup() {

        const login = useForm({
            email: null,
            password: null,
        })

        const submit = () => {
            login.post(route('login.store'))
        }
        return {
            login,
            submit,
        }
    },
    components: {
        InputText,
        Link,
        ButtonSubmit,
    }
}
</script>
<style lang="">
    
</style>