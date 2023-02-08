<template lang="">
    <Card title="Tambah Rumah" class="w-full overflow-hidden" :key="form.processing">
        <input-text title="Nama" v-model:inputValue="form.nama" :error="form.errors.nama"></input-text>
        <div class="grid lg:grid-cols-2 gap-2 w-full">
            <input-select title="Sertifikat" :error="form.errors.sertifikat" v-model:inputValue="form.sertifikat" :dataSelect="sertifikat" pick="nama" label="nama"></input-select>
            <input-text title="Blok" v-model:inputValue="form.blok" :error="form.errors.blok"></input-text>
            <input-select title="Tipe rumah" :error="form.errors.tipe" :dataSelect="tipe" v-model:inputValue="form.tipe" pick="nama" label="nama"></input-select>
            <input-select title="Jenis" :error="form.errors.jenis" :dataSelect="jenis" v-model:inputValue="form.jenis" pick="nama" label="nama"></input-select>
        </div>
        <input-select title="Kondisi" :error="form.errors.kondisi" :dataSelect="kondisi" v-model:inputValue="form.kondisi" pick="nama" label="nama"></input-select>
        <Input-Number-Vue :title="'Harga : ' + rupiah(form.harga)" v-model="form.harga" :form="form" error="harga"></Input-Number-Vue>
        <inpuTextArea title="Deskripsi" :form="form" error="deskripsi" v-model="form.deskripsi"></inpuTextArea>
        <input-file :form="form" dataIndex="cover" title="Cover"></input-file>
        
        <div class="flex justify-end mt-4">
            <button-submit :form="form" @click="submit" type="success">Buat</button-submit>
        </div>
    </Card>
</template>
<script setup>
import Card from '../../../Components/card/card.vue';
import inpuTextArea from '../../../Components/input/inpuTextArea.vue';
import InputNumberVue from '../../../Components/input/inputNumber.vue';
import InputText from '../../../Components/input/InputText.vue';
import InputFile from '../../../Components/input/InputFile.vue';
import InputSelect from '../../../Components/input/inputSelect.vue';
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
    developer: Object
})
const form = useForm({
    developer_id: props.developer.id,
    nama: null,
    cover: null,
    blok: null,
    tipe: null,
    jenis: null,
    sertifikat: null,
    harga: null,
    kondisi: null,
    deskripsi: null,
})
var tipe = [
    {
        nama: '21/24'
    },
    {
        nama: '36'
    },
    {
        nama: '45'
    },
    {
        nama: '54'
    },
    {
        nama: '60'
    },
    {
        nama: '70'
    },
    {
        nama: '90'
    },
    {
        nama: '120'
    },
    {
        nama: '140-200'
    },
];

const jenis = [
    {
        nama: 'subsidi',
    },
    {
        nama: 'non-subsidi',
    }
]

const sertifikat = [
    {
        nama: 'Sertifikat Hak Milik (SHM)',
    },
    {
        nama: 'Hak Guna Bangunan (HGB)',
    },
    {
        nama: 'Girik atau Petok',
    },
    {
        nama: 'Serta Akta Jual Beli (AJB)',
    },
    {
        nama: 'Sertifikat Hak Satuan Rumah Susun (SHSRS)',
    },
]

const kondisi = [
    { nama: 'baru' },
    { nama: 'bekas' },
];

const submit = () => {
    form.post(route('pendataan.perumahan.store'), {
        onSuccess: () => {
            form.reset()
        }
    })
}
</script>
<style lang="">
    
</style>