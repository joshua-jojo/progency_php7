<template lang="">
    <div class="w-full h-full" id="maps-view-kabupaten">
        
    </div>
</template>
<script>
export default {
    props: {
        dataView: Array
    },
    setup() {
        var map
        return {
            map
        }
    },
    async mounted() {
        this.map = await L.map('maps-view-kabupaten').setView([-1.62191, 103.58849], 8);

        await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 8,
            maxZoom: 19,
        }).addTo(this.map);

        this.dataView.forEach(element => {
            L.marker(JSON.parse(element.koordinat)).addTo(this.map)
                .bindTooltip(element.nama).openTooltip();
        });
    }
}
</script>
<style lang="">
    
</style>