<template lang="">
    <Card>
        <div class="grid grid-cols-1 lg:grid-cols-12 h-full w-full gap-2">
            <div class="order-1 lg:col-span-12 h-[30rem] z-0" :key="dataKabupaten">
                <Card title="Preview Map">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Pilih Kabupaten</span>
                        </label>
                        <select class="select select-sm select-bordered" v-model="kabupaten">
                            <option :value="item" v-for="item in dataKabupaten">{{item.nama}}</option>
                        </select>
                        <label class="label">
                        </label>
                    </div>
                    <Map :dataKabupaten="kabupaten" :key="kabupaten.koordinat"></Map>
                </Card>
            </div>
            <div class="lg:col-span-12 max-h-[15rem] z-0 order-2">
                <Card title="Data Kabupaten">
                    <div class="overflow-x-auto">
                        <table class="table w-full table-compact table-zebra text-center">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Kecamatan</td>
                                    <td>kabupaten</td>
                                    <td>Koordinat</td>
                                    <td>opsi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in dataKecamatan" :key="item.id">
                                    <td>{{index + 1}}</td>
                                    <td></td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.koordinat}}</td>
                                    <td class="flex gap-2 justify-center">
                                        <label for="edit-kecamatan" @click="get_edit(item)" class="btn btn-xs btn-primary">
                                            edit
                                        </label>
                                        <label for="hapus-kecamatan" @click="get_hapus(item)" class="btn btn-xs btn-error">
                                            Hapus
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </Card>
            </div>
            <div class="w-full lg:col-span-5 h-max z-10 order-3">
                <Card title="Tambah Kecamatan" action :key="form_tambah.kabupaten_id">
                    <input-select v-model:inputValue="form_tambah.kabupaten_id" :dataSelect="dataKabupaten" label="nama" pick="id" title="pilih kabupaten"></input-select>
                    <input-text v-model:inputValue="form_tambah.nama" :error="form_tambah.errors.nama" title="Nama Kecamatan"></input-text>
                    <InputMapsMark id="tambahKecamatan" title="koordinat" v-model:inputValue="form_tambah.koordinat" :key="form_tambah.koordinat" :error="form_tambah.errors.koordinat"></InputMapsMark>
                    <template v-slot:action>
                        <button class="btn btn-success" @click="submit_tambah" :class="{'btn-disabled loading' : form_tambah.processing}">Simpan</button>
                        <button @click="form_tambah.reset()" class="btn btn-error">reset</button>
                    </template>
                </Card>
            </div>
            <div class="lg:col-span-7 h-[25rem] lg:h-full z-0 order-4">
                <Card title="Pratinjau">
                    <VueMaps :nama="form_tambah.nama" :setView="viewMapKabupaten ? viewMapKabupaten.koordinat : null" :koordinat="form_tambah.koordinat" :key="render_key"></VueMaps>
                </Card>
            </div>
        </div>
    </Card>
    <ModalMd id="edit-kecamatan" close>
        <input-select v-model:inputValue="form_edit.kabupaten_id" :key="form_edit.kabupaten_id" :dataSelect="dataKabupaten" label="nama" pick="id" title="pilih kabupaten"></input-select>
        <input-text v-model:inputValue="form_edit.nama" :key="form_edit.nama" :error="form_edit.errors.nama" title="Nama Kecamatan"></input-text>
        <InputMapsMark id="editKecamatan" title="koordinat" v-model:inputValue="form_edit.koordinat" :key="form_edit.koordinat" :error="form_edit.errors.koordinat"></InputMapsMark>
        <template v-slot:action>
            <button class="btn btn-success" @click="submit_edit" :class="{'btn-disabled loading' : form_edit.processing}">Simpan</button>
        </template>
    </ModalMd>
    <ModalMd id="hapus-kecamatan" :title="`Lanjutkan menghapus ${form_hapus.nama} ?`" :key="form_hapus.nama" close>
        <template v-slot:action>
            <ButtonSubmit type="error" @click="submit_hapus" :form="form_hapus">Lanjutkan</ButtonSubmit>
        </template>
    </ModalMd>
</template>
<script>
import Card from '../../../Components/card/card.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import Map from './tambahKecamatan/map.vue'
import InputMapsMark from '../../../Components/input/InputMapsMark.vue';
import InputText from '../../../Components/input/InputText.vue';
import VueMaps from './tambahKecamatan/mapsTambah.vue'
import InputSelect from '../../../Components/input/inputSelect.vue'
import ModalMd from '../../../Components/modal/ModalMd.vue';
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';

export default {
    components: {
        Card,
        ButtonSubmit,
        ModalMd,
        Map,
        InputMapsMark,
        InputText,
        VueMaps,
        InputSelect,
    },
    props: {
        dataKabupaten: Array,
        dataKecamatan: Array,
    },
    setup() {
        const form_tambah = useForm({
            nama: null,
            kabupaten_id: null,
            koordinat: null,
        })
        const form_edit = useForm({
            id: null,
            nama: null,
            kabupaten_id: null,
            koordinat: null,
        })
        const form_hapus = useForm({
            id: null,
            nama: null,
        })
        return {
            form_tambah,
            form_edit,
            form_hapus,
        }
    },
    data() {
        return {
            kabupaten: {},
            render_key: 0
        }
    },
    watch: {
        'form_tambah.koordinat'() {
            this.render_key++
        }
    },
    computed: {
        viewMapKabupaten() {
            return this.dataKabupaten.find(
                (element) => {
                    if (element.id == this.form_tambah.kabupaten_id) {
                        this.render_key++
                        return element
                    }
                }
            )
        }
    },
    methods: {
        submit_tambah() {
            this.form_tambah.post(route('master.kecamatan.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form_tambah.reset()
                }
            })
        },
        get_edit(data) {
            this.form_edit.id = data.id
            this.form_edit.nama = data.nama
            this.form_edit.kabupaten_id = data.kabupaten_id
            this.form_edit.koordinat = JSON.parse(data.koordinat)
        },
        get_hapus(data) {
            this.form_hapus.id = data.id
            this.form_hapus.nama = data.nama
        },
        submit_edit() {
            this.form_edit.put(route('master.kecamatan.update', {
                kecamatan: this.form_edit.id
            }), {
                onSuccess: () => {
                    this.form_edit.reset()
                    document.getElementById('edit-kecamatan').click()
                }
            })
        },
        submit_hapus() {
            this.form_hapus.delete(route('master.kecamatan.destroy', {
                kecamatan: this.form_hapus.id
            }), {
                onSuccess: () => {
                    this.form_hapus.reset()
                    document.getElementById('hapus-kecamatan').click()
                }
            })
        }
    }
}
</script>
<style lang="">
    
</style>