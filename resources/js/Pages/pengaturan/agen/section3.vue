<template lang="">
    <card2 title="Dokumen Kelengkapan">
        <InputFile :title="`KTP [.jpg, .png] ` + (dataAgen.agen_file.length ? ' : File Telah Diupload' : '')" type=".jpg, .png" dataIndex="ktp" :form="form"></InputFile>
        <InputFile :title="`Kartu Keluarga [.jpg, .png]` + (dataAgen.agen_file.length ? ' : File Telah Diupload' : '')" type=".jpg, .png" dataIndex="kartu_keluarga" :form="form"></InputFile>
        <InputFile :title="`Pendidikan Terakhir [.jpg, .png]` + (dataAgen.agen_file.length ? ' : File Telah Diupload' : '')" type=".jpg, .png" dataIndex="pendidikan_terakhir" :form="form"></InputFile>
        <InputFile :title="`CV [.pdf]` + (dataAgen.agen_file.length ? ' : File Telah Diupload' : '')" type=".pdf, .docx" dataIndex="cv" :form="form"></InputFile>
        <div class="flex justify-end py-3">
            <button-submit @click="submit" :form="form" type="success">Simpan</button-submit>
        </div>
    </card2>
</template>
<script setup>
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import card2 from '../../../Components/card/card2.vue';
import InputFile from '../../../Components/input/InputFile.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const props = defineProps({
    dataAgen: Object
})

const form = useForm({
    ktp: null,
    kartu_keluarga: null,
    pendidikan_terakhir: null,
    cv: null,
})
function submit() {
    form.post(route('pengaturan.agen.tambah_dokumen'), {
        preserveState: true,
        preserveScroll: true,
    })
}
</script>
<style lang="">
    
</style>