<template lang="">
    <div class="form-control w-full">
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text capitalize">{{title}}</span>
            </label>
            <div class="grid grid-cols-4 lg:grid-cols-6 gap-2">
                <input type="text" :value="dataModel.polygon" disabled :placeholder="'Masukkan ' + title" class="input order-last input-bordered w-full lg:col-span-5 col-span-3" />
                <label :for="props.id" class="btn btn-primary col-span-1">
                    maps
                </label>
            </div>
            <label class="label" v-if="props.form.errors[error]">
                <span class="label-text-alt text-error">{{error}}</span>
            </label>
        </div>
    </div>
    <ModalLg :id="props.id" close>
        <map-polygon class="h-[24rem]" v-model:centerPolygon="dataModel.center" v-model="dataModel.polygon" id="mapsPolygonDeveloper" :zoom="zoom" :mark="setView" :setView="setView"></map-polygon>
        <template v-slot:action>
            <button class="btn btn-success" :disabled="dataModel.polygon.length < 4" @click="simpan">simpan</button>
        </template>
    </ModalLg>
</template>
<script setup>
import ModalLg from '../modal/ModalLg.vue';
import mapPolygon from '../map/mapv2/mapPolygon.vue'
import { defineProps, defineEmits, reactive, watch } from 'vue';
import { polygon } from 'leaflet';

const props = defineProps({
    title: String,
    id: String,
    form: Object,
    error: String,
    setView: Array,
    modelValue: Array,
    centerLatLong: Array,
    zoom: Number,
})
const dataModel = reactive({
    polygon: props.modelValue ? props.modelValue : [],
    center: props.centerLatLang ? props.centerLatLang : []
})
function simpan() {
    if (dataModel.polygon.length > 3) {
        emit('update:modelValue', dataModel.polygon)
        document.getElementById(props.id).click()
    }
}
const emit = defineEmits(['update:modelValue', 'update:centerLatLong'])

watch(
    () => dataModel.center,
    (baru) => {
        emit('update:centerLatLong', baru)
    }
)
</script>
<style lang="">
    
</style>