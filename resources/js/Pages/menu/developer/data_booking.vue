<template lang="">
    <div>
        <card2 title="Data Booking">
            <table class="w-full table table-compact">
                <thead>
                    <tr>
                        <td>no</td>
                        <td>Perumahan</td>
                        <td>Nama</td>
                        <td>Kontak</td>
                        <td>Keterangan</td>
                        <td>Status</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="booking.length" v-for="(item,index) in booking" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{item.perumahan.nama}}</td>
                        <td>{{item.nama}}</td>
                        <td>{{item.kontak}}</td>
                        <td>{{item.keterangan}}</td>
                        <td>{{item.status}}</td>
                        <td class="flex gap-2">
                            <Link as="button"  :href="route('daftar.perumahan.show',{
                                perumahan : item.perumahan.id
                            })" class="btn btn-xs">
                                <i class="fa fa-eye"></i>
                            </Link>
                            <label for="edit" @click="get_booking(item)" v-if="item.status == 'diproses'" class="btn btn-xs btn-primary">
                                <i class="fa fa-pen"></i>
                            </label>
                            <label v-show="false" :class="{'btn-disabled' : item.status == 'hapus' || item.status == 'terjual'}" @click="get_batal(item)" for="batal" class="btn btn-xs btn-error">
                                <i class="fa fa-trash"></i>
                            </label>
                        </td>
                    </tr>
                    <tr class="text-center" v-else>
                        <td colspan="7"> Tidak Ada Data!</td>
                    </tr>
                </tbody>
            </table>
        </card2>
    </div>
    <ModalResponsive title="Edit Keterangan" id="edit" :key="form.id" close="true">
        <input-select title="Status" :dataSelect="dataSelect" pick="nama" label="nama" v-model:inputValue="form.status"></input-select>
        <template v-slot:action>
            <button-submit :form="form" @click="submit" :key="form.processing" type="success">Ubah</button-submit>
        </template>
    </ModalResponsive>
    <ModalResponsive :title="`Pengajuan Batal ${form_batal.perumahan}`" close="true" :key="form_batal.id" id="batal">
        <template v-slot:action>
            <button-submit :form="form_batal" @click="submit_batal" :key="form_batal.processing" type="error">Kirim</button-submit>
        </template>
    </ModalResponsive>
</template>
<script>
import MainLayout from '../../../Layouts/MainLayout.vue';
import card2 from '../../../Components/card/card2.vue';
import ModalResponsive from '../../../Components/modal/ModalResponsive.vue';
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import InputSelect from '../../../Components/input/inputSelect.vue';
export default {
    layout: MainLayout,
    components: {
        card2,
        ModalResponsive,
        ButtonSubmit,
        Link,
        InputSelect,
    },
    props: {
        booking: Array
    },
    setup() {
        const form = useForm({
            id: null,
            status: null,
        })

        const form_batal = useForm({
            id: null,
            perumahan: null,
        })
        return {
            form,
            form_batal,
        }
    },
    data() {
        return {
            dataSelect: [
                {
                    nama: 'diproses',
                },
                {
                    nama: 'terjual',
                },
                {
                    nama: 'ditolak',
                },
            ]
        }
    },
    methods: {
        submit() {
            this.form.post(route('menu.data.developer.booking.store'))
        },
        submit_batal() {
            this.form.put(route('menu.data.developer.booking.update', {
                booking: this.form_batal.id
            }))
        },
        get_booking(data) {
            this.form.id = data.id
            this.form.status = data.status
        },
        get_batal(data) {
            this.form_batal.id = data.id
            this.form_batal.perumahan = data.perumahan.nama
        }
    }
}
</script>
<style lang="">
    
</style>