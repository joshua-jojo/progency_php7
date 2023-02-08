<template >
    <div :id="id" class="w-full h-full"></div>
    <template v-show="false">
        <button ref="button_hapus" @click="hapus_mark()" class="btn btn-error btn-sm">hapus</button>
    </template>
</template>
<script>
import 'leaflet/dist/leaflet.css'
import L from 'leaflet'
export default {
    setup(props) {
        var map = null
        var koordinat = props.coordinateValue
        var mark
        return {
            map,
            koordinat,
            mark
        }
    },
    beforeMount() {
        var data = document.getElementById(this.id)
        if (data) {
            data.remove()
        }
    },
    props: {
        coordinateValue: Array,
        id: String,
        setViewZoom: String,
        setView: String,
    },
    async mounted() {
        var coordinateValue = await (this.coordinateValue ? this.coordinateValue : [-1.62186, 103.58849]);
        var setView = await (this.setView ? this.setView : [-1.62186, 103.58849]);
        if (await this.coordinateValue) {
            this.map = await L.map(this.id).setView(coordinateValue, this.setViewZoom ? this.setViewZoom : 9);
        } else {
            this.map = await L.map(this.id).setView(setView, this.setViewZoom ? this.setViewZoom : 9);
        }
        await L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            minZoom: 9,
        }).addTo(this.map);

        this.map.on('click', (e) => {
            if (this.mark ? (this.mark._map ? false : true) : true) {
                var Lat = e.latlng.lat
                var Lng = e.latlng.lng
                this.get_koordinat([Lat, Lng])
                this.$emit('update:coordinateValue', [Lat, Lng])
            }
            this.mark.on('dragend', (event) => {
                var Lat = event.target._latlng.lat
                var Lng = event.target._latlng.lng
                this.koordinat = [Lat, Lng]
                this.$emit('update:coordinateValue', [Lat, Lng])
            })
        })
        if (await this.coordinateValue) {
            this.mark = L.marker(this.coordinateValue, { draggable: true })
            this.mark.addTo(this.map);
            this.mark.on('dragend', (event) => {
                var Lat = event.target._latlng.lat
                var Lng = event.target._latlng.lng
                this.koordinat = [Lat, Lng]
                this.$emit('update:coordinateValue', this.koordinat)
            })
        }
    },
    methods: {
        get_koordinat(data) {
            this.koordinat = data
            this.mark = L.marker(data, { draggable: true })
            this.mark.addTo(this.map);
            this.mark.bindPopup(this.$refs.button_hapus).openPopup();
            this.$emit('update:coordinateValue', data)
        },
        hapus_mark() {
            this.map.removeLayer(this.mark)
            this.$emit('update:coordinateValue', [])
        },
    },
}
</script>
<style lang="">
    
</style>