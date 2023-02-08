<template lang="">
    <Card title="Daftar Perumahan" class="gap-2">
        <label class="btn btn-sm w-max" for="perumahan-tambah">tambah perumahan</label>
        <table class="table table-compact w-full text-center">
            <thead>
                <tr>
                    <td>no</td>
                    <td>Nama</td>
                    <td>action</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in developer.developer_perumahan" :key="item.id" v-if="developer.developer_perumahan.length">
                    <td>{{index+1}}</td>
                    <td>{{item.nama}}</td>
                    <td class="flex gap-2 justify-center items-center w-full">
                        <label for="perumahan-edit" @click="get_edit(item)" class="btn btn-xs btn-primary">edit</label>
                        <label for="perumahan-hapus" @click="get_hapus(item)" class="btn btn-xs btn-error">hapus</label>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="3" class="font-bold">Belum Ada Perumahan</td>
                </tr>
            </tbody>
        </table>
    </Card>
    <ModalLg id="perumahan-tambah" close="true">
        <div :key="tambah.processing">
            <input-text title="Nama Perumahan" v-model:inputValue="tambah.nama" :error="tambah.errors.nama" sm></input-text>
            <input-select title="provinsi" :dataSelect="props.provinsi" label="nama" pick="id" sm :error="tambah.errors.provinsi_id" v-model:inputValue="tambah.provinsi_id"></input-select>
            <input-select title="kabupaten" :disabled="tambah.provinsi_id == null" :dataSelect="kabupaten_data" label="nama" pick="id" sm :error="tambah.errors.kabupaten_id" v-model:inputValue="tambah.kabupaten_id"></input-select>
            <input-select title="kecamatan"  :dataSelect="kecamatan_data" :error="tambah.errors.kecamatan_id" label="nama" pick="id" sm v-model:inputValue="tambah.kecamatan_id" :disabled="tambah.kabupaten_id == null"></input-select>
            <input-select title="kota"  :dataSelect="kota_data" :error="tambah.errors.kota_id" label="nama" pick="id" sm v-model:inputValue="tambah.kota_id" :disabled="tambah.kecamatan_id == null"></input-select>
            <inpuTextArea title="Jalan" :key="tambah.kota_id" error="jalan" :disabled="tambah.kota_id == null" :form="tambah" v-model="tambah.jalan"></inpuTextArea>
            <inputMapsPolygon title="Batasi area Perumahan" id="mapperumahan" :form="tambah" v-if="tambah.jalan" error="polygon" :setView="setview" :zoom="17" v-model="tambah.polygon" v-model:centerLatLong="tambah.mark"></inputMapsPolygon>
        </div>
        <template v-slot:action>
            <button-submit @click="submit" :key="setview" :disabled="!tambah.mark || !tambah.polygon" :form="tambah" type="success">Simpan</button-submit>
        </template>
    </ModalLg>
    <ModalLg id="perumahan-edit" :title="`Edit Data ${edit.nama}`" close="true" :key="edit.id">
        <input-text title="Nama Perumahan" v-model:inputValue="edit.nama" :error="edit.errors.nama" sm></input-text>
        <input-select title="provinsi" :key="edit.provinsi_id" :dataSelect="props.provinsi" label="nama" pick="id" sm :error="edit.errors.provinsi_id" v-model:inputValue="edit.provinsi_id"></input-select>
        <input-select title="kabupaten" :key="edit.provinsi_id" :disabled="edit.provinsi_id == null" :dataSelect="kabupaten_data" label="nama" pick="id" sm :error="edit.errors.kabupaten_id" v-model:inputValue="edit.kabupaten_id"></input-select>
        <input-select title="kecamatan" :key="edit.kecamatan_id" :dataSelect="kecamatan_data" :error="edit.errors.kecamatan_id" label="nama" pick="id" sm v-model:inputValue="edit.kecamatan_id" :disabled="edit.kabupaten_id == null"></input-select>
        <input-select title="kota"  :dataSelect="kota_data" :key="edit.kota_id" :error="edit.errors.kota_id" label="nama" pick="id" sm v-model:inputValue="edit.kota_id" :disabled="edit.kecamatan_id == null"></input-select>
        <inpuTextArea title="Jalan" :key="edit.kota_id" error="jalan" :disabled="edit.kota_id == null" :form="edit" v-model="edit.jalan"></inpuTextArea>
        <inputMapsPolygon title="Batasi area Perumahan" id="mapperumahan" :form="edit" v-if="edit.jalan" error="polygon" :setView="setview" :zoom="17" v-model="edit.polygon" v-model:centerLatLong="edit.mark"></inputMapsPolygon>
        <template v-slot:action>
            <button-submit @click="submit_edit" :disabled="!edit.mark || !edit.polygon" :form="edit" type="success">Simpan</button-submit>
        </template>
    </ModalLg>
    <ModalMd id="perumahan-hapus" :title="`Konfirmasi Penghapusan ${hapus.nama}`" close>
        <template v-slot:action>
            <button-submit @click="submit_hapus"  :form="hapus" type="error">hapus</button-submit>
        </template>
    </ModalMd>
</template>
<script setup>
import ButtonSubmit from '../../../Components/button/ButtonSubmit.vue';
import Card from '../../../Components/card/card.vue';
import InputText from '../../../Components/input/InputText.vue';
import InputMapsPolygon from '../../../Components/input/inputMapsPolygon.vue';
import InputSelect from '../../../Components/input/inputSelect.vue';
import InpuTextArea from '../../../Components/input/inpuTextArea.vue';
import OnlyView from '../../../Components/map/mapv2/mapView.vue';
import ModalLg from '../../../Components/modal/ModalLg.vue';
import ModalMd from '../../../Components/modal/ModalMd.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { computed, watch, defineProps, ref } from 'vue';
const props = defineProps({
    developer: Object,
    provinsi: Array,
})
const tambah = useForm({
    nama: null,
    polygon: null,
    mark: null,
    jalan: null,
    provinsi_id: null,
    kabupaten_id: null,
    kecamatan_id: null,
    kota_id: null,
})

const edit = useForm({
    id: null,
    nama: null,
    polygon: null,
    mark: null,
    jalan: null,
    provinsi_id: null,
    kabupaten_id: null,
    kecamatan_id: null,
    kota_id: null,
})
async function get_edit(data) {
    edit.id = data.id
    edit.nama = data.nama
    edit.polygon = data.polygon
    edit.mark = data.mark
    edit.jalan = data.jalan
    setview = null
    await props.provinsi.find(
        item => {
            if (item.id == data.provinsi_id) {
                kabupaten_data = item.kabupaten
                return item
            }
        }
    )
    await kabupaten_data.find(
        item => {
            if (item.id == data.kabupaten_id) {
                kecamatan_data = item.kecamatan
                return item
            }
        }
    )
    await kecamatan_data.find(
        item => {
            if (item.id == data.kecamatan_id) {
                kota_data = item.kota
                return item
            }
        }
    )
    edit.provinsi_id = data.provinsi_id
    edit.kabupaten_id = data.kabupaten_id
    edit.kecamatan_id = data.kecamatan_id
    edit.kota_id = data.kota_id
}
function submit_edit() {
    edit.put(route('pengaturan.developer.edit_perumahan', {
        developer_perumahan: edit.id
    }), {
        onSuccess: () => {
            document.getElementById('perumahan-edit').click()
        }
    })
}

const hapus = useForm({
    id: null,
    nama: null,
})
function get_hapus(data) {
    hapus.id = data.id
    hapus.nama = data.nama
}
function submit_hapus() {
    hapus.delete(route('pengaturan.developer.hapus_perumahan', {
        developer_perumahan: hapus.id
    }), {
        onSuccess: () => {
            document.getElementById('perumahan-hapus').click()
        }
    })
}

const setView = computed(() => {
    return tambah.mark.length ? tambah.mark : [props.developer.kecamatan.lat, props.developer.kecamatan.long]
})

const setZoom = 18;

const setPolygon = tambah.polygon ? tambah.polygon : null

const submit = () => {
    tambah.post(route('pengaturan.developer.simpan_lokasi', {
        developer: props.developer.id
    }), {
        preserveScroll: true,
        onSuccess: () => {
            tambah.reset()
            document.getElementById('perumahan-tambah').click()
        }
    })
}

var kabupaten_data = ref([]);
var kecamatan_data = ref([]);
var kota_data = ref([]);
var setview = ref([]);

if (tambah.kota_id) {
    props.provinsi.find(
        item => {
            if (item.id == tambah.provinsi_id) {
                kabupaten_data = item.kabupaten
                return item
            }
        }
    )
    kabupaten_data.find(
        item => {
            if (item.id == tambah.kabupaten_id) {
                kecamatan_data = item.kecamatan
                return item
            }
        }
    )
    kecamatan_data.find(
        item => {
            if (item.id == tambah.kecamatan_id) {
                kota_data = item.kota
                return item
            }
        }
    )
}


watch(
    () => tambah.provinsi_id,
    async () => {
        tambah.kabupaten_id = null
        tambah.kecamatan_id = null
        tambah.kota_id = null
        tambah.jalan = null
        let data = await props.provinsi.find(
            item => {
                if (item.id == tambah.provinsi_id) {
                    return item
                }
            }
        )
        kabupaten_data.value = data.kabupaten
    }
)
watch(
    () => tambah.kabupaten_id,
    async () => {
        tambah.kecamatan_id = null
        tambah.kota_id = null
        tambah.jalan = null
        let data = await kabupaten_data.value.find(
            item => {
                if (item.id == tambah.kabupaten_id) {
                    return item
                }
            }
        )
        kecamatan_data.value = await data.kecamatan
    }
)
watch(
    () => tambah.kecamatan_id,
    async () => {
        tambah.kota_id = null
        tambah.jalan = null
        let data = await kecamatan_data.value.find(
            item => {
                if (item.id == tambah.kecamatan_id) {
                    return item
                }
            }
        )
        kota_data.value = await data.kota
        setview.value = await [data.lat, data.long]
    }
)
watch(
    () => tambah.kota_id,
    () => {
        tambah.jalan = null
    }
)

watch(
    () => edit.provinsi_id,
    (baru, lama) => {
        if (lama) {
            edit.kabupaten_id = null
            edit.kecamatan_id = null
            edit.kota_id = null
            edit.jalan = null
        }
        props.provinsi.find(
            item => {
                if (item.id == edit.provinsi_id) {
                    kabupaten_data = item.kabupaten
                    return item
                }
            }
        )
    }
)
watch(
    () => edit.kabupaten_id,
    (baru, lama) => {
        if (lama) {
            edit.kecamatan_id = null
            edit.kota_id = null
            edit.jalan = null
        }
        kabupaten_data.find(
            item => {
                if (item.id == edit.kabupaten_id) {
                    kecamatan_data = item.kecamatan
                    return item
                }
            }
        )
    }
)
watch(
    () => edit.kecamatan_id,
    (baru, lama) => {
        if (lama) {
            edit.kota_id = null
            edit.jalan = null
        }
        kecamatan_data.find(
            item => {
                if (item.id == edit.kecamatan_id) {
                    setview = [item.lat, item.long]
                    kota_data = item.kota
                    return item
                }
            }
        )
    }
)
watch(
    () => edit.kota_id,
    (baru, lama) => {
        if (lama) {
            edit.jalan = null
            edit.mark = null
            edit.polygon = null
        }
    }
)


</script>
<style lang="">
    
</style>