<template lang="">
    <div class="w-full h-full" id="maps-view-kecamatan">
    </div>
</template>
<script>
export default {
    props: {
        dataKabupaten: Object
    },
    setup() {
        var map
        return {
            map
        }
    },
    beforeCreate() {
        var data = document.getElementById('maps-view-kecamatan')
        if (data) {
            data.remove()
        }
    },
    async mounted() {
        this.map = await L.map('maps-view-kecamatan').setView(this.dataKabupaten.koordinat ? JSON.parse(this.dataKabupaten.koordinat) : [-1.62191, 103.58849], 10);
        await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 8,
            maxZoom: 19,
        }).addTo(this.map);

        if (this.dataKabupaten.kecamatan) {
            this.dataKabupaten.kecamatan.forEach(element => {
                L.marker(JSON.parse(element.koordinat)).addTo(this.map)
                    .bindTooltip(element.nama).openTooltip();
            });
        }
    }
}
</script>
<style lang="">
    
</style>