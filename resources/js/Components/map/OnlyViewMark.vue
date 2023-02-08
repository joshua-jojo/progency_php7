<template lang="">
    <div id="only-view-map" class="w-full h-full z-0"></div>
</template>
<script>
import 'leaflet/dist/leaflet.css'
import L from 'leaflet'
export default {
    props: {
        dataMark: Array,
        setView: Boolean,
        setViewData: Array,
        setViewZoom: Number,
    },
    setup() {
        var map
        return {
            map
        }
    },
    async mounted() {
        if (await this.setView) {
            this.map = await L.map('only-view-map', {
                minZoom: 8,
                maxZoom: 19,
            }).setView(this.setViewData, this.setViewZoom);
        } else {
            this.map = await L.map('only-view-map', {
                minZoom: 8,
                maxZoom: 19,
            }).setView([-1.62186, 103.58849], 8);
        }
        await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 8,
            maxZoom: 19,
        }).addTo(this.map);
        if (this.dataMark) {
            this.dataMark.forEach(element => {
                var mark = L.marker(JSON.parse(element.koordinat), {
                    title: element.nama
                })
                mark.addTo(this.map);
                mark.bindTooltip(element.nama).openTooltip();
            });
        }
    },
}
</script>
<style lang="">
    
</style>