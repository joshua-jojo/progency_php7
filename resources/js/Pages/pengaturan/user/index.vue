<template lang="">
    <card title="User">
        <div class="mb-2 flex justify-end">
            <label for="tambah" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> </label>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-compact w-full table-zebra text-center">
                <thead>
                    <tr>
                        <td>no</td>
                        <td>nama</td>
                        <td>email</td>
                        <td>role</td>
                        <td>action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in user" :key="item.id">
                        <td>{{index+1}}</td>
                        <td>{{item.nama}}</td>
                        <td>{{item.email}}</td>
                        <td>{{item.role}}</td>
                        <td class="flex justify-center gap-2">
                            <Link :href="item.role == 'agen'? route('pengaturan.agen.show',{agen : item.id}) : route('pengaturan.developer.show',{developer : item.id})" class="btn btn-xs btn-primary" v-if="item.role != 'guest' && item.role != 'admin' && item.role != 'super admin'"><i class="fa fa-list"></i></Link>
                            <label @click="get_edit(item)" for="edit" class="btn btn-xs btn-secondary"><i class="fa fa-pen"></i></label>
                            <label @click="get_hapus(item)" class="btn btn-xs btn-error" for="hapus"><i class="fa fa-trash"></i></label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </card>
    <ModalMd id="tambah" title="Tambah User" close>
        <input-text title="nama" v-model:inputValue="tambah.nama" :error="tambah.errors.nama"></input-text>
        <input-text title="email" v-model:inputValue="tambah.email" :error="tambah.errors.email"></input-text>
        <div class="grid grid-cols-2 gap-3">
            <input-text title="password" v-model:inputValue="tambah.password" :error="tambah.errors.password"></input-text>
            <input-text title="konfirmasi password" v-model:inputValue="tambah.password_confirmation" :error="tambah.errors.password_confirmation" placeholder="Masukkan Kembali Password"></input-text>
        </div>
        <input-select title="Role" :dataSelect="role" pick="nama" label="nama" v-model:inputValue="tambah.role" :error="tambah.errors.role"></input-select>
        <template v-slot:action>
            <button-submit @click="submit_tambah" :form="tambah" type="success">Tambah</button-submit>
        </template>
    </ModalMd>
    <modal-md id="edit" close :title="'Edit User ' + edit.nama" :key="edit.id">
        <input-text title="nama" v-model:inputValue="edit.nama" :error="edit.errors.nama"></input-text>
        <input-text title="email" v-model:inputValue="edit.email" :error="edit.errors.email"></input-text>
        <input-select title="Role" :dataSelect="role" pick="nama" label="nama" v-model:inputValue="edit.role" :error="tambah.errors.role"></input-select>
        <template v-slot:action>
            <button-submit @click="submit_edit" :form="edit" type="success">Edit</button-submit>
        </template>
    </modal-md>
    <modal-md id="hapus" :title="'Hapus User ' + hapus.nama" close>
        <template v-slot:action>
            <button-submit @click="submit_hapus" :form="hapus" type="error">hapus</button-submit>
        </template>
    </modal-md>
</template>
<script>
import MainLayout from '../../../Layouts/MainLayout.vue';
import Card from '../../../Components/card/card.vue'
import ModalMd from '../../../Components/modal/ModalMd.vue'
import InputText from '../../../Components/input/InputText.vue'
import InputSelect from '../../../Components/input/inputSelect.vue'
import { useForm } from '@inertiajs/inertia-vue3';
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    layout: MainLayout,
    props: {
        user: Array
    },
    components: {
        Card,
        ModalMd,
        InputText,
        InputSelect,
        ButtonSubmit,
        Link,
    },
    setup() {
        const tambah = useForm({
            nama: null,
            email: null,
            password: null,
            password_confirmation: null,
            role: null,
        })
        const edit = useForm({
            id: null,
            nama: null,
            email: null,
            role: null,
        })
        const hapus = useForm({
            id: null,
            nama: null,
        })
        return {
            tambah,
            edit,
            hapus,
        }
    },
    data() {
        return {
            role: [
                {
                    nama: 'guest'
                },
                {
                    nama: 'admin'
                },
                {
                    nama: 'super admin'
                },
                {
                    nama: 'agen'
                },
                {
                    nama: 'developer'
                },
            ]
        }
    },
    methods: {
        submit_tambah() {
            this.tambah.post(route('pengaturan.user.store'), {
                onSuccess: () => {
                    document.getElementById('tambah').click()
                }
            })
        },
        submit_edit() {
            this.edit.put(route('pengaturan.user.update', {
                user: this.edit.id
            }), {
                onSuccess: () => {
                    document.getElementById('edit').click()
                }
            })
        },
        submit_hapus() {
            this.hapus.delete(route('pengaturan.user.destroy', {
                user: this.hapus.id
            }), {
                onSuccess: () => {
                    document.getElementById('hapus').click()
                }
            })
        },
        get_edit(data) {
            this.edit.id = data.id
            this.edit.nama = data.nama
            this.edit.email = data.email
            this.edit.role = data.role
        },
        get_hapus(data) {
            this.hapus.id = data.id
            this.hapus.nama = data.nama
        }
    }
}
</script>
<style lang="">
    
</style>