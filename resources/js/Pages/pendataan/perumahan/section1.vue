<template lang="">
    <div class="grid lg:grid-cols-5 max-h-full lg:max-h-[26rem] w-full h-full overflow-auto gap-4 p-5">
        <Card @click="tambah_perumahan" class="w-full lg:h-[20rem] hover:scale-105 hover:shadow-xl transition-all duration-100 ease-linear">
            <div class="flex justify-center items-center h-full">
                <div class="border-4 border-dashed h-[7rem] w-[7rem] rounded-full flex justify-center items-center">
                    <i class="fa-solid fa-plus text-6xl text-base-content opacity-40"></i>
                </div>
            </div>
        </Card>
        <Card class="w-full h-full max-h-[25rem] lg:max-h-[20rem]" v-for="(item, index) in perumahan" :key="item.id">
            <a class="block relative h-48 lg:h-48 rounded-lg overflow-hidden">
                <div class="absolute text-xs uppercase p-2" :class="{'bg-primary bg-opacity-50 rounded-b-lg' : item.status== 'tersedia','bg-warning bg-opacity-50 rounded-b-lg' : item.status== 'dp','bg-success bg-opacity-50 rounded-b-lg' : item.status== 'sold'}">{{item.status== 'dp' ? 'Booking' : item.status  }}</div>
                <img alt="ecommerce" class="object-cover object-center w-full h-full block" :src="item.cover">
            </a>
            <div class="flex flex-col">
                <h2 class="text-gray-900 title-font text-lg font-medium">{{item.nama}}</h2>
                <p class="mt-1 text-xs">{{item.developer_perumahan.nama}}</p>
                <p class="mt-1">{{rupiah(item.harga)}}</p>
            </div>
            <div class="w-full grid gap-2 lg:grid-cols-3 mt-4">
                <Link :href="route('daftar.perumahan.show',{perumahan : item.id})" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></Link>
                <label v-if="item.status == 'tersedia'" @click="getPerumahan(item)" for="perumahan-edit" class="btn w-full btn-sm btn-primary"><i class="fa fa-pen"></i></label>
                <label v-if="item.status == 'tersedia'" @click="get_hapus(item)" for="perumahan-hapus" class="btn w-full btn-sm btn-error"><i class="fa fa-trash"></i></label>
            </div>
        </Card>

        <ModalLg id="perumahan-tambah" title="Form Tambah Perumahan" :key="form.processing" close>
            <input-text title="Nama" v-model:inputValue="form.nama" :error="form.errors.nama"></input-text>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 w-full">
                <input-select title="Sertifikat" :error="form.errors.sertifikat" v-model:inputValue="form.sertifikat" :dataSelect="sertifikat" pick="nama" label="nama"></input-select>
                <input-text title="Blok" v-model:inputValue="form.blok" :error="form.errors.blok"></input-text>
                <input-select title="Tipe rumah" :error="form.errors.tipe" :dataSelect="tipe" v-model:inputValue="form.tipe" pick="nama" label="nama"></input-select>
                <input-select title="Jenis" :error="form.errors.jenis" :dataSelect="jenis" v-model:inputValue="form.jenis" pick="nama" label="nama"></input-select>
                <input-select title="Kondisi" :error="form.errors.kondisi" :dataSelect="kondisi" v-model:inputValue="form.kondisi" pick="nama" label="nama"></input-select>
                <InputNumber :title="'Harga : ' + rupiah(form.harga)" v-model="form.harga" :form="form" error="harga"></InputNumber>
                <input-select title="Pilih Perumahan" :error="form.errors.developer_perumahan_id" :dataSelect="developer.developer_perumahan" v-model:inputValue="form.developer_perumahan_id" pick="id" label="nama"></input-select>
                <inpuTextArea class="col-span-2 lg:col-span-4" title="Deskripsi" :form="form" error="deskripsi" v-model="form.deskripsi"></inpuTextArea>
                <input-select :error="form.errors.cluster" title="Cluster" v-model:inputValue="form.cluster" :dataSelect="dataCluster" label="nama" pick="id"></input-select>
                <input-select :error="form.errors.kamar_tidur" title="Kamar Tidur" v-model:inputValue="form.kamar_tidur" :dataSelect="dataKamar" label="nama" pick="id"></input-select>
                <input-select :error="form.errors.lantai" title="Jumlah Lantai" :dataSelect="dataLantai" label="nama" v-model:inputValue="form.lantai" pick="id"></input-select>
                <input-select :error="form.errors.kamar_mandi" title="Kamar Mandi" :dataSelect="dataKamarMandi" label="nama" pick="id" v-model:inputValue="form.kamar_mandi"></input-select>
                <input-select :error="form.errors.garasi" title="Garasi" :dataSelect="dataBoolean" label="nama" pick="nama" v-model:inputValue="form.garasi"></input-select>
                <input-select :error="form.errors.daya_listrik" title="Daya Listrik" :dataSelect="dataListrik" label="nama" pick="nama" v-model:inputValue="form.daya_listrik"></input-select>
                <input-select :error="form.errors.kondisi_parabotan" title="Kondisi Parabotan" :dataSelect="dataBoolean" label="nama" pick="nama" v-model:inputValue="form.kondisi_parabotan"></input-select>
                <input-number error="tahun_dibangun" :form="form" title="Tahun Dibangun" v-model="form.tahun_dibangun"></input-number>
                <input-number error="luas_tanah" :form="form" title="Luas Tanah (M<sup>2</sup>)" v-model="form.luas_tanah"></input-number>
                <input-number error="luas_bangunan" :form="form" title="Luas Bangunan (M<sup>2</sup>)" v-model="form.luas_bangunan"></input-number>
            </div>
            <InputTextArea :form="form" error="fasilitas" title="Fasilitas Tambahan" v-model="form.fasilitas"></InputTextArea>
            <input-file :form="form" type=".png, .jpg" dataIndex="cover" title="Cover"></input-file>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Foto Rumah</span>
                </label>
                <div class="flex gap-2 overflow-x-auto mb-4">
                    <div @click="hapus(item.id)" class="btn btn-xs btn-outline rounded-xl gap-2" v-for="item in foto.file" :key="item.id">{{item?item.name :  null}} <i class="fa fa-xmark hover:shadow-xl shadow-white"></i></div>
                </div>
                <div class="flex flex-col gap-2">
                    <template v-for="(item,index) in foto.file" :key="item.id">
                        <input accept="image/png, image/jpg, image/jpeg" type="file" class="file-input file-input-bordered w-full" @change="file_pick(item,$event)" />
                        <label class="label" v-if="form.errors[`foto_data.${index}.file`]">
                            <span class="label-text-alt text-error">{{form.errors[`foto_data.${index}.file`]}}</span>
                        </label>
                    </template>
                    <div class="btn w-full" @click="tambahFile"><i class="fa fa-plus"></i></div>
                </div>
                <label class="label">
                    <span class="label-text-alt text-error" v-if="form.errors.foto_data">{{form.errors.foto_data}}</span>
                </label>
            </div>
            <template v-slot:action>
                <button-submit :form="form" @click="submit" type="success">Buat</button-submit>
            </template>
        </ModalLg>

        <ModalLg id="perumahan-edit" :title="`Form Edit ${edit.nama}`" :key="edit.id" close>
            <input-text title="Nama" v-model:inputValue="edit.nama" :error="edit.errors.nama"></input-text>
            <div class="grid lg:grid-cols-4 gap-2 w-full">
                <input-select title="Sertifikat" :error="edit.errors.sertifikat" v-model:inputValue="edit.sertifikat" :dataSelect="sertifikat" pick="nama" label="nama"></input-select>
                <input-text title="Blok" v-model:inputValue="edit.blok" :error="edit.errors.blok"></input-text>
                <input-select title="Tipe rumah" :error="edit.errors.tipe" :dataSelect="tipe" v-model:inputValue="edit.tipe" pick="nama" label="nama"></input-select>
                <input-select title="Jenis" :error="edit.errors.jenis" :dataSelect="jenis" v-model:inputValue="edit.jenis" pick="nama" label="nama"></input-select>
                <input-select title="Kondisi" :error="edit.errors.kondisi" :dataSelect="kondisi" v-model:inputValue="edit.kondisi" pick="nama" label="nama"></input-select>
                <InputNumber :title="'Harga : ' + rupiah(edit.harga)" v-model="edit.harga" :form="edit" error="harga"></InputNumber>
                <input-select title="Pilih Perumahan" :error="edit.errors.developer_perumahan_id" :dataSelect="developer.developer_perumahan" v-model:inputValue="edit.developer_perumahan_id" pick="id" label="nama"></input-select>
                <inpuTextArea class="col-span-4" title="Deskripsi" :form="edit" error="deskripsi" v-model="edit.deskripsi"></inpuTextArea>
                <input-select :error="edit.errors.cluster" title="Cluster" v-model:inputValue="edit.cluster" :dataSelect="dataCluster" label="nama" pick="id"></input-select>
                <input-select :error="edit.errors.kamar_tidur" title="Kamar Tidur" v-model:inputValue="edit.kamar_tidur" :dataSelect="dataKamar" label="nama" pick="id"></input-select>
                <input-select :error="edit.errors.lantai" title="Jumlah Lantai" :dataSelect="dataLantai" label="nama" v-model:inputValue="edit.lantai" pick="id"></input-select>
                <input-select :error="edit.errors.kamar_mandi" title="Kamar Mandi" :dataSelect="dataKamarMandi" label="nama" pick="id" v-model:inputValue="edit.kamar_mandi"></input-select>
                <input-select :error="edit.errors.garasi" title="Garasi" :dataSelect="dataBoolean" label="nama" pick="nama" v-model:inputValue="edit.garasi"></input-select>
                <input-select :error="edit.errors.daya_listrik" title="Daya Listrik" :dataSelect="dataListrik" label="nama" pick="nama" v-model:inputValue="edit.daya_listrik"></input-select>
                <input-select :error="edit.errors.kondisi_parabotan" title="Kondisi Parabotan" :dataSelect="dataBoolean" label="nama" pick="nama" v-model:inputValue="edit.kondisi_parabotan"></input-select>
                <input-number error="tahun_dibangun" :form="edit" title="Tahun Dibangun" v-model="edit.tahun_dibangun"></input-number>
                <input-number error="luas_tanah" :form="edit" title="Luas Tanah (M<sup>2</sup>)" v-model="edit.luas_tanah"></input-number>
                <input-number error="luas_bangunan" :form="edit" title="Luas Bangunan (M<sup>2</sup>)" v-model="edit.luas_bangunan"></input-number>
            </div>
            <InputTextArea :form="edit" error="fasilitas" title="Fasilitas Tambahan" v-model="edit.fasilitas"></InputTextArea>
            <input-file :form="edit" dataIndex="cover" title="Cover"></input-file>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Foto Rumah</span>
                </label>
                <div class="flex gap-2 overflow-x-auto mb-4">
                    <div @click="hapus(item.id)" class="btn btn-xs btn-outline rounded-xl gap-2" v-for="item in foto.file" :key="item.id">{{item?item.name :  null}} <i class="fa fa-xmark hover:shadow-xl shadow-white"></i></div>
                </div>
                <div class="flex flex-col gap-2">
                    <template v-for="(item,index) in foto.file" :key="item.id">
                        <input accept="image/png, image/jpg, image/jpeg" type="file" class="file-input file-input-bordered w-full" @change="file_pick(item,$event)" />
                        <label class="label" v-if="edit.errors[`foto_data.${index}.file`]">
                            <span class="label-text-alt text-error">{{edit.errors[`foto_data.${index}.file`]}}</span>
                        </label>
                    </template>
                    <div class="btn w-full" @click="tambahFile"><i class="fa fa-plus"></i></div>
                </div>
                <label class="label">
                    <span class="label-text-alt text-error" v-if="edit.errors.foto_data">{{edit.errors.foto_data}}</span>
                </label>
            </div>
            <template v-slot:action>
                <button-submit :form="edit" @click="submit_edit" type="success">Simpan</button-submit>
            </template>
        </ModalLg>
        <ModalResponsive id="perumahan-hapus" :title="`Konfirmasi Hapus ${form_hapus.nama}`" close="true">
            <template v-slot:action>
                <button-submit :form="form_hapus" @click="submit_hapus" type="error">Hapus</button-submit>
            </template>
        </ModalResponsive>
    </div>
</template>
<script setup>
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import Card from '../../../Components/card/card.vue';
import InputNumber from '../../../Components/input/inputNumber.vue';
import InputSelect from '../../../Components/input/inputSelect.vue';
import InputText from '../../../Components/input/InputText.vue';
import InputTextArea from '../../../Components/input/inpuTextArea.vue';
import ModalResponsive from '../../../Components/modal/ModalResponsive.vue';
import ModalLg from '../../../Components/modal/ModalLg.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import { defineProps, reactive } from 'vue';
import InpuTextArea from '../../../Components/input/inpuTextArea.vue';
import InputFile from '../../../Components/input/InputFile.vue';
const props = defineProps(['perumahan', 'developer'])

const form = useForm({
    developer_id: props.developer.id,
    developer_perumahan_id: null,
    nama: null,
    cover: null,
    blok: null,
    tipe: null,
    jenis: null,
    sertifikat: null,
    harga: null,
    kondisi: null,
    deskripsi: null,
    cluster: null,
    kamar_tidur: null,
    lantai: null,
    kamar_mandi: null,
    luas_tanah: null,
    luas_bangunan: null,
    garasi: null,
    daya_listrik: null,
    tahun_dibangun: null,
    fasilitas: null,
    kondisi_parabotan: null,
    foto_data: null,
})

const edit = useForm({
    id: null,
    _method: 'put',
    developer_id: null,
    developer_perumahan_id: null,
    nama: null,
    cover: null,
    blok: null,
    tipe: null,
    jenis: null,
    sertifikat: null,
    harga: null,
    kondisi: null,
    deskripsi: null,
    cluster: null,
    kamar_tidur: null,
    lantai: null,
    kamar_mandi: null,
    luas_tanah: null,
    luas_bangunan: null,
    garasi: null,
    daya_listrik: null,
    tahun_dibangun: null,
    fasilitas: null,
    kondisi_parabotan: null,
    foto_data: null,
})

const form_hapus = useForm({
    id: null,
    nama: null,
});

function submit_hapus() {
    form_hapus.delete(route('pendataan.perumahan.destroy', {
        perumahan: form_hapus.id
    }), {
        onSuccess: () => {
            document.getElementById('perumahan-hapus').click()
            hapus.reset()
        }
    })
}

function get_hapus(data) {
    form_hapus.id = data.id
    form_hapus.nama = data.nama
}

var dataCluster = [];
for (let index = 0; index < 10; index++) {
    dataCluster.push({
        id: index + 1,
        nama: `Cluster ${index + 1}`
    });
}
var dataKamar = [];
for (let index = 0; index < 10; index++) {
    dataKamar.push({
        id: index + 1,
        nama: `${index + 1} Kamar Tidur`
    });
}
var dataKamarMandi = [];
for (let index = 0; index < 10; index++) {
    dataKamarMandi.push({
        id: index + 1,
        nama: `${index + 1} Kamar Mandi`
    });
}
var dataLantai = [];
for (let index = 0; index < 10; index++) {
    dataLantai.push({
        id: index + 1,
        nama: `${index + 1} Lantai`
    });
}

var dataBoolean = [];
dataBoolean.push({
    nama: `tersedia`
});
dataBoolean.push({
    nama: `tidak tersedia`
});

var dataListrik = [
    { nama: `CL 2 = 450 VA` },
    { nama: `CL 4 = 900 VA` },
    { nama: `CL 6 = 1300 VA` },
    { nama: `CL 10 = 2200 VA` },
    { nama: `CL 16 = 3500 VA` },
];

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

const submit = async () => {
    form.foto_data = await foto.file
    form.post(route('pendataan.perumahan.store'), {
        onSuccess: () => {
            form.reset()
            document.getElementById('perumahan-tambah').click();
        }
    })
}

var foto = reactive({
    file: []
});

function getPerumahan(data) {
    edit.id = data.id
    edit.nama = data.nama
    edit.sertifikat = data.sertifikat
    edit.blok = data.blok
    edit.tipe = data.tipe
    edit.jenis = data.jenis
    edit.kondisi = data.kondisi
    edit.harga = data.harga
    edit.developer_perumahan_id = data.developer_perumahan_id
    edit.developer_id = data.developer_id
    edit.deskripsi = data.deskripsi
    edit.cluster = data.perumahan_detail ? data.perumahan_detail.cluster : null
    edit.kamar_tidur = data.perumahan_detail ? data.perumahan_detail.kamar_tidur : null
    edit.lantai = data.perumahan_detail ? data.perumahan_detail.lantai : null
    edit.kamar_mandi = data.perumahan_detail ? data.perumahan_detail.kamar_mandi : null
    edit.luas_tanah = data.perumahan_detail ? data.perumahan_detail.luas_tanah : null
    edit.luas_bangunan = data.perumahan_detail ? data.perumahan_detail.luas_bangunan : null
    edit.garasi = data.perumahan_detail ? data.perumahan_detail.garasi : null
    edit.daya_listrik = data.perumahan_detail ? data.perumahan_detail.daya_listrik : null
    edit.jumlah_lantai = data.perumahan_detail ? data.perumahan_detail.jumlah_lantai : null
    edit.tahun_dibangun = data.perumahan_detail ? data.perumahan_detail.tahun_dibangun : null
    edit.fasilitas = data.perumahan_detail ? data.perumahan_detail.fasilitas : null
    edit.kondisi_parabotan = data.perumahan_detail ? data.perumahan_detail.kondisi_parabotan : null
    edit.foto_data = data.perumahan_detail ? data.perumahan_detail.foto : null
}

async function submit_edit() {
    edit.foto_data = await foto.file
    edit.post(route('pendataan.perumahan.update', {
        perumahan: edit.id
    }), {
        onSuccess: () => {
            document.getElementById('perumahan-edit').click();
        }
    })
}

function file_pick(data, event) {
    data.name = event.target.files[0].name
    data.file = event.target.files[0]
}
function tambahFile() {
    if (foto.file.length == 0) {
        foto.file.push({
            id: foto.file.length,
            name: null,
            file: null,
        })
    } else if (foto.file[foto.file.length - 1].file) {
        foto.file.push({
            id: foto.file.length,
            name: null,
            file: null,
        })
    }
}
function hapus(data) {
    foto.file.find((item, key) => {
        if (item.id == data) {
            foto.file.splice(key, 1)
            return item;
        }
    })
}

function tambah_perumahan() {
    document.getElementById('perumahan-tambah').click();
}
</script>
<style lang="">
    
</style>