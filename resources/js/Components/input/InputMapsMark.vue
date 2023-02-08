<template lang="">
    <div class="form-control w-full">
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text capitalize">{{title}}</span>
            </label>
            <div class="grid grid-cols-4 lg:grid-cols-6 gap-2">
                <input type="text" v-model="koordinat" disabled :placeholder="'Masukkan ' + title" class="input order-last input-bordered w-full lg:col-span-5 col-span-3" />
                <label :for="id + 'modal'" class="btn btn-primary col-span-1">
                    maps
                </label>
            </div>
            <label class="label" v-if="error">
                <span class="label-text-alt text-error">{{error}}</span>
            </label>
        </div>
    </div>
    <modal-lg :id="id + 'modal'" title="Pilih Lokasi" close>
        <div class="h-[25rem] bg-red-400">
            <mark-location :setViewZoom="setViewZoom" :setView="setView" :id="id+'maps'" :key="id+'maps'" v-model:coordinateValue="koordinat"></mark-location>
        </div>
    </modal-lg>
</template>
<script>
import MarkLocation from '../map/MarkLocation.vue';
import ModalLg from '../modal/ModalLg.vue';
export default {
    props: {
        title: String,
        inputValue: String,
        setView: String,
        setViewZoom: String,
        error: String,
        id: String,
    },
    components: {
        ModalLg,
        MarkLocation
    },
    data() {
        return {
            koordinat: this.inputValue
        }
    },
    watch: {
        koordinat(baru) {
            this.$emit('update:inputValue', baru)
        }
    }
}
</script>
<style lang="">
    
</style>