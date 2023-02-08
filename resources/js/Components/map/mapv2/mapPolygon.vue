<template lang="">
    <div class="h-full w-full" :id="props.id">
    </div>
</template>
<script setup>
import { defineProps, onMounted, onBeforeMount, defineEmits } from 'vue'
import 'leaflet/dist/leaflet.css'
import L, { Polygon } from 'leaflet'

const props = defineProps({
    id: String,
    setView: Array,
    mark: Array,
    centerPolygon: Array,
    zoom: Number,
    modelValue: Array,
})
const emit = defineEmits(['update:modelValue', 'update:centerPolygon']);

var map;
var marker = [];
var polygon = [];
var polygonMarker;
var popupPolygon;
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
    map = L.map(props.id).setView(props.setView ? props.setView : [51.505, -0.09], props.zoom ? props.zoom : 13);
    await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    if (props.mark) {
        marker = L.marker(props.setView, {
            icon: icon
        }).addTo(map);
    }
    map.on('click', async (e) => {
        var pin = await new L.marker([e.latlng.lat, e.latlng.lng], { draggable: true }).addTo(map)
        await polygon_render()
        await pin.on('dragend', () => {
            polygon_render()
        })
        await pin.on('click', () => {
            pin.remove()
            polygon_render()
        })
    })

    async function polygon_render() {
        var center = 0;
        polygon = [];
        if (await polygonMarker) {
            polygonMarker.remove()
        }
        await map.eachLayer(item => {
            if (item.options.draggable) {
                polygon.push([item._latlng.lat, item._latlng.lng])
                center++
            }
        })
        polygonMarker = L.polygon(polygon, { color: '#4A89F3' }).addTo(map);

        emit('update:modelValue', polygon)
        emit('update:centerPolygon', [polygonMarker.getCenter().lat, polygonMarker.getCenter().lng])
    }
})

</script>
<style lang="">
    
</style>