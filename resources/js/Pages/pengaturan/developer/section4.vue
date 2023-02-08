<template lang="">
    <Card>
        <input-file title="file 1" :form="form" dataIndex="file_1" :dataLink="file_1?file_1.path:null" :dataLabel="file_1?file_1.nama:null"></input-file>
        <input-file title="file 2" :form="form" dataIndex="file_2" :dataLink="file_2?file_2.path:null" :dataLabel="file_2?file_2.nama:null"></input-file>
        <input-file title="file 3" :form="form" dataIndex="file_3" :dataLink="file_3?file_3.path:null" :dataLabel="file_3?file_3.nama:null"></input-file>
        <div class="flex justify-end">
            <button-submit :form="form" @click="submit" type="success">Simpan</button-submit>
        </div>
    </Card>
    <template>
    </template>
</template>
<script setup>
import Card from '../../../Components/card/card.vue';
import InputFile from '../../../Components/input/InputFile.vue';
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps, onMounted, ref } from 'vue';

const props = defineProps({
    developer: Object
});

const test = ref(null)

const file_1 = props.developer.dokumen ? props.developer.dokumen[0] : null;
const file_2 = props.developer.dokumen ? props.developer.dokumen[1] : null;
const file_3 = props.developer.dokumen ? props.developer.dokumen[2] : null;
const form = useForm({
    file_1: null,
    file_2: null,
    file_3: null,
})
const submit = () => {
    form.post(route('pengaturan.developer.upload_dokumen', {
        developer: props.developer.id
    }), {
        preserveScroll: true
    })
}
</script>
<style lang="">
    
</style>