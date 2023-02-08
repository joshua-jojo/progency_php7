<template lang="">
    <div id="tambah-kabupaten-maps" class="w-full h-full">
    </div>
</template>
<script>
import L from 'leaflet'
export default {
    setup() {
        var map
        return {
            map,
        }
    },
    props: {
        nama: String,
        koordinat: Array,
    },
    async mounted() {
        this.map = await L.map('tambah-kabupaten-maps').setView(this.koordinat ? this.koordinat : [-1.62191, 103.58849], 8);

        await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(this.map);

        if (await this.koordinat) {
            var mark = L.marker(this.koordinat).addTo(this.map)

        }
        else {
            var mark = L.marker([-1.62191, 103.58849]).addTo(this.map)
        }

        if (this.nama) {
            mark.bindPopup(this.nama)
                .openPopup();
        }
        else {
            mark.bindPopup('Masukkan Nama Kabupaten')
                .openPopup();
        }
    }
}
</script>
<style lang="">
    
</style>