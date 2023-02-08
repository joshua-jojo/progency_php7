<template lang="">
    <div :id="props.id" class="w-full h-[24rem] z-0">
    </div>
</template>
<script setup>
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
import { onMounted, defineProps, onBeforeMount } from 'vue';

const props = defineProps({
    setView: Array,
    setPolygon: Array,
    setZoom: Number,
    id: String,
})

var map
var icon = L.icon({
    iconUrl: "https://img.icons8.com/bubbles/100/null/home-page.png",
    iconSize: [45, 45],
})

await onBeforeMount(async () => {
    var cekmap = await document.getElementById(props.id)
    if (await cekmap) {
        cekmap.remove()
    }
})

onMounted(async () => {
    map = L.map(props.id).setView(props.setView, props.setZoom)
    await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.marker(props.setView, {
        icon: icon
    }).addTo(map);
    if (props.setPolygon) {
        L.polygon(props.setPolygon, { color: '#4A89F3' }).addTo(map);
    }
})
</script>
<style lang="">
    
</style>