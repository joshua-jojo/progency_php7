<template lang="">
    <Card>
        <input-text title="Nama" v-model:inputValue="form.nama" :error="form.errors.nama" sm></input-text>
        <input-text title="telepon"  v-model:inputValue="form.telp" :error="form.errors.telp" sm></input-text>
        <input-file :form="form" type=".jpg, .png" dataIndex="logo" title="Logo"></input-file>
        <div class="form-control flex flex-row gap-4" v-if="auth.user.role == 'super admin' || auth.user.role == 'admin'">
            <div class="label">Status Terverifikasi : </div>
            <div class="flex gap-2 items-center">
                <input type="radio" value="aktif" v-model="form.status_terverifikasi" class="radio radio-primary">
                <label class="label">Aktif</label>
            </div>
            <div class="flex gap-2 items-center">
                <input type="radio" value="tidak aktif" v-model="form.status_terverifikasi" class="radio radio-primary">
                <label class="label">Tidak Aktif</label>
            </div>
        </div>
        <div class="flex justify-end mt-3">
            <button-submit type="success" @click="submit" :form="form">simpan</button-submit>
        </div>
    </Card>
</template>
<script setup>
import Card from '../../../Components/card/card.vue';
import InputText from '../../../Components/input/InputText.vue';
import InputFile from '../../../Components/input/InputFile.vue'
import inpuTextArea from '../../../Components/input/inpuTextArea.vue';
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    developer: Object,
    auth: Object,
});
const form = useForm({
    _method: 'put',
    id: props.developer.id,
    nama: props.developer.user.nama,
    telp: props.developer.telp,
    logo: null,
    status_terverifikasi: props.developer.status_terverifikasi,
})

const submit = () => {
    form.post(route('pengaturan.developer.update', {
        developer: form.id
    }), {
        preserveScroll: true,
    })
}
</script>
<style lang="">
    
</style>