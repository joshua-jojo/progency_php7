<template lang="">
    <Card>
        <div class="grid grid-cols-1 lg:grid-cols-12 h-full w-full gap-2">
            <div class="w-full lg:col-span-5 h-max z-10 order-3">
                <Card title="Tambah Kabupaten" action>
                    <input-text v-model:inputValue="kabupaten.nama" :error="kabupaten.errors.nama" title="Nama Kabupaten"></input-text>
                    <InputMapsMark id="tambahKabupaten" title="koordinat" v-model:inputValue="kabupaten.koordinat" :key="kabupaten.koordinat" :error="kabupaten.errors.koordinat"></InputMapsMark>
                    <template v-slot:action>
                        <button class="btn btn-success" @click="submit_kabupaten" :class="{'btn-disabled loading' : kabupaten.processing}">Simpan</button>
                        <button @click="kabupaten.reset()" class="btn btn-error">reset</button>
                    </template>
                </Card>
            </div>
            <div class="lg:col-span-7 h-[25rem] lg:h-full z-0 order-4">
                <Card title="Pratinjau">
                    <VueMaps :nama="kabupaten.nama" :koordinat="kabupaten.koordinat" :key="kabupaten.koordinat"></VueMaps>
                </Card>
            </div>
            <div class="lg:col-span-12 max-h-[15rem] z-0 order-2">
                <Card title="Data Kabupaten">
                    <div class="overflow-x-auto">
                        <table class="table w-full table-compact table-zebra text-center">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Kabupaten</td>
                                    <td>Koordinat</td>
                                    <td>opsi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in dataKabupaten" :key="item.id">
                                    <td>{{index + 1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.koordinat}}</td>
                                    <td class="flex gap-2 justify-center">
                                        <label for="edit-kabupaten" @click="get_kabupaten(item)" class="btn btn-xs btn-primary">
                                            edit
                                        </label>
                                        <label for="hapus-kabupaten" @click="get_hapus_kabupaten(item)" class="btn btn-xs btn-error">
                                            Hapus
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </Card>
            </div>
            <div class="order-1 lg:col-span-12 h-[25rem] z-0" :key="dataKabupaten">
                <Card title="Preview Map">
                    <MapsViewKabupaten :dataView="dataKabupaten"></MapsViewKabupaten>
                </Card>
            </div>
        </div>
    </Card>
    <ModalMd id="edit-kabupaten" title="Edit Kabupaten" :key="edit_kabupaten.nama" close>
        <input-text v-model:inputValue="edit_kabupaten.nama" :key="edit_kabupaten.nama" :error="edit_kabupaten.errors.nama" title="Nama Kabupaten"></input-text>
        <InputMapsMark title="koordinat" id="edit_kabupaten_map" v-model:inputValue="edit_kabupaten.koordinat" :error="edit_kabupaten.errors.koordinat"></InputMapsMark>
        <template v-slot:action>
            <button class="btn btn-success" @click="submit_edit_kabupaten" :class="{'btn-disabled loading' : edit_kabupaten.processing}">Simpan</button>
            <button @click="edit_kabupaten.reset()" class="btn btn-error">reset</button>
        </template>
    </ModalMd>
    <ModalMd id="hapus-kabupaten" :title="`Lanjutkan menghapus ${hapus_kabupaten.nama} ?`" :key="hapus_kabupaten.nama" close>
        <template v-slot:action>
            <ButtonSubmit type="error" @click="submit_hapus_kabupaten()" :form="hapus_kabupaten">Lanjutkan</ButtonSubmit>
        </template>
    </ModalMd>
</template>
<script>
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import Card from '../../../Components/card/card.vue';
import InputMapsMark from '../../../Components/input/InputMapsMark.vue';
import InputText from '../../../Components/input/InputText.vue';
import ModalMd from '../../../Components/modal/ModalMd.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import VueMaps from './tambahKabupaten/maps.vue'
import MapsViewKabupaten from './tambahKabupaten/mapsKabupatenView.vue'
export default {
    components: {
        Card,
        ButtonSubmit,
        ModalMd,
        InputText,
        InputMapsMark,
        VueMaps,
        MapsViewKabupaten,
    },
    props: {
        dataKabupaten: Array
    },
    setup() {
        const kabupaten = useForm({
            nama: null,
            koordinat: null,
        })
        const edit_kabupaten = useForm({
            id: null,
            nama: null,
            koordinat: null,
        })
        const hapus_kabupaten = useForm({
            id: null,
            nama: null,
        })
        return {
            kabupaten,
            edit_kabupaten,
            hapus_kabupaten,
        }
    },
    methods: {
        submit_kabupaten() {
            this.kabupaten.post(route('master.kabupaten.store'), {
                onSuccess: () => {
                    this.kabupaten.reset();
                },
                preserveScroll: true
            })
        },
        submit_edit_kabupaten() {
            this.edit_kabupaten.put(route('master.kabupaten.update', {
                kabupaten: this.edit_kabupaten.id
            }), {
                onSuccess: () => {
                    this.edit_kabupaten.reset();
                    document.getElementById('edit-kabupaten').click()
                },
            })
        },
        get_kabupaten(data) {
            this.edit_kabupaten.id = data.id
            this.edit_kabupaten.nama = data.nama
            this.edit_kabupaten.koordinat = JSON.parse(data.koordinat)
        },
        get_hapus_kabupaten(data) {
            this.hapus_kabupaten.id = data.id
            this.hapus_kabupaten.nama = data.nama
        },
        submit_hapus_kabupaten() {
            this.hapus_kabupaten.delete(route('master.kabupaten.destroy', {
                kabupaten: this.hapus_kabupaten.id
            }), {
                onSuccess: () => {
                    this.hapus_kabupaten.reset();
                },
            })
        }
    },

}
</script>
<style lang="">
    
</style>