<template lang="">
    <card2 title="Dokumen Kelengkapan">
        <div class="flex flex-row justify-center items-center w-max" v-for="(item, index) in dataAgen.agen_file" :key="index">
            <div class="label">{{item.keterangan}} : </div>
            <a :href="item.file" target="_blank" class="link">Download</a>
        </div>
        <div class="" v-if="dataAgen.agen_file.length == 0"> Data Belum Diisi</div>
    </card2>
</template>
<script setup>
import card2 from '../../../Components/card/card2.vue';
const props = defineProps({
    dataAgen: Object
})
</script>
<style lang="">
    
</style>