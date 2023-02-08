<template lang="">
    <div class="w-full grid lg:grid-cols-12 h-[30rem] gap-3">
        <div class="lg:col-span-2">
                <div class="flex lg:flex-col gap-2">
                    <button @click="status_aktif = 'kabupaten'" class="btn btn-primary" :class="status_aktif == 'kabupaten' ? 'btn-primary' : 'btn-outline'">kabupaten</button>
                    <button @click="status_aktif = 'kecamatan'" class="btn btn-primary" :class="status_aktif == 'kecamatan' ? 'btn-primary' : 'btn-outline'">Kecamatan</button>
                </div>
        </div>
        <div class="lg:col-span-10 h-full">
            <TambahKabupaten :dataKabupaten="kabupaten" :key="kabupaten.length" v-if="status_aktif == 'kabupaten'"></TambahKabupaten>
            <TambahKecamatan :dataKabupaten="kabupaten" :dataKecamatan="kecamatan" v-else-if="status_aktif == 'kecamatan'"></TambahKecamatan>
        </div>
    </div>
</template>
<script>
import MainLayout from '../../Layouts/MainLayout.vue';
import TambahKabupaten from '../../Pages/pendataan/tambah_wilayah/TambahKabupaten.vue'
import TambahKecamatan from '../../Pages/pendataan/tambah_wilayah/tambahKecamatan.vue'
export default {
    layout: MainLayout,
    components: {
        TambahKabupaten,
        TambahKecamatan
    },
    props: {
        kabupaten: Array,
        kecamatan: Array,
    },
    data() {
        return {
            status_aktif: 'kabupaten'
        }
    },
}
</script>
<style lang="">
    
</style>