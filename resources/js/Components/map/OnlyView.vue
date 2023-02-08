<template lang="">
    <div id="only-view-map" class="w-full h-full z-0"></div>
</template>
<script>
import 'leaflet/dist/leaflet.css'
import L from 'leaflet'
export default {
    props: {
        dataMark: Array
    },
    setup() {
        var map
        return {
            map
        }
    },
    async mounted() {
        this.map = await L.map('only-view-map', {
            minZoom: 14,
            maxZoom: 19,
        }).setView([-1.62186, 103.58849], 15);
        await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 14,
            maxZoom: 19,
        }).addTo(this.map);
        if (this.dataMark) {
            this.dataMark.forEach(element => {
                var mark = L.marker(JSON.parse(element.koordinat))
                mark.addTo(this.map);
            });
        }
    },
}
</script>
<style lang="">
    
</style>