<template lang="">
    <div class="h-screen w-screen" id="map">
    </div>
    <template>
        <div ref="daftar_perumahan" class="h-[17rem] capitalize p-4 flex overflow-x-auto gap-4">
                <card2 class=" flex justify-center items-center h-full w-[15rem]">
                    <div class="font-bold uppercase text-center">{{perumahan.nama}}</div>
                    <div class="flex flex-col h-[9rem] w-[6rem] gap-2 items-center justify-between">
                        <img :src="perumahan.cover" class="h-full w-full object-contain">
                        <Link :href="route('daftar.perumahan.show',{perumahan : perumahan.id})" class="btn btn-sm btn-ghost">detail</Link>
                    </div>
                </card2>
        </div>
    </template>
</template>
<script>
import Card2 from '../../Components/card/card2.vue';
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        Card2,
        Link,
    },
    setup() {
        const templatePerumahan = null;
        return {
            templatePerumahan
        }
    },
    props: ['perumahan'],
    async mounted() {
        var map = await L.map('map').setView(this.perumahan.koordinat, 19);
        await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
        this.templatePerumahan = this.$refs.daftar_perumahan;
        var polygon = await L.polygon(this.perumahan.polygon).addTo(map);
        polygon.bindPopup(this.templatePerumahan).openPopup();
    }
}
</script>
<style lang="">
    
</style>